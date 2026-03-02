<?php

namespace App\Filament\Office\Widgets;

use App\Enums\BookingStatus;
use App\Models\CvBooking;
use App\Models\Nationality;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class TopNationalitiesWidget extends Widget
{
    protected string $view = 'filament.office.widgets.top-nationalities-widget';
    protected static ?int $sort = 3;

    public function getViewData(): array
    {
        $office = Auth::guard('office-panel')->user();

        $bookings = CvBooking::on('system')
            ->with('cv.nationality.translations')
            ->where('office_id', $office->id)
            ->whereIn('status', BookingStatus::activeStatuses())
            ->get();

        $nationalityCounts = [];
        foreach ($bookings as $booking) {
            if ($booking->cv && $booking->cv->nationality_code) {
                $code = $booking->cv->nationality_code;
                $nationalityCounts[$code] = ($nationalityCounts[$code] ?? 0) + 1;
            }
        }

        arsort($nationalityCounts);
        $topNationalities = array_slice($nationalityCounts, 0, 10, true);

        $data = [];
        foreach ($topNationalities as $code => $count) {
            $nationality = Nationality::on('system')
                ->with('translations')
                ->where('code', $code)
                ->first();
            
            $name = $code;
            if ($nationality) {
                $translation = $nationality->translations->where('lang_code', 'ar')->first()
                    ?? $nationality->translations->first();
                $name = $translation?->name ?? $nationality->name ?? $code;
            }

            $data[] = [
                'code' => $code,
                'name' => $name,
                'count' => $count,
            ];
        }

        return ['nationalities' => $data];
    }
}
