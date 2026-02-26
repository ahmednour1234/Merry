<?php

namespace App\Filament\Widgets;

use App\Enums\BookingStatus;
use App\Models\CvBooking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookingsStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $total = CvBooking::on('system')->count();
        $pending = CvBooking::on('system')->where('status', BookingStatus::PENDING->value)->count();
        $accepted = CvBooking::on('system')->where('status', BookingStatus::ACCEPTED->value)->count();
        $rejected = CvBooking::on('system')->where('status', BookingStatus::REJECTED->value)->count();
        $cancelled = CvBooking::on('system')->where('status', BookingStatus::CANCELLED->value)->count();

        return [
            Stat::make('إجمالي الحجوزات', $total)
                ->description('جميع الحجوزات')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),
            Stat::make('قيد الانتظار', $pending)
                ->description('حجوزات قيد الانتظار')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
            Stat::make('مقبولة', $accepted)
                ->description('حجوزات مقبولة')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
            Stat::make('مرفوضة', $rejected)
                ->description('حجوزات مرفوضة')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
            Stat::make('ملغاة', $cancelled)
                ->description('حجوزات ملغاة')
                ->descriptionIcon('heroicon-o-x-mark')
                ->color('gray'),
        ];
    }
}
