<?php

namespace App\Filament\Office\Pages;

use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'لوحة التحكم';

    protected static ?string $title = 'لوحة التحكم';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Office\Widgets\SubscriptionInfoWidget::class,
            \App\Filament\Office\Widgets\OfficeStatsWidget::class,
            \App\Filament\Office\Widgets\FavoriteUsersWidget::class,
            \App\Filament\Office\Widgets\TopNationalitiesWidget::class,
        ];
    }

    public function getColumns(): int | array
    {
        return [
            'md' => 2,
            'xl' => 2,
        ];
    }
}
