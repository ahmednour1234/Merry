<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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
        App\Providers\ModulesServiceProvider::class,      // <-- تحميل الموديولز من DB
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        // مجموعة مخصّصة للتينانت (لو هتستخدمها على روتات معيّنة)
        $middleware->group('tenant', [
            App\Http\Middleware\ResolveTenant::class,
        ]);

        // أو تضيفه على كل الطلبات:
        // $middleware->append(App\Http\Middleware\ResolveTenant::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
