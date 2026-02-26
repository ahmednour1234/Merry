<?php

namespace App\Filament\Widgets;

use App\Models\Office;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OfficesStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Office::on('system')->count();
        $active = Office::on('system')->where('active', true)->count();
        $blocked = Office::on('system')->where('blocked', true)->count();
        $inactive = $total - $active - $blocked;

        return [
            Stat::make('إجمالي المكاتب', $total)
                ->description('جميع المكاتب المسجلة')
                ->descriptionIcon('heroicon-o-building-office')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),
            Stat::make('المكاتب النشطة', $active)
                ->description('مكاتب نشطة')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
            Stat::make('المكاتب المحظورة', $blocked)
                ->description('مكاتب محظورة')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
            Stat::make('المكاتب غير النشطة', $inactive)
                ->description('مكاتب غير نشطة')
                ->descriptionIcon('heroicon-o-pause-circle')
                ->color('warning'),
        ];
    }
}
