<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;

// Middlewares
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\ForceJsonResponse;

// Sanctum ability middlewares
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    // سجل مزوّداتك هنا (وليس داخل config/app.php في Laravel 12)
    ->withProviders([
        App\Providers\AppServiceProvider::class,
        App\Providers\ApiFormattingServiceProvider::class,
        App\Providers\RepositoryServiceProvider::class,
        App\Providers\ModulesServiceProvider::class,
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        // Aliases
        $middleware->alias([
            'perm'      => CheckPermission::class,
            'abilities' => CheckAbilities::class,
            'ability'   => CheckForAnyAbility::class,
        ]);

        // إجبار كل ريكوست API يرجّع JSON (حتى في الأخطاء)
        $middleware->appendToGroup('api', ForceJsonResponse::class);

        // (اختياري) لو عندك Tenant resolver
        // $middleware->group('tenant', [ App\Http\Middleware\ResolveTenant::class ]);
        // أو على كل الطلبات:
        // $middleware->append(App\Http\Middleware\ResolveTenant::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Log all exceptions with full details
        $exceptions->report(function (\Throwable $e) {
            Log::error('API Exception', [
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        });

        $exceptions->render(function (\Throwable $e, $request) {
            // أي طلب API أو أي طلب يتوقع JSON
            if ($request->is('api/*') || $request->expectsJson()) {
                $status = ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException && method_exists($e, 'getStatusCode'))
                    ? $e->getStatusCode()
                    : 500;

                // لو الحالة 503 خَلّيها 500 عشان ما يبانش 503 للـ API
                if ($status === 503) {
                    $status = 500;
                }

                $debug = app()->hasDebugModeEnabled();

                $payload = [
                    'success' => false,
                    'message' => $debug ? $e->getMessage() : 'Server Error',
                ];

                // في وضع الـ debug رجّع معلومات مكان الخطأ بالتفصيل
                if ($debug) {
                    $payload['exception'] = get_class($e);
                    $payload['file']      = $e->getFile();
                    $payload['line']      = $e->getLine();
                    $payload['trace']     = array_map(function ($trace) {
                        return [
                            'file' => $trace['file'] ?? 'N/A',
                            'line' => $trace['line'] ?? 'N/A',
                            'function' => $trace['function'] ?? 'N/A',
                            'class' => $trace['class'] ?? 'N/A',
                        ];
                    }, array_slice($e->getTrace(), 0, 10)); // أول 10 خطوات فقط

                    // معلومات إضافية
                    if (method_exists($e, 'getCode')) {
                        $payload['code'] = $e->getCode();
                    }
                    if ($e->getPrevious()) {
                        $payload['previous'] = [
                            'exception' => get_class($e->getPrevious()),
                            'message' => $e->getPrevious()->getMessage(),
                            'file' => $e->getPrevious()->getFile(),
                            'line' => $e->getPrevious()->getLine(),
                        ];
                    }
                }

                // لو عندك ApiResponder مقيّد في الحاوية
                if (app()->bound('api.responder')) {
                    /** @var \App\Support\Api\ApiResponder $responder */
                    $responder = app('api.responder');

                    return $responder->fail(
                        $payload['message'],
                        status: $status,
                        meta: $debug ? [
                            'exception' => $payload['exception'] ?? null,
                            'file'      => $payload['file'] ?? null,
                            'line'      => $payload['line'] ?? null,
                            'trace'     => $payload['trace'] ?? null,
                            'code'      => $payload['code'] ?? null,
                            'previous'  => $payload['previous'] ?? null,
                        ] : []
                    );
                }

                // Fallback JSON لو مفيش responder
                return response()->json($payload, $status);
            }
        });
    })
    ->create();
