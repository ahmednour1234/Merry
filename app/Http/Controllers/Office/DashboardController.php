<?php

namespace App\Http\Controllers\Office;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Models\CvBooking;
use App\Models\Identity\FavouriteCv;
use App\Models\Nationality;
use App\Models\OfficeSubscription;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $office = Auth::guard('office-panel')->user();

        // ── Stat cards ──────────────────────────────────────────────────
        $totalCvs = Cv::on('system')->where('office_id', $office->id)->count();
        $pendingCvs = Cv::on('system')->where('office_id', $office->id)->where('status', 'pending')->count();

        $totalBookings = CvBooking::on('system')->where('office_id', $office->id)->count();
        $activeBookings = CvBooking::on('system')
            ->where('office_id', $office->id)
            ->whereIn('status', BookingStatus::activeStatuses())
            ->count();

        $cvIds = Cv::on('system')->where('office_id', $office->id)->pluck('id')->toArray();
        $totalFavorites = empty($cvIds) ? 0 : FavouriteCv::on('identity')
            ->whereIn('cv_id', array_values($cvIds))
            ->count();

        // ── Active subscription ──────────────────────────────────────────
        $activeSubscription = OfficeSubscription::on('system')
            ->with(['plan.translations'])
            ->where('office_id', $office->id)
            ->where('active', true)
            ->orderByDesc('ends_at')
            ->first();

        // ── Subscription counts for donut chart ─────────────────────────
        $subscriptionCounts = [
            'active'    => OfficeSubscription::on('system')->where('office_id', $office->id)->where('status', 'active')->count(),
            'pending'   => OfficeSubscription::on('system')->where('office_id', $office->id)->where('status', 'pending')->count(),
            'cancelled' => OfficeSubscription::on('system')->where('office_id', $office->id)->where('status', 'cancelled')->count(),
            'expired'   => OfficeSubscription::on('system')->where('office_id', $office->id)->where('status', 'expired')->count(),
        ];
        $totalSubscriptions = array_sum($subscriptionCounts);

        // ── Recent CVs ───────────────────────────────────────────────────
        $recentCvs = Cv::on('system')
            ->with(['nationality.translations', 'category'])
            ->where('office_id', $office->id)
            ->latest()
            ->limit(10)
            ->get();

        // ── Recent uploaded files (CVs with files) ───────────────────────
        $recentFiles = Cv::on('system')
            ->where('office_id', $office->id)
            ->whereNotNull('file_path')
            ->latest()
            ->limit(5)
            ->get(['id', 'file_path', 'file_original_name', 'file_size', 'file_mime', 'created_at']);

        // ── Subscription plan name helper ────────────────────────────────
        $planName = null;
        $daysLeft = null;
        if ($activeSubscription) {
            $planName = $activeSubscription->plan?->translations->where('lang_code', 'ar')->first()?->name
                ?? $activeSubscription->plan?->translations->first()?->name
                ?? $activeSubscription->plan_code;
            $daysLeft = (int) round(now()->diffInDays($activeSubscription->ends_at, false));
        }

        return view('office.dashboard', compact(
            'office',
            'totalCvs',
            'pendingCvs',
            'totalBookings',
            'activeBookings',
            'totalFavorites',
            'activeSubscription',
            'subscriptionCounts',
            'totalSubscriptions',
            'recentCvs',
            'recentFiles',
            'planName',
            'daysLeft'
        ));
    }
}
