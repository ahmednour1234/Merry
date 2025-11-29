<?php

namespace App\Http\Controllers\Api\EndUser;

use App\Enums\BookingStatus;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\CvResource;
use App\Models\Cv;
use App\Models\CvBooking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookingController extends ApiController
{
	public function __construct()
	{
		parent::__construct(app('api.responder'));
	}

	/**
	 * GET /api/v1/enduser/bookings
	 * @group EndUser / Bookings
	 * @queryParam status string Filter by status. Example: pending
	 * @queryParam cv_id integer Filter by CV ID. Example: 12
	 * @queryParam nationality_code string Filter by CV nationality code. Example: PH
	 * @queryParam from date Filter by created_at from (inclusive). Example: 2025-11-01
	 * @queryParam to date Filter by created_at to (inclusive). Example: 2025-11-30
	 * @queryParam per_page integer Results per page. Example: 15
	 */
	public function index(Request $r)
	{
		$userId = (int) $r->user()->id;
		$q = CvBooking::on('system')->where('end_user_id', $userId)->orderByDesc('id');

		if ($r->filled('status')) $q->where('status', $r->input('status'));
		if ($r->filled('cv_id')) $q->where('cv_id', (int) $r->integer('cv_id'));
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

		// Attach CV details
		$cvIds = collect($p->items())->pluck('cv_id')->all();
		$cvs = Cv::on('system')->with(['nationality.translations'])->whereIn('id', $cvIds)->get()->keyBy('id');

		$data = collect($p->items())->map(function ($row) use ($cvs) {
			$cv = $cvs->get($row->cv_id);
			return [
				'id' => $row->id,
				'cv' => $cv ? new CvResource($cv) : null,
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
		return $this->responder->ok($result, 'My bookings');
	}

	/** POST /api/v1/enduser/bookings */
	public function store(Request $r)
	{
		$data = $r->validate([
			'cv_id' => ['required','integer', Rule::exists('system.cvs','id')],
			'note'  => ['nullable','string'],
		]);
		$cv = Cv::on('system')->find((int) $data['cv_id']);
		if (!$cv || $cv->status !== 'approved' || $cv->deactivated_by_office_at) {
			return $this->responder->fail('CV not available', 422);
		}

		$userId = (int) $r->user()->id;

		// Prevent duplicate booking by same user
		$dup = CvBooking::on('system')
			->where('cv_id', $cv->id)
			->where('end_user_id', $userId)
			->whereIn('status', BookingStatus::activeStatuses())
			->exists();
		if ($dup) {
			return $this->responder->fail('Already booked', 409);
		}

		// Enforce max 3 active bookings per CV
		$activeCount = CvBooking::on('system')
			->where('cv_id', $cv->id)
			->whereIn('status', BookingStatus::activeStatuses())
			->count();
		if ($activeCount >= 3) {
			return $this->responder->fail('Booking limit reached for this CV', 422);
		}

		$row = CvBooking::on('system')->create([
			'cv_id' => $cv->id,
			'office_id' => (int) $cv->office_id,
			'end_user_id' => $userId,
			'status' => BookingStatus::PENDING->value,
			'note' => $data['note'] ?? null,
		]);

		return $this->responder->created(['id' => $row->id], 'Booking created');
	}

	/** POST /api/v1/enduser/bookings/{id}/cancel */
	public function cancel(Request $r, int $id)
	{
		$userId = (int) $r->user()->id;
		$row = CvBooking::on('system')->where('id', $id)->where('end_user_id', $userId)->first();
		if (!$row) return $this->responder->fail('Not found', 404);
		if (!in_array($row->status, [BookingStatus::PENDING->value, BookingStatus::ACCEPTED->value], true)) {
			return $this->responder->fail('Cannot cancel this booking', 422);
		}
		$row->status = BookingStatus::CANCELLED->value;
		$row->save();
		return $this->responder->ok(null, 'Booking cancelled');
	}

	/** GET /api/v1/enduser/bookings/stats */
	public function stats(Request $r)
	{
		$userId = (int) $r->user()->id;
		$base = CvBooking::on('system')->where('end_user_id', $userId);
		$data = [
			'total' => (int) $base->count(),
			'pending' => (int) (clone $base)->where('status', BookingStatus::PENDING->value)->count(),
			'accepted' => (int) (clone $base)->where('status', BookingStatus::ACCEPTED->value)->count(),
			'rejected' => (int) (clone $base)->where('status', BookingStatus::REJECTED->value)->count(),
			'cancelled' => (int) (clone $base)->where('status', BookingStatus::CANCELLED->value)->count(),
		];
		return $this->responder->ok($data, 'My booking stats');
	}
}


