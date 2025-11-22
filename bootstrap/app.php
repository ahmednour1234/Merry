<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

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
        // توحيد مخرجات الأخطاء كـ JSON
        $exceptions->render(function (\Throwable $e, $request) {
            // أي طلب API أو طلب يتوقع JSON
            if ($request->is('api/*') || $request->expectsJson()) {
                $status = 500;

                if ($e instanceof HttpExceptionInterface) {
                    $status = $e->getStatusCode();
                } elseif (method_exists($e, 'getStatusCode')) {
                    $status = $e->getStatusCode();
                } elseif (method_exists($e, 'status')) {
                    $status = $e->status();
                } elseif ($e instanceof AuthenticationException) {
                    $status = 401;
                } elseif ($e instanceof AuthorizationException) {
                    $status = 403;
                }

                // لو عندك ApiResponder مقيّد في الحاوية، استخدمه
                if (app()->bound('api.responder')) {
                    /** @var \App\Support\Api\ApiResponder $responder */
                    $responder = app('api.responder');
                    return $responder->fail(
                        app()->hasDebugModeEnabled() ? $e->getMessage() : 'Server Error',
                        status: $status,
                        meta: app()->hasDebugModeEnabled() ? ['exception' => get_class($e)] : []
                    );
                }

                // fallback JSON
                return response()->json([
                    'success' => false,
                    'message' => app()->hasDebugModeEnabled() ? $e->getMessage() : 'Server Error',
                ], $status);
            }
        });
    })
    ->create();
