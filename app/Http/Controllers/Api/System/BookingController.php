<?php

namespace App\Http\Controllers\Api\System;

use App\Enums\BookingStatus;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\CvResource;
use App\Models\Cv;
use App\Models\CvBooking;
use Illuminate\Http\Request;

class BookingController extends ApiController
{
	public function __construct()
	{
		parent::__construct(app('api.responder'));
	}

	/**
	 * GET /api/v1/admin/system/bookings
	 * @group System / Bookings
	 * @queryParam status string Filter by status. Example: pending
	 * @queryParam cv_id integer Filter by CV ID. Example: 22
	 * @queryParam office_id integer Filter by office ID. Example: 5
	 * @queryParam nationality_code string Filter by CV nationality code. Example: BD
	 * @queryParam from date Filter by created_at from (inclusive). Example: 2025-11-01
	 * @queryParam to date Filter by created_at to (inclusive). Example: 2025-11-30
	 * @queryParam per_page integer Results per page. Example: 15
	 */
	public function index(Request $r)
	{
		$q = CvBooking::on('system')->orderByDesc('id');

		if ($r->filled('status')) $q->where('status', $r->input('status'));
		if ($r->filled('cv_id')) $q->where('cv_id', (int) $r->integer('cv_id'));
		if ($r->filled('office_id')) $q->where('office_id', (int) $r->integer('office_id'));
		if ($r->filled('nationality_code')) {
			$code = $r->input('nationality_code');
			$q->whereIn('cv_id', function ($sub) use ($code) {
				$sub->from('cvs')->select('id')->where('nationality_code', $code);
			});
		}
		if ($r->filled('from')) $q->where('created_at', '>=', $r->date('from'));
		if ($r->filled('to'))   $q->where('created_at', '<=', $r->date('to'));

		$per = max(1, (int) $r->integer('per_page', 15));
		$p = $q->paginate($per)->appends($r->query());

		$cvIds = collect($p->items())->pluck('cv_id')->all();
		$cvs = Cv::on('system')->with(['nationality.translations'])->whereIn('id', $cvIds)->get()->keyBy('id');

		$data = collect($p->items())->map(function ($row) use ($cvs) {
			$cv = $cvs->get($row->cv_id);
			return [
				'id' => $row->id,
				'cv' => $cv ? new CvResource($cv) : null,
				'office_id' => $row->office_id,
				'end_user_id' => $row->end_user_id,
				'status' => $row->status,
				'note' => $row->note,
				'created_at' => optional($row->created_at)->toIso8601String(),
			];
		});

		$result = [
			'data' => $data,
			'meta' => [
				'current_page' => $p->currentPage(),
				'last_page' => $p->lastPage(),
				'per_page' => $p->perPage(),
				'total' => $p->total(),
			],
		];
		return $this->responder->ok($result, 'Bookings');
	}

	/** GET /api/v1/admin/system/bookings/stats */
	public function stats(Request $r)
	{
		$base = CvBooking::on('system');
		if ($r->filled('office_id')) {
			$base->where('office_id', (int) $r->integer('office_id'));
		}
		$data = [
			'total' => (int) $base->count(),
			'pending' => (int) (clone $base)->where('status', BookingStatus::PENDING->value)->count(),
			'accepted' => (int) (clone $base)->where('status', BookingStatus::ACCEPTED->value)->count(),
			'rejected' => (int) (clone $base)->where('status', BookingStatus::REJECTED->value)->count(),
			'cancelled' => (int) (clone $base)->where('status', BookingStatus::CANCELLED->value)->count(),
		];
		return $this->responder->ok($data, 'Booking stats');
	}
}


