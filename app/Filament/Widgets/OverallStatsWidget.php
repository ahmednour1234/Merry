<?php

namespace App\Filament\Widgets;

use App\Enums\BookingStatus;
use App\Models\Cv;
use App\Models\CvBooking;
use App\Models\Identity\EndUser;
use App\Models\Identity\FavouriteCv;
use App\Models\Office;
use App\Models\Plan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverallStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $offices = Office::count();
        $cvs = Cv::count();
        $bookings = CvBooking::count();
        $endUsers = EndUser::count();
        $plans = Plan::where('active', true)->count();
        $favourites = FavouriteCv::count();

        return [
            Stat::make('المكاتب', $offices)
                ->description('إجمالي المكاتب المسجلة')
                ->descriptionIcon('heroicon-o-building-office')
                ->color('primary'),
            Stat::make('السير الذاتية', $cvs)
                ->description('إجمالي السير الذاتية')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('info'),
            Stat::make('الحجوزات', $bookings)
                ->description('إجمالي الحجوزات')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('success'),
            Stat::make('المستخدمون', $endUsers)
                ->description('إجمالي المستخدمين النهائيين')
                ->descriptionIcon('heroicon-o-users')
                ->color('warning'),
            Stat::make('الخطط النشطة', $plans)
                ->description('الخطط المتاحة')
                ->descriptionIcon('heroicon-o-credit-card')
                ->color('primary'),
            Stat::make('المفضلة', $favourites)
                ->description('إجمالي السير الذاتية المفضلة')
                ->descriptionIcon('heroicon-o-heart')
                ->color('danger'),
        ];
    }
}
