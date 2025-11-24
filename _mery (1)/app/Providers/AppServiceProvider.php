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
        try {
            $this->loadMigrationsFrom([
                database_path('migrations/system'),
                database_path('migrations/identity'),
            ]);

            // Sanctum::usePersonalAccessTokenModel(SystemPersonalAccessToken::class);
            Event::listen(ExportCompleted::class, [SendExportCompletedNotification::class, 'handle']);
            Event::listen(OfficeRegistered::class, [NotifyAdminsOfNewOfficeRegistration::class, 'handle']);
            
            // Only register observer if Office model exists and database is available
            try {
                Office::observe($this->app->make(OfficeObserver::class));
            } catch (\Throwable $e) {
                // Silently fail if Office model or observer has issues
                \Illuminate\Support\Facades\Log::warning('Failed to register Office observer', [
                    'error' => $e->getMessage()
                ]);
            }
        } catch (\Throwable $e) {
            // Log but don't crash the application
            \Illuminate\Support\Facades\Log::error('AppServiceProvider boot error', [
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }
}
