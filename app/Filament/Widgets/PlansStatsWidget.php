<?php

namespace App\Filament\Widgets;

use App\Models\Plan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PlansStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Plan::on('system')->count();
        $active = Plan::on('system')->where('active', true)->count();
        $inactive = $total - $active;

        return [
            Stat::make('إجمالي الخطط', $total)
                ->description('جميع الخطط المتاحة')
                ->descriptionIcon('heroicon-o-credit-card')
                ->color('primary'),
            Stat::make('الخطط النشطة', $active)
                ->description('خطط نشطة')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
            Stat::make('الخطط غير النشطة', $inactive)
                ->description('خطط غير نشطة')
                ->descriptionIcon('heroicon-o-pause-circle')
                ->color('warning'),
        ];
    }
}
