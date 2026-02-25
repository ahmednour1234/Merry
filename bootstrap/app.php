<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Support\Facades\Log;

// ===== Global HTTP middlewares (من لارفيل نفسه) =====
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

// ===== Auth middlewares (من لارفيل نفسه) =====
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

// ===== Custom middlewares =====
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\ForceJsonResponse;
use App\Http\Middleware\CheckAbility;
use App\Http\Middleware\SetLocale;

// ===== Sanctum ability middlewares =====
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use App\Http\Middleware\TokenAuth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withProviders([
        App\Providers\AppServiceProvider::class,
        App\Providers\ApiFormattingServiceProvider::class,
        App\Providers\RepositoryServiceProvider::class,
        App\Providers\ModulesServiceProvider::class,
        App\Providers\Filament\AdminPanelProvider::class,
    ])
    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | Global HTTP middleware
        |--------------------------------------------------------------------------
        */
        $middleware->use([
            TrustProxies::class,
            HandleCors::class,
            PreventRequestsDuringMaintenance::class,
            ValidatePostSize::class,
            TrimStrings::class,
            ConvertEmptyStringsToNull::class,
            SetLocale::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Route middleware aliases
        |--------------------------------------------------------------------------
        */
$middleware->alias([
    // مهمين جداً
    'auth'        => Authenticate::class,
    'guest'       => RedirectIfAuthenticated::class,

    // صلاحياتك
    'perm'        => CheckPermission::class,

    // Sanctum الرسمية (لو احتجتها بعدين)
    'abilities'   => CheckAbilities::class,
    'ability_any' => CheckForAnyAbility::class,

    // ميدل وير القدرات بتاعك
    'check_ability' => CheckAbility::class,

    // ✅ ميدل وير التوكن الجديد
    'token_auth'    => TokenAuth::class,
]);


        /*
        |--------------------------------------------------------------------------
        | API group extras
        |--------------------------------------------------------------------------
        */
        $middleware->appendToGroup('api', ForceJsonResponse::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // ====== REPORT: كتابة اللوج ======
        $exceptions->report(function (\Throwable $e) {
            $context = [
                'message'   => $e->getMessage(),
                'exception' => get_class($e),
                'file'      => $e->getFile(),
                'line'      => $e->getLine(),
            ];

            if ($e instanceof \Illuminate\Database\QueryException) {
                $context['sql']      = $e->getSql();
                $context['bindings'] = $e->getBindings();
            }

            Log::error('API Exception', $context);
        });

        // ====== RENDER: شكل الرد على الـ API ======
        $exceptions->render(function (\Throwable $e, $request) {
            if (! $request->is('api/*') && ! $request->expectsJson()) {
                return null; // سيب باقي الطلبات للهاندلر الافتراضي
            }

            $status = $e instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                ? $e->getStatusCode()
                : 500;

            // لو حد رمى 503 رجّعها 500 في الـ JSON
            if ($status === 503) {
                $status = 500;
            }

            $debug   = (bool) config('app.debug');
            $message = $e->getMessage();

            if ($e instanceof \Illuminate\Database\QueryException) {
                $message = $debug
                    ? 'Database Error: ' . $e->getMessage()
                    : 'Database connection error.';
            } elseif ($e instanceof \PDOException) {
                $message = $debug
                    ? 'PDO Error: ' . $e->getMessage()
                    : 'Database connection failed.';
            } elseif ($e instanceof \Illuminate\Auth\AuthenticationException) {
                $message = $debug
                    ? 'Authentication failed: ' . $e->getMessage()
                    : 'Invalid credentials or token.';
                $status = 401;
            }

            $payload = [
                'success' => false,
                'message' => $debug && $message
                    ? $message
                    : ($status === 500 ? 'Server Error' : $message),
            ];

            if ($debug) {
                $payload['exception'] = get_class($e);
                $payload['file']      = $e->getFile();
                $payload['line']      = $e->getLine();
            }

            return response()->json($payload, $status);
        });
    })
    ->create();
