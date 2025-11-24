<?php

namespace App\Http\Controllers\Api\EndUser;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\CategoryResource;
use App\Http\Resources\System\CityResource;
use App\Http\Resources\System\CurrencyResource;
use App\Http\Resources\System\CvResource;
use App\Http\Resources\Office\OfficeResource;
use App\Models\Category;
use App\Models\City;
use App\Models\Currency;
use App\Models\Cv;
use App\Models\Office;
use App\Models\Identity\FavouriteCv;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CatalogController extends ApiController
{
    public function __construct()
    {
        parent::__construct(app('api.responder'));
    }

    public function cities(Request $request)
    {
        $query = City::on('system')
            ->with('translations')
            ->where('active', true);

        if ($country = $request->input('country')) {
            $query->where('country_code', $country);
        }

        if ($search = $request->input('q')) {
            $query->whereHas('translations', function (Builder $builder) use ($search) {
                $builder->where('name', 'like', '%' . $search . '%');
            });
        }

        $query->orderBy('slug');

        $perPage = (int) $request->integer('per_page', 25);
        if ($request->boolean('all') || $perPage <= 0) {
            $collection = $query->get();
            return $this->responder->ok(
                CityResource::collection($collection),
                'Cities list',
                ['pagination' => null]
            );
        }

        $paginator = $query->paginate(max(1, $perPage))->appends($request->query());
        $paginator->getCollection()->load('translations');

        return $this->responder->paginated($paginator, CityResource::class, 'Cities list');
    }

    public function currencies(Request $request)
    {
        $query = Currency::on('system')
            ->where('active', true)
            ->orderBy('code');

        if ($search = $request->input('q')) {
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('code', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%');
            });
        }

        $perPage = (int) $request->integer('per_page', 25);
        if ($request->boolean('all') || $perPage <= 0) {
            $collection = $query->get();
            return $this->responder->ok(
                CurrencyResource::collection($collection),
                'Currencies list',
                ['pagination' => null]
            );
        }

        $paginator = $query->paginate(max(1, $perPage))->appends($request->query());

        return $this->responder->paginated($paginator, CurrencyResource::class, 'Currencies list');
    }

    public function categories(Request $request)
    {
        $query = Category::on('system')
            ->with('translations')
            ->withCount('children')
            ->where('active', true)
            ->orderBy('name');

        if ($search = $request->input('q')) {
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('name', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%')
                    ->orWhereHas('translations', function (Builder $translation) use ($search) {
                        $translation->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($parentId = $request->input('parent_id')) {
            $query->where('parent_id', $parentId);
        }

        $perPage = (int) $request->integer('per_page', 25);
        if ($request->boolean('all') || $perPage <= 0) {
            $collection = $query->get();
            return $this->responder->ok(
                CategoryResource::collection($collection),
                'Categories list',
                ['pagination' => null]
            );
        }

        $paginator = $query->paginate(max(1, $perPage))->appends($request->query());
        $paginator->getCollection()->load('translations');

        return $this->responder->paginated($paginator, CategoryResource::class, 'Categories list');
    }

    public function offices(Request $request)
    {
        $query = Office::on('system')
            ->where('active', true)
            ->where('blocked', false)
            ->orderByDesc('created_at');

        if ($search = $request->input('q')) {
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('name', 'like', '%' . $search . '%')
                    ->orWhere('commercial_reg_no', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if ($cityId = $request->input('city_id')) {
            $query->where('city_id', $cityId);
        }

        $perPage = (int) $request->integer('per_page', 25);
        if ($request->boolean('all') || $perPage <= 0) {
            $collection = $query->get();
            return $this->responder->ok(
                OfficeResource::collection($collection),
                'Offices list',
                ['pagination' => null]
            );
        }

        $paginator = $query->paginate(max(1, $perPage))->appends($request->query());

        return $this->responder->paginated($paginator, OfficeResource::class, 'Offices list');
    }

    public function cvs(Request $request)
    {
        $query = Cv::on('system')
            ->with(['office', 'category', 'nationality.translations'])
            ->where('status', 'approved')
            ->whereNull('deactivated_by_office_at')
            ->orderByDesc('created_at');

        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        if ($officeId = $request->input('office_id')) {
            $query->where('office_id', $officeId);
        }

        if ($nationality = $request->input('nationality_code')) {
            $query->where('nationality_code', $nationality);
        }

        if ($gender = $request->input('gender')) {
            $query->where('gender', $gender);
        }

        if ($request->filled('has_experience')) {
            $hasExperience = filter_var($request->input('has_experience'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if ($hasExperience !== null) {
                $query->where('has_experience', $hasExperience);
            }
        }

        if ($request->filled('is_muslim')) {
            $isMuslim = filter_var($request->input('is_muslim'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if ($isMuslim !== null) {
                $query->where('is_muslim', $isMuslim);
            }
        }

        if ($request->filled('name')) {
            $name = trim((string) $request->input('name'));
            $query->where(function (Builder $builder) use ($name) {
                $builder
                    ->where('meta->name', 'like', '%' . $name . '%')
                    ->orWhere('meta->full_name', 'like', '%' . $name . '%');
            });
        }

        $perPage = (int) $request->integer('per_page', 15);
        if ($request->boolean('all') || $perPage <= 0) {
            $collection = $query->get();
            return $this->responder->ok(
                CvResource::collection($collection),
                'CVs list',
                ['pagination' => null]
            );
        }

        $paginator = $query->paginate(max(1, $perPage))->appends($request->query());

        return $this->responder->paginated($paginator, CvResource::class, 'CVs list');
    }

	/**
	 * GET /api/v1/enduser/top-offices
	 * Returns top offices by number of favourites on their CVs
	 */
	public function topOffices(Request $request)
	{
		$limit = max(1, (int) $request->integer('limit', 10));

		// Count favourites per office by mapping favourites -> CV -> office_id
		$topCv = FavouriteCv::on('identity')
			->selectRaw('cv_id, COUNT(*) as favs')
			->groupBy('cv_id')
			->orderByDesc('favs')
			->limit(200) // cap to reduce load then aggregate by office
			->get();

		if ($topCv->isEmpty()) {
			return $this->responder->ok([], 'Top offices');
		}

		$cvIds = $topCv->pluck('cv_id')->all();
		$cvs   = \App\Models\Cv::on('system')->whereIn('id', $cvIds)->get(['id','office_id']);
		$cvToOffice = [];
		foreach ($cvs as $cv) {
			$cvToOffice[$cv->id] = (int) $cv->office_id;
		}

		$officeCounts = [];
		foreach ($topCv as $row) {
			$officeId = $cvToOffice[$row->cv_id] ?? null;
			if ($officeId) {
				$officeCounts[$officeId] = ($officeCounts[$officeId] ?? 0) + (int) $row->favs;
			}
		}

		arsort($officeCounts);
		$officeIds = array_slice(array_keys($officeCounts), 0, $limit);

		if (empty($officeIds)) {
			return $this->responder->ok([], 'Top offices');
		}

		$offices = Office::on('system')
			->whereIn('id', $officeIds)
			->where('active', true)
			->where('blocked', false)
			->get();

		// Preserve ranking order
		$offices = $offices->sortBy(function ($o) use ($officeCounts) {
			return -($officeCounts[$o->id] ?? 0);
		})->values();

		return $this->responder->ok(OfficeResource::collection($offices), 'Top offices');
	}
}


