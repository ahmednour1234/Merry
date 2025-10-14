<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckPermission;
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
        App\Providers\RepositoryServiceProvider::class,   // <-- ربط الـ Repositories
        App\Providers\ModulesServiceProvider::class,      // <-- تحميل الموديولز من DB (لو بتستخدمه)
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        // (اختياري) مجموعة للتينانت لو محتاجها
        // $middleware->group('tenant', [
        //     App\Http\Middleware\ResolveTenant::class,
        // ]);

        // aliases لميدل وير Sanctum abilities
        $middleware->alias([
                    'perm' => CheckPermission::class, // << استخدمه في الراوتس
            // يتأكد إن التوكن يمتلك "كل" القدرات الممرّرة
            'abilities' => CheckAbilities::class,
            // يتأكد إن التوكن يمتلك "أي" قدرة من القدرات الممرّرة
            'ability'   => CheckForAnyAbility::class,
        ]);

        // (اختياري) تلزق ميدل وير عام على كل الطلبات:
        // $middleware->append(App\Http\Middleware\ResolveTenant::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
