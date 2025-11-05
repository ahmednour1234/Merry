<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ExportCompleted;
use App\Listeners\SendExportCompletedNotification;
use App\Events\OfficeRegistered;
use App\Listeners\NotifyAdminsOfNewOfficeRegistration;
use App\Observers\OfficeObserver;
use App\Models\Office;
use Laravel\Sanctum\Sanctum;
use App\Models\SystemPersonalAccessToken;
use App\Services\SystemSettings;
use App\Services\LocaleService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
      public function register(): void
    {
        $this->app->singleton(SystemSettings::class, fn() => new SystemSettings());
        $this->app->singleton(LocaleService::class, fn($app) => new LocaleService($app->make(SystemSettings::class)));
    }


    /**
     * Bootstrap any application services.
     */
     public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(SystemPersonalAccessToken::class);
        Event::listen(ExportCompleted::class, [SendExportCompletedNotification::class, 'handle']);
        Event::listen(OfficeRegistered::class, [NotifyAdminsOfNewOfficeRegistration::class, 'handle']);
        Office::observe($this->app->make(OfficeObserver::class));
    }
}
