<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class OfficePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        app()->setLocale('ar');
        config(['app.locale' => 'ar']);

        return $panel
            ->id('office')
            ->path('office')
            ->login(\App\Filament\Office\Pages\Auth\Login::class)
            ->registration(\App\Filament\Office\Pages\Auth\Register::class)
            ->brandName('تطبيق ميري - المكتب')
            ->colors([
                'primary' => Color::hex('#054F31'),
                'success' => Color::hex('#10b981'),
                'warning' => Color::hex('#f59e0b'),
                'danger' => Color::hex('#ef4444'),
            ])
            ->font('Cairo')
            ->renderHook(
                'panels::head.start',
                fn () => view('filament.rtl-styles')
            )
            ->renderHook(
                'panels::user-menu.start',
                fn () => view('filament.office.components.notification-bell')
            )
            ->discoverResources(in: app_path('Filament/Office/Resources'), for: 'App\\Filament\\Office\\Resources')
            ->discoverPages(in: app_path('Filament/Office/Pages'), for: 'App\\Filament\\Office\\Pages')
            ->pages([
                \App\Filament\Office\Pages\Dashboard::class,
                \App\Filament\Office\Pages\Subscriptions::class,
                \App\Filament\Office\Pages\NotificationsPage::class,
                \App\Filament\Office\Pages\Auth\Login::class,
                \App\Filament\Office\Pages\Auth\Register::class,
                \App\Filament\Office\Pages\Auth\VerifyOtp::class,
                \App\Filament\Office\Pages\Auth\ForgetPassword::class,
                \App\Filament\Office\Pages\Auth\ResetPassword::class,
                \App\Filament\Office\Pages\Auth\LoginOtp::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Office/Widgets'), for: 'App\\Filament\\Office\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                \App\Http\Middleware\Filament\OfficeAuthenticate::class,
                \App\Http\Middleware\CheckOfficeActive::class,
                \App\Http\Middleware\CheckOfficeSubscription::class,
            ])
            ->authGuard('office-panel')
            ->authPasswordBroker('offices')
            ->databaseNotifications();
    }
}
