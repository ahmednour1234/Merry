<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\PublicOfficeResource;
use App\Http\Resources\System\CvResource;
use App\Services\OfficeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Public / Offices
 *
 * Public endpoints — no authentication required.
 */
class OfficeController extends ApiController
{
    public function __construct(
        private OfficeService $service,
        \App\Support\Api\ApiResponder $responder
    ) {
        parent::__construct($responder);
    }

    /**
     * List active offices
     *
     * Returns a paginated list of all active (non-blocked) offices.
     *
     * @queryParam q string Search by name. Example: مكتب
     * @queryParam city_id int Filter by city ID. Example: 3
     * @queryParam per_page int Items per page (default 15). Example: 15
     */
    public function index(Request $request): JsonResponse
    {
        $filters  = $request->only(['q', 'city_id']);
        $perPage  = (int) $request->input('per_page', 15);
        $offices  = $this->service->listActive($filters, max(1, min($perPage, 100)));

        return $this->responder->paginated($offices, PublicOfficeResource::class, 'offices');
    }

    /**
     * Show an office
     *
     * Returns details of a single active office by its ID.
     *
     * @urlParam id int required The office ID. Example: 1
     */
    public function show(int $id): JsonResponse
    {
        $office = $this->service->findOrFail($id);

        return $this->responder->item(PublicOfficeResource::make($office), 'office');
    }

    /**
     * Office profile
     *
     * Returns the public profile of an active office (same data as show, extendable).
     *
     * @urlParam id int required The office ID. Example: 1
     */
    public function profile(int $id): JsonResponse
    {
        $office = $this->service->findOrFail($id);

        return $this->responder->item(PublicOfficeResource::make($office), 'office');
    }

    /**
     * Office available CVs
     *
     * Returns paginated approved & unbooked CVs belonging to a specific office.
     *
     * @urlParam id int required The office ID. Example: 1
     * @queryParam nationality_code string Filter by nationality code (ISO 2). Example: PH
     * @queryParam gender string Filter by gender (male|female). Example: female
     * @queryParam has_experience bool Filter by experience flag. Example: 1
     * @queryParam is_muslim bool Filter by religion flag. Example: 1
     * @queryParam category_id int Filter by category ID. Example: 2
     * @queryParam per_page int Items per page (default 15). Example: 15
     */
    public function cvs(Request $request, int $id): JsonResponse
    {
        $filters = $request->only([
            'nationality_code', 'gender', 'has_experience', 'is_muslim', 'category_id',
        ]);
        $perPage = (int) $request->input('per_page', 15);
        $cvs     = $this->service->availableCvs($id, $filters, max(1, min($perPage, 100)));

        return $this->responder->paginated($cvs, CvResource::class, 'cvs');
    }
}
