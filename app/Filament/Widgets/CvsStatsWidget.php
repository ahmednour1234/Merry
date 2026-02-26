<?php

namespace App\Filament\Widgets;

use App\Models\Cv;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CvsStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Cv::on('system')->count();
        $pending = Cv::on('system')->where('status', 'pending')->count();
        $approved = Cv::on('system')->where('status', 'approved')->count();
        $rejected = Cv::on('system')->where('status', 'rejected')->count();
        $frozen = Cv::on('system')->where('status', 'frozen')->count();

        return [
            Stat::make('إجمالي السير الذاتية', $total)
                ->description('جميع السير الذاتية')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),
            Stat::make('قيد الانتظار', $pending)
                ->description('سير ذاتية قيد المراجعة')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
            Stat::make('موافق عليها', $approved)
                ->description('سير ذاتية موافق عليها')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
            Stat::make('مرفوضة', $rejected)
                ->description('سير ذاتية مرفوضة')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
            Stat::make('مجمدة', $frozen)
                ->description('سير ذاتية مجمدة')
                ->descriptionIcon('heroicon-o-snowflake')
                ->color('info'),
        ];
    }
}
