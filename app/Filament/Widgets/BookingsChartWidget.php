<?php

namespace App\Filament\Widgets;

use App\Enums\BookingStatus;
use App\Models\CvBooking;
use Filament\Widgets\ChartWidget;

class BookingsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'إحصائيات الحجوزات';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $last7Days = collect(range(6, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo)->startOfDay();
            return [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('d/m'),
                'pending' => CvBooking::on('system')
                    ->where('status', BookingStatus::PENDING->value)
                    ->whereDate('created_at', $date)
                    ->count(),
                'accepted' => CvBooking::on('system')
                    ->where('status', BookingStatus::ACCEPTED->value)
                    ->whereDate('created_at', $date)
                    ->count(),
                'rejected' => CvBooking::on('system')
                    ->where('status', BookingStatus::REJECTED->value)
                    ->whereDate('created_at', $date)
                    ->count(),
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => 'قيد الانتظار',
                    'data' => $last7Days->pluck('pending')->toArray(),
                    'backgroundColor' => 'rgba(251, 191, 36, 0.2)',
                    'borderColor' => 'rgb(251, 191, 36)',
                ],
                [
                    'label' => 'مقبولة',
                    'data' => $last7Days->pluck('accepted')->toArray(),
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'borderColor' => 'rgb(34, 197, 94)',
                ],
                [
                    'label' => 'مرفوضة',
                    'data' => $last7Days->pluck('rejected')->toArray(),
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)',
                    'borderColor' => 'rgb(239, 68, 68)',
                ],
            ],
            'labels' => $last7Days->pluck('label')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
