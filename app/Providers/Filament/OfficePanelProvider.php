<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
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
        config(['filament.locale' => 'ar']);

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
                fn () => view('filament.office.ltr-styles')
            )
            ->discoverResources(in: app_path('Filament/Office/Resources'), for: 'App\\Filament\\Office\\Resources')
            ->discoverPages(in: app_path('Filament/Office/Pages'), for: 'App\\Filament\\Office\\Pages')
            ->pages([
                \App\Filament\Office\Pages\Dashboard::class,
                \App\Filament\Office\Pages\Subscriptions::class,
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
            ->databaseNotifications()
            ->userMenuItems([
                MenuItem::make()
                    ->label(fn () => 'السير الذاتية (' . \App\Models\Cv::on('system')
                        ->where('office_id', \Illuminate\Support\Facades\Auth::guard('office-panel')->id())
                        ->count() . ')')
                    ->icon('heroicon-o-document-text')
                    ->url(fn () => \Filament\Facades\Filament::getPanel('office')->getUrl() . '/cvs'),
                MenuItem::make()
                    ->label(fn () => 'الحجوزات (' . \App\Models\CvBooking::on('system')
                        ->where('office_id', \Illuminate\Support\Facades\Auth::guard('office-panel')->id())
                        ->count() . ')')
                    ->icon('heroicon-o-calendar')
                    ->url(fn () => \Filament\Facades\Filament::getPanel('office')->getUrl() . '/bookings'),
            ]);
    }
}
