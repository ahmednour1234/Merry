<?php

namespace App\Http\Controllers\Api\EndUser;

use App\Http\Controllers\Api\ApiController;
use App\Models\Identity\FavouriteCv;
use App\Models\CvBooking;
use Illuminate\Http\Request;

class AnalyticsController extends ApiController
{
	public function __construct()
	{
		parent::__construct(app('api.responder'));
	}

	/**
	 * GET /api/v1/enduser/analytics
	 * @group EndUser / Analytics
	 * @queryParam from date Filter range start (inclusive). Example: 2025-11-01
	 * @queryParam to date Filter range end (inclusive). Example: 2025-11-30
	 */
	public function index(Request $r)
	{
		$userId = (int) $r->user()->id;
		$from = $r->filled('from') ? $r->date('from') : null;
		$to   = $r->filled('to')   ? $r->date('to')   : null;

		$bookings = CvBooking::on('system')->where('end_user_id', $userId);
		if ($from) $bookings->where('created_at', '>=', $from);
		if ($to)   $bookings->where('created_at', '<=', $to);

		$favs = FavouriteCv::on('identity')->where('end_user_id', $userId);
		if ($from) $favs->where('created_at', '>=', $from);
		if ($to)   $favs->where('created_at', '<=', $to);

		$data = [
			'bookings_total'    => (int) (clone $bookings)->count(),
			'bookings_pending'  => (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::PENDING->value)->count(),
			'bookings_accepted' => (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::ACCEPTED->value)->count(),
			'bookings_rejected' => (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::REJECTED->value)->count(),
			'bookings_cancelled'=> (int) (clone $bookings)->where('status', \App\Enums\BookingStatus::CANCELLED->value)->count(),
			'favourites_total'  => (int) $favs->count(),
		];

		return $this->responder->ok($data, 'EndUser analytics');
	}
}


