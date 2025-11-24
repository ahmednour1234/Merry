<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\SystemLanguage\StoreSystemLanguageRequest;
use App\Http\Resources\System\SystemLanguageResource;
use App\Repositories\System\Contracts\SystemLanguageRepositoryInterface as Repo;
use Illuminate\Http\Request;

class SystemLanguageController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app(\App\Support\Api\ApiResponder::class));
    }

    /**
     * @group System / Languages
     * List system languages
     *
     * Paginated list. Use ?per_page=0 or ?all=1 to fetch all.
     *
     * @queryParam per_page integer Number per page. Example: 15
     * @queryParam all boolean Return all records (no pagination). Example: 1
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->integer('per_page', 15);

        if ($perPage === 0 || $request->boolean('all')) {
            $all = $this->repo->all();
            return $this->responder->ok(
                SystemLanguageResource::collection($all),
                'System languages list',
                meta: ['pagination' => null]
            );
        }

        $p = $this->repo->paginate($perPage > 0 ? $perPage : 15);

        return $this->responder->paginated(
            $p,
            SystemLanguageResource::class,
            'System languages list'
        );
    }

    /**
     * @group System / Languages
     * Store or update a system language
     *
     * @bodyParam code string required Two-letter (or en-US). Example: ar
     * @bodyParam name string required Localized name. Example: Arabic
     * @bodyParam native_name string Native name. Example: العربية
     * @bodyParam rtl boolean RTL language. Example: true
     * @bodyParam status string active|inactive. Example: active
     */
    public function store(StoreSystemLanguageRequest $request)
    {
        $lang = $this->repo->store($request->validated());

        return $this->responder->created(
            new SystemLanguageResource($lang),
            'System language saved'
        );
    }
}
