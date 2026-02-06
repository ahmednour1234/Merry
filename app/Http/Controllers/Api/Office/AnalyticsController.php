<?php

namespace App\Http\Controllers\Api\Office;

use App\Http\Controllers\Api\ApiController;
use App\Models\Cv;
use App\Models\CvBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends ApiController
{
	public function __construct()
	{
		parent::__construct(app('api.responder'));
	}

	/**
	 * GET /api/v1/office/analytics
	 * @group Office / Analytics
	 * @queryParam from date Filter range start (inclusive). Example: 2025-11-01
	 * @queryParam to date Filter range end (inclusive). Example: 2025-11-30
	 */
	public function index(Request $r)
	{
		$officeId = (int) $r->user()->id;
		$from = $r->filled('from') ? $r->date('from') : null;
		$to   = $r->filled('to')   ? $r->date('to')   : null;

		$cvs = Cv::on('system')->where('office_id', $officeId);
		if ($from) $cvs->where('created_at', '>=', $from);
		if ($to)   $cvs->where('created_at', '<=', $to);

		$bookings = CvBooking::on('system')->where('office_id', $officeId);
		if ($from) $bookings->where('created_at', '>=', $from);
		if ($to)   $bookings->where('created_at', '<=', $to);

		$data = [
			'cvs_total'     => (int) (clone $cvs)->count(),
			'cvs_pending'   => (int) (clone $cvs)->where('status', 'pending')->count(),
			'cvs_approved'  => (int) (clone $cvs)->where('status', 'approved')->count(),
			'cvs_rejected'  => (int) (clone $cvs)->where('status', 'rejected')->count(),
			'bookings_total'    => (int) (clone $bookings)->count(),
			'bookings_pending'  => (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::PENDING->value)->count(),
			'bookings_accepted' => (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::ACCEPTED->value)->count(),
			'bookings_rejected' => (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::REJECTED->value)->count(),
			'bookings_cancelled'=> (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::CANCELLED->value)->count(),
		];

		return $this->responder->ok($data, 'Office analytics');
	}
}


