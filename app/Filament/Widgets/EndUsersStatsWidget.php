<?php

namespace App\Filament\Widgets;

use App\Models\Identity\EndUser;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EndUsersStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $total = EndUser::count();
        $thisMonth = EndUser::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $lastMonth = EndUser::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $change = $lastMonth > 0 ? round((($thisMonth - $lastMonth) / $lastMonth) * 100, 1) : 0;

        return [
            Stat::make('إجمالي المستخدمين', $total)
                ->description('جميع المستخدمين النهائيين')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),
            Stat::make('هذا الشهر', $thisMonth)
                ->description($change >= 0 ? "زيادة {$change}%" : "انخفاض {$change}%")
                ->descriptionIcon($change >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($change >= 0 ? 'success' : 'danger'),
        ];
    }
}
