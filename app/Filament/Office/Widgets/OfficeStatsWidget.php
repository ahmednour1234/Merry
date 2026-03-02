<?php

namespace App\Filament\Office\Widgets;

use App\Enums\BookingStatus;
use App\Models\Cv;
use App\Models\CvBooking;
use App\Models\Identity\FavouriteCv;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class OfficeStatsWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected function getStats(): array
    {
        $office = Auth::guard('office-panel')->user();

        $totalCvs = Cv::on('system')->where('office_id', $office->id)->count();
        $activeCvs = Cv::on('system')
            ->where('office_id', $office->id)
            ->where('status', 'approved')
            ->whereNull('deactivated_by_office_at')
            ->count();

        $totalBookings = CvBooking::on('system')
            ->where('office_id', $office->id)
            ->count();

        $activeBookings = CvBooking::on('system')
            ->where('office_id', $office->id)
            ->whereIn('status', BookingStatus::activeStatuses())
            ->count();

        $totalFavorites = FavouriteCv::on('identity')
            ->whereIn('cv_id', function ($query) use ($office) {
                $query->select('id')
                    ->from('system.cvs')
                    ->where('office_id', $office->id);
            })
            ->count();

        return [
            Stat::make('إجمالي السير الذاتية', $totalCvs)
                ->description("نشط: {$activeCvs}")
                ->icon('heroicon-o-document-text')
                ->color('primary'),
            
            Stat::make('إجمالي الحجوزات', $totalBookings)
                ->description("نشط: {$activeBookings}")
                ->icon('heroicon-o-calendar')
                ->color('info'),
            
            Stat::make('إجمالي المفضلة', $totalFavorites)
                ->description('عدد مرات إضافة سيرك للمفضلة')
                ->icon('heroicon-o-heart')
                ->color('danger'),
        ];
    }
}
