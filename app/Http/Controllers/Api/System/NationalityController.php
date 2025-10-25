<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\Nationality\StoreNationalityRequest;
use App\Http\Requests\System\Nationality\UpdateNationalityRequest;
use App\Http\Requests\System\Nationality\UpsertNationalityTranslationRequest;
use App\Http\Resources\System\NationalityResource;
use App\Repositories\System\Contracts\NationalityRepositoryInterface as Repo;
use Illuminate\Http\Request;

/**
 * @group System / Nationalities
 * @authenticated
 */
class NationalityController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * List nationalities
     *
     * @queryParam q string Search by code/name. Example: sa
     * @queryParam active boolean Filter by active. Example: 1
     * @queryParam from date Example: 2025-01-01
     * @queryParam to date Example: 2025-12-31
     * @queryParam per_page integer Example: 15
     */
    public function index(Request $r)
    {
        $filters = $r->only(['q','active','from','to']);
        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $this->repo->paginate($filters, $per);
        return $this->responder->paginated($p, NationalityResource::class, 'Nationalities');
    }

    /**
     * Create nationality
     *
     * @contentType multipart/form-data
     * @bodyParam code string required Unique code. Example: SA
     * @bodyParam name string required Default name. Example: Saudi
     * @bodyParam active boolean Active flag. Example: 1
     * @bodyParam translations array Translations list. Example: [{"lang_code":"ar","name":"سعودي"}]
     */
    public function store(StoreNationalityRequest $r)
    {
        $row = $this->repo->store($r->validated());
        return $this->responder->created(new NationalityResource($row), 'Nationality created');
    }

    /**
     * Update nationality
     *
     * @urlParam id integer required Nationality ID. Example: 3
     * @contentType multipart/form-data
     * @bodyParam code string Unique code. Example: EG
     * @bodyParam name string Default name. Example: Egyptian
     * @bodyParam active boolean Active flag. Example: 0
     * @bodyParam translations array Replace/upsert translations. Example: [{"lang_code":"ar","name":"مصري"}]
     */
    public function update(UpdateNationalityRequest $r, int $id)
    {
        $row = $this->repo->update($id, $r->validated());
        if (!$row) return $this->responder->fail('Nationality not found', 404);
        return $this->responder->ok(new NationalityResource($row), 'Nationality updated');
    }

    /**
     * Delete nationality
     *
     * @urlParam id integer required Nationality ID. Example: 3
     */
    public function destroy(int $id)
    {
        $ok = $this->repo->destroy($id);
        return $ok ? $this->responder->ok(null, 'Nationality deleted')
                   : $this->responder->fail('Nationality not found', 404);
    }

    /**
     * Toggle nationality
     *
     * @urlParam id integer required Nationality ID. Example: 3
     * @contentType multipart/form-data
     * @bodyParam active boolean required 1/0. Example: 1
     */
    public function toggle(Request $r, int $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle($id, (bool)$data['active']);
        if (!$row) return $this->responder->fail('Nationality not found', 404);
        return $this->responder->ok(new NationalityResource($row), 'Nationality status updated');
    }

    /**
     * Upsert translation
     *
     * @urlParam id integer required Nationality ID. Example: 3
     * @contentType multipart/form-data
     * @bodyParam lang_code string required Language code. Example: ar
     * @bodyParam name string required Translated name. Example: سعودي
     */
    public function upsertTranslation(UpsertNationalityTranslationRequest $r, int $id)
    {
        $ok = $this->repo->upsertTranslation($id, $r->input('lang_code'), $r->input('name'));
        if (!$ok) return $this->responder->fail('Nationality not found', 404);
        return $this->responder->ok(null, 'Translation saved');
    }
}
