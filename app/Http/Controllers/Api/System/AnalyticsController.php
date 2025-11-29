<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Models\Office;
use App\Models\Cv;
use App\Models\CvBooking;
use App\Models\Identity\FavouriteCv;
use Illuminate\Http\Request;

class AnalyticsController extends ApiController
{
	public function __construct()
	{
		parent::__construct(app('api.responder'));
	}

	/**
	 * GET /api/v1/admin/system/analytics
	 * @group System / Analytics
	 * @queryParam from date Filter range start (inclusive). Example: 2025-11-01
	 * @queryParam to date Filter range end (inclusive). Example: 2025-11-30
	 * @queryParam office_id integer Optional filter for office-specific bookings. Example: 5
	 */
	public function index(Request $r)
	{
		$from = $r->filled('from') ? $r->date('from') : null;
		$to   = $r->filled('to')   ? $r->date('to')   : null;
		$officeId = $r->filled('office_id') ? (int) $r->integer('office_id') : null;

		$offices = Office::on('system');
		if ($from) $offices->where('created_at', '>=', $from);
		if ($to)   $offices->where('created_at', '<=', $to);

		$cvs = Cv::on('system');
		if ($from) $cvs->where('created_at', '>=', $from);
		if ($to)   $cvs->where('created_at', '<=', $to);

		$bookings = CvBooking::on('system');
		if ($officeId) $bookings->where('office_id', $officeId);
		if ($from) $bookings->where('created_at', '>=', $from);
		if ($to)   $bookings->where('created_at', '<=', $to);

		$favs = FavouriteCv::on('identity');
		if ($from) $favs->where('created_at', '>=', $from);
		if ($to)   $favs->where('created_at', '<=', $to);

		$data = [
			'offices_total'   => (int) (clone $offices)->count(),
			'offices_active'  => (int) (clone $offices)->where('active', true)->count(),
			'offices_blocked' => (int) (clone $offices)->where('blocked', true)->count(),

			'cvs_total'     => (int) (clone $cvs)->count(),
			'cvs_pending'   => (int) (clone $cvs)->where('status', 'pending')->count(),
			'cvs_approved'  => (int) (clone $cvs)->where('status', 'approved')->count(),
			'cvs_rejected'  => (int) (clone $cvs)->where('status', 'rejected')->count(),

			'bookings_total'    => (int) (clone $bookings)->count(),
			'bookings_pending'  => (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::PENDING->value)->count(),
			'bookings_accepted' => (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::ACCEPTED->value)->count(),
			'bookings_rejected' => (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::REJECTED->value)->count(),
			'bookings_cancelled'=> (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::CANCELLED->value)->count(),

			'favourites_total'  => (int) $favs->count(),
		];

		return $this->responder->ok($data, 'System analytics');
	}
}


