<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Models\CvBooking;
use App\Models\OfficeSubscription;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $office = Auth::guard('office-panel')->user();

        $cvsByStatus = Cv::on('system')
            ->where('office_id', $office->id)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $bookingsByStatus = CvBooking::on('system')
            ->where('office_id', $office->id)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $subscriptionHistory = OfficeSubscription::on('system')
            ->with('plan.translations')
            ->where('office_id', $office->id)
            ->orderByDesc('created_at')
            ->get();

        return view('office.reports', compact('cvsByStatus', 'bookingsByStatus', 'subscriptionHistory'));
    }
}
