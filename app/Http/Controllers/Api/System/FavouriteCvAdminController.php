<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Models\Cv;
use App\Models\Identity\FavouriteCv;
use Illuminate\Http\Request;

class FavouriteCvAdminController extends ApiController
{
	public function __construct()
	{
		parent::__construct(app('api.responder'));
	}

	/** GET /api/v1/admin/system/favorites/cv */
	public function index(Request $r)
	{
		$q = FavouriteCv::on('identity')->orderByDesc('id');

		if ($r->filled('end_user_id')) {
			$q->where('end_user_id', (int) $r->integer('end_user_id'));
		}
		if ($r->filled('cv_id')) {
			$q->where('cv_id', (int) $r->integer('cv_id'));
		}

		$per = max(1, (int) $r->integer('per_page', 15));
		$p   = $q->paginate($per)->appends($r->query());

		return $this->responder->ok($p->toArray(), 'Favourites CV list');
	}

	/** GET /api/v1/admin/system/favorites/cv/stats */
	public function stats(Request $r)
	{
		// Top CVs by favorites
		$rawTopCvs = FavouriteCv::on('identity')
			->selectRaw('cv_id, COUNT(*) as favs')
			->groupBy('cv_id')
			->orderByDesc('favs')
			->limit(10)
			->get();

		$cvIds = $rawTopCvs->pluck('cv_id')->all();
		$cvs   = Cv::on('system')->whereIn('id', $cvIds)->get(['id','office_id','meta']);
		$cvIdToOffice = [];
		foreach ($cvs as $cv) {
			$cvIdToOffice[$cv->id] = (int) $cv->office_id;
		}

		// Aggregate by office
		$officeCounts = [];
		foreach ($rawTopCvs as $row) {
			$officeId = $cvIdToOffice[$row->cv_id] ?? null;
			if ($officeId) {
				$officeCounts[$officeId] = ($officeCounts[$officeId] ?? 0) + (int) $row->favs;
			}
		}
		arsort($officeCounts);
		$topOffices = [];
		foreach (array_slice($officeCounts, 0, 10, true) as $officeId => $favs) {
			$topOffices[] = ['office_id' => $officeId, 'favs' => $favs];
		}

		return $this->responder->ok([
			'top_cvs' => $rawTopCvs,
			'top_offices_by_favs' => $topOffices,
			'total_favourites' => (int) FavouriteCv::on('identity')->count(),
		], 'Favourites stats');
	}
}


