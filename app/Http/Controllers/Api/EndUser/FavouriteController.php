<?php

namespace App\Http\Controllers\Api\EndUser;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\CvResource;
use App\Models\Cv;
use App\Models\Identity\FavouriteCv;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FavouriteController extends ApiController
{
	public function __construct()
	{
		parent::__construct(app('api.responder'));
	}

	/** GET /api/v1/enduser/favorites/cvs */
	public function index(Request $request)
	{
		$userId = (int) $request->user()->id;
		$per    = max(1, (int) $request->integer('per_page', 15));

		$ids = FavouriteCv::on('identity')
			->where('end_user_id', $userId)
			->orderByDesc('id')
			->pluck('cv_id')
			->all();

		if (empty($ids)) {
			return $this->responder->paginated(
				new \Illuminate\Pagination\LengthAwarePaginator([], 0, $per, 1),
				CvResource::class,
				'Favorites'
			);
		}

		$q = Cv::on('system')->whereIn('id', $ids)->orderByDesc('id');
		$p = $q->paginate($per)->appends($request->query());
		return $this->responder->paginated($p, CvResource::class, 'Favorites');
	}

	/** POST /api/v1/enduser/favorites/cvs */
	public function store(Request $request)
	{
		$data = $request->validate([
			'cv_id' => ['required', 'integer', Rule::exists('system.cvs', 'id')],
		]);

		$userId = (int) $request->user()->id;
		$cvId   = (int) $data['cv_id'];

		$exists = FavouriteCv::on('identity')
			->where('end_user_id', $userId)
			->where('cv_id', $cvId)
			->exists();

		if ($exists) {
			return $this->responder->ok(null, 'Already in favorites');
		}

		FavouriteCv::on('identity')->create([
			'end_user_id' => $userId,
			'cv_id' => $cvId,
		]);

		return $this->responder->created(null, 'Added to favorites');
	}

	/** DELETE /api/v1/enduser/favorites/cvs/{cvId} */
	public function destroy(Request $request, int $cvId)
	{
		$userId = (int) $request->user()->id;

		FavouriteCv::on('identity')
			->where('end_user_id', $userId)
			->where('cv_id', (int) $cvId)
			->delete();

		return $this->responder->ok(null, 'Removed from favorites');
	}
}


