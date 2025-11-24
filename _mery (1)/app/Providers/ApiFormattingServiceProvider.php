<?php

namespace App\Providers;

use App\Support\Api\ApiResponder;
use Illuminate\Support\ServiceProvider;

class ApiFormattingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ApiResponder::class, fn () => new ApiResponder);
        // اختياري: واجهة مختصرة عبر الكونتينر
        $this->app->alias(ApiResponder::class, 'api.responder');
    }

    public function boot(): void
    {
        // لا شيء إضافي الآن
    }
}
