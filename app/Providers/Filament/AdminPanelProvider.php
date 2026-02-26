<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Widgets\BookingsChartWidget;
use App\Filament\Widgets\BookingsStatsWidget;
use App\Filament\Widgets\CvsChartWidget;
use App\Filament\Widgets\CvsStatsWidget;
use App\Filament\Widgets\EndUsersStatsWidget;
use App\Filament\Widgets\OfficesStatsWidget;
use App\Filament\Widgets\OverallStatsWidget;
use App\Filament\Widgets\PlansStatsWidget;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Support\Facades\Vite;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        // Set locale to Arabic
        app()->setLocale('ar');
        config(['app.locale' => 'ar']);

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Merry')
            ->colors([
                'primary' => Color::hex('#054F31'),
            ])
            ->renderHook(
                'panels::head.start',
                fn () => view('filament.rtl-styles')
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                OverallStatsWidget::class,
                OfficesStatsWidget::class,
                PlansStatsWidget::class,
                CvsStatsWidget::class,
                BookingsStatsWidget::class,
                EndUsersStatsWidget::class,
                BookingsChartWidget::class,
                CvsChartWidget::class,
                AccountWidget::class,
            ])
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
                Authenticate::class,
            ]);
    }
}
