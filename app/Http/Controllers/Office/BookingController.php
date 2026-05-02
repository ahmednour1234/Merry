<?php

namespace App\Http\Controllers\Office;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\CvBooking;
use App\Models\OfficeFcmToken;
use App\Models\Identity\EndUserFcmToken;
use App\Services\FcmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $office = Auth::guard('office-panel')->user();

        $query = CvBooking::on('system')
            ->with(['cv.nationality.translations'])
            ->where('office_id', $office->id)
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(15)->withQueryString();

        return view('office.bookings.index', compact('bookings'));
    }

    public function accept($id)
    {
        $office  = Auth::guard('office-panel')->user();
        $booking = CvBooking::on('system')
            ->where('office_id', $office->id)
            ->findOrFail($id);

        if ($booking->status !== BookingStatus::PENDING->value) {
            return back()->with('error', 'لا يمكن قبول هذا الحجز.');
        }

        $activeCount = CvBooking::on('system')
            ->where('cv_id', $booking->cv_id)
            ->whereIn('status', BookingStatus::activeStatuses())
            ->count();

        if ($activeCount >= 3) {
            return back()->with('error', 'تم الوصول للحد الأقصى من الحجوزات النشطة (3).');
        }

        $booking->update(['status' => BookingStatus::ACCEPTED->value]);

        // Notify EndUser via FCM (silently skip if table not yet migrated)
        try {
            $tokens = EndUserFcmToken::where('end_user_id', $booking->end_user_id)
                ->pluck('token')->toArray();
            if (!empty($tokens)) {
                app(FcmService::class)->sendToTokens(
                    'تم قبول حجزك',
                    'تم قبول طلب الحجز الخاص بك للسيرة الذاتية رقم ' . $booking->cv_id,
                    $tokens,
                    ['type' => 'booking_accepted', 'booking_id' => $booking->id]
                );
            }
        } catch (\Throwable) {}

        return back()->with('success', 'تم قبول الحجز بنجاح.');
    }

    public function reject($id)
    {
        $office  = Auth::guard('office-panel')->user();
        $booking = CvBooking::on('system')
            ->where('office_id', $office->id)
            ->findOrFail($id);

        if ($booking->status !== BookingStatus::PENDING->value) {
            return back()->with('error', 'لا يمكن رفض هذا الحجز.');
        }

        $booking->update(['status' => BookingStatus::REJECTED->value]);

        // Notify EndUser via FCM (silently skip if table not yet migrated)
        try {
            $tokens = EndUserFcmToken::where('end_user_id', $booking->end_user_id)
                ->pluck('token')->toArray();
            if (!empty($tokens)) {
                app(FcmService::class)->sendToTokens(
                    'تم رفض حجزك',
                    'تم رفض طلب الحجز الخاص بك للسيرة الذاتية رقم ' . $booking->cv_id,
                    $tokens,
                    ['type' => 'booking_rejected', 'booking_id' => $booking->id]
                );
            }
        } catch (\Throwable) {}

        return back()->with('success', 'تم رفض الحجز بنجاح.');
    }
}
