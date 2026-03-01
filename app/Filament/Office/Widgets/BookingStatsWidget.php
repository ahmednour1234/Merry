<?php

namespace App\Filament\Office\Widgets;

use App\Enums\BookingStatus;
use App\Models\CvBooking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class BookingStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $office = Auth::guard('office-panel')->user();
        $bookings = CvBooking::on('system')->where('office_id', $office->id);

        return [
            Stat::make('إجمالي الحجوزات', (clone $bookings)->count())
                ->icon('heroicon-o-calendar')
                ->color('primary'),
            Stat::make('قيد الانتظار', (clone $bookings)->where('status', BookingStatus::PENDING->value)->count())
                ->icon('heroicon-o-clock')
                ->color('warning'),
            Stat::make('مقبولة', (clone $bookings)->where('status', BookingStatus::ACCEPTED->value)->count())
                ->icon('heroicon-o-check-circle')
                ->color('success'),
            Stat::make('مرفوضة', (clone $bookings)->where('status', BookingStatus::REJECTED->value)->count())
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
