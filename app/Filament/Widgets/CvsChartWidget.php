<?php

namespace App\Filament\Widgets;

use App\Models\Cv;
use Filament\Widgets\ChartWidget;

class CvsChartWidget extends ChartWidget
{
    protected static ?int $sort = 3;

    public function getHeading(): string
    {
        return 'إحصائيات السير الذاتية';
    }

    protected function getData(): array
    {
        $last7Days = collect(range(6, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo)->startOfDay();
            return [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('d/m'),
                'pending' => Cv::where('status', 'pending')
                    ->whereDate('created_at', $date)
                    ->count(),
                'approved' => Cv::where('status', 'approved')
                    ->whereDate('created_at', $date)
                    ->count(),
                'rejected' => Cv::where('status', 'rejected')
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
                    'label' => 'موافق عليها',
                    'data' => $last7Days->pluck('approved')->toArray(),
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
        return 'bar';
    }
}
