<?php

namespace App\Filament\Office\Widgets;

use App\Models\Cv;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class CvStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $office = Auth::guard('office-panel')->user();
        $cvs = Cv::on('system')->where('office_id', $office->id);

        return [
            Stat::make('إجمالي السير الذاتية', (clone $cvs)->count())
                ->icon('heroicon-o-document-text')
                ->color('primary'),
            Stat::make('قيد المراجعة', (clone $cvs)->where('status', 'pending')->count())
                ->icon('heroicon-o-clock')
                ->color('warning'),
            Stat::make('معتمدة', (clone $cvs)->where('status', 'approved')->count())
                ->icon('heroicon-o-check-circle')
                ->color('success'),
            Stat::make('مرفوضة', (clone $cvs)->where('status', 'rejected')->count())
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
