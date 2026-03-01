<?php

namespace App\Filament\Office\Pages;

use App\Filament\Office\Widgets\BookingStatsWidget;
use App\Filament\Office\Widgets\CvStatsWidget;
use App\Filament\Office\Widgets\OfficeStatusWidget;
use App\Filament\Office\Widgets\SubscriptionWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'لوحة التحكم';

    protected static ?string $title = 'لوحة التحكم';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.office.pages.dashboard';

    public function getWidgets(): array
    {
        return [
            OfficeStatusWidget::class,
            SubscriptionWidget::class,
            CvStatsWidget::class,
            BookingStatsWidget::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 2;
    }
}
