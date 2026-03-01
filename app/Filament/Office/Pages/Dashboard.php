<?php

namespace App\Filament\Office\Pages;

use App\Filament\Office\Widgets\BookingStatsWidget;
use App\Filament\Office\Widgets\CvStatsWidget;
use App\Filament\Office\Widgets\OfficeStatusWidget;
use App\Filament\Office\Widgets\SubscriptionWidget;
use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'لوحة التحكم';

    protected static ?string $title = 'لوحة التحكم';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected string $view = 'filament.office.pages.dashboard';

    public function getWidgets(): array
    {
        return [
            OfficeStatusWidget::class,
            SubscriptionWidget::class,
            CvStatsWidget::class,
            BookingStatsWidget::class,
        ];
    }

    public function getColumns(): int | array
    {
        return 2;
    }
}
