<?php

namespace App\Http\Controllers\Api\Office;

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

	/** GET /api/v1/office/bookings */
	public function index(Request $r)
	{
		$officeId = (int) $r->user()->id;
		$q = CvBooking::on('system')->where('office_id', $officeId)->orderByDesc('id');

		if ($r->filled('status')) $q->where('status', $r->input('status'));
		if ($r->filled('cv_id')) $q->where('cv_id', (int) $r->integer('cv_id'));
		if ($r->filled('nationality_code')) {
			$code = $r->input('nationality_code');
			$q->whereIn('cv_id', function ($sub) use ($code) {
				$sub->from('cvs')->select('id')->where('nationality_code', $code);
			});
		}

		$per = max(1, (int) $r->integer('per_page', 15));
		$p = $q->paginate($per)->appends($r->query());

		$cvIds = collect($p->items())->pluck('cv_id')->all();
		$cvs = Cv::on('system')->with(['nationality.translations'])->whereIn('id', $cvIds)->get()->keyBy('id');

		$data = collect($p->items())->map(function ($row) use ($cvs) {
			$cv = $cvs->get($row->cv_id);
			return [
				'id' => $row->id,
				'cv' => $cv ? new CvResource($cv) : null,
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
		return $this->responder->ok($result, 'Office bookings');
	}

	/** POST /api/v1/office/bookings/{id}/accept */
	public function accept(Request $r, int $id)
	{
		$officeId = (int) $r->user()->id;
		$row = CvBooking::on('system')->where('id', $id)->where('office_id', $officeId)->first();
		if (!$row) return $this->responder->fail('Not found', 404);
		if ($row->status !== BookingStatus::PENDING->value) {
			return $this->responder->fail('Only pending can be accepted', 422);
		}
		// Enforce max 3 active bookings on CV
		$activeCount = CvBooking::on('system')
			->where('cv_id', $row->cv_id)
			->whereIn('status', BookingStatus::activeStatuses())
			->count();
		if ($activeCount >= 3) {
			return $this->responder->fail('Booking limit reached for this CV', 422);
		}
		$row->status = BookingStatus::ACCEPTED->value;
		$row->save();
		return $this->responder->ok(null, 'Accepted');
	}

	/** POST /api/v1/office/bookings/{id}/reject */
	public function reject(Request $r, int $id)
	{
		$officeId = (int) $r->user()->id;
		$row = CvBooking::on('system')->where('id', $id)->where('office_id', $officeId)->first();
		if (!$row) return $this->responder->fail('Not found', 404);
		if ($row->status !== BookingStatus::PENDING->value) {
			return $this->responder->fail('Only pending can be rejected', 422);
		}
		$row->status = BookingStatus::REJECTED->value;
		$row->save();
		return $this->responder->ok(null, 'Rejected');
	}

	/** GET /api/v1/office/bookings/stats */
	public function stats(Request $r)
	{
		$officeId = (int) $r->user()->id;
		$base = CvBooking::on('system')->where('office_id', $officeId);
		$data = [
			'total' => (int) $base->count(),
			'pending' => (int) (clone $base)->where('status', BookingStatus::PENDING->value)->count(),
			'accepted' => (int) (clone $base)->where('status', BookingStatus::ACCEPTED->value)->count(),
			'rejected' => (int) (clone $base)->where('status', BookingStatus::REJECTED->value)->count(),
			'cancelled' => (int) (clone $base)->where('status', BookingStatus::CANCELLED->value)->count(),
		];
		return $this->responder->ok($data, 'Office booking stats');
	}
}


