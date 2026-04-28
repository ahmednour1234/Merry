<?php

namespace App\Http\Controllers\Office;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\CvBooking;
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

    public function reject($id)
    {
        $office  = Auth::guard('office-panel')->user();
        $booking = CvBooking::on('system')
            ->where('office_id', $office->id)
            ->findOrFail($id);

        $booking->update(['status' => BookingStatus::REJECTED->value]);

        return back()->with('success', 'تم رفض الحجز بنجاح.');
    }
}
