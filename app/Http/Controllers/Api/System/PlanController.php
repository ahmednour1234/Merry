<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\PlanResource;
use App\Repositories\System\Subscriptions\Contracts\PlanRepositoryInterface as Repo;
use Illuminate\Http\Request;

class PlanController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app('api.responder'));
    }

    /** GET /api/v1/admin/system/plans */
    public function index(Request $r)
    {
        $filters = $r->only(['q','active','billing']);
        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $this->repo->paginate($filters, $per);
        $p->getCollection()->load(['translations','features']);
        return $this->responder->paginated($p, PlanResource::class, 'Plans');
    }

    /** POST /api/v1/admin/system/plans */
    public function store(Request $r)
    {
        $data = $r->validate([
            'code' => 'required|string|max:64|unique:system.plans,code',
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'base_currency' => 'required|string|max:8',
            'base_price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,annual',
            'active' => 'boolean',
            'meta' => 'array'
        ]);

        $row = $this->repo->store($data);
        return $this->responder->created(new PlanResource($row), 'Plan created');
    }

    /** PUT /api/v1/admin/system/plans/{code} */
    public function update(Request $r, string $code)
    {
        $data = $r->validate([
            'name' => 'sometimes|string|max:191',
            'description' => 'sometimes|nullable|string',
            'base_currency' => 'sometimes|string|max:8',
            'base_price' => 'sometimes|numeric|min:0',
            'billing_cycle' => 'sometimes|in:monthly,annual',
            'active' => 'sometimes|boolean',
            'meta' => 'sometimes|array'
        ]);
        $row = $this->repo->update($code, $data);
        if (!$row) return $this->responder->fail('Plan not found', status:404);
        return $this->responder->ok(new PlanResource($row->load(['translations','features'])), 'Plan updated');
    }

    /** DELETE /api/v1/admin/system/plans/{code} */
    public function destroy(string $code)
    {
        $ok = $this->repo->destroy($code);
        return $ok ? $this->responder->ok(null,'Plan deleted') : $this->responder->fail('Plan not found',status:404);
    }

    /** POST /api/v1/admin/system/plans/{code}/toggle */
    public function toggle(Request $r, string $code)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle($code, (bool)$data['active']);
        if (!$row) return $this->responder->fail('Plan not found', status:404);
        return $this->responder->ok(new PlanResource($row), 'Plan status updated');
    }

    /** POST /api/v1/admin/system/plans/{code}/translations */
    public function upsertTranslation(Request $r, string $code)
    {
        $data = $r->validate([
            'lang_code' => 'required|string|max:12',
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);
        $ok = $this->repo->upsertTranslation($code, $data['lang_code'], $data);
        if (!$ok) return $this->responder->fail('Plan not found or error', status:422);
        $row = $this->repo->find($code);
        return $this->responder->ok(new PlanResource($row), 'Translation saved');
    }

    /** POST /api/v1/admin/system/plans/{code}/features */
    public function syncFeatures(Request $r, string $code)
    {
        $data = $r->validate([
            'features' => 'required|array',
            'features.*.feature_key' => 'required|string|max:64',
            'features.*.limit' => 'nullable|integer',
            'features.*.value' => 'nullable',
            'features.*.active' => 'nullable|boolean',
        ]);
        $row = $this->repo->syncFeatures($code, $data['features']);
        return $this->responder->ok(new PlanResource($row->load('features')), 'Features synced');
    }
}
