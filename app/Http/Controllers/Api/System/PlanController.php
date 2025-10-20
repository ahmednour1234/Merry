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

    /**
     * @group System / Plans
     * @authenticated
     * List plans
     *
     * Paginated list of subscription plans with optional filters.
     *
     * @queryParam q string Search by code or name (LIKE). Example: pro
     * @queryParam active boolean Filter by active status. Example: 1
     * @queryParam billing string Filter by billing cycle (monthly|annual). Example: monthly
     * @queryParam per_page integer Results per page (default 15). Example: 20
     *
     * @response status=200 scenario="OK" {"status":"success","message":"Plans","data":{"items":[{"code":"pro","name":"Pro", "base_currency":"USD","base_price":49.0,"billing_cycle":"monthly","active":true}],"pagination":{"current_page":1,"per_page":15,"total":1}}}
     */
    public function index(Request $r)
    {
        $filters = $r->only(['q','active','billing']);
        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $this->repo->paginate($filters, $per);
        $p->getCollection()->load(['translations','features']);
        return $this->responder->paginated($p, PlanResource::class, 'Plans');
    }

    /**
     * @group System / Plans
     * @authenticated
     * Create plan
     *
     * Create a new subscription plan. Features & translations are handled by separate endpoints.
     *
     * @contentType multipart/form-data
     *
     * @bodyParam code string required Unique plan code (primary key). Example: pro
     * @bodyParam name string required Default (base) name (usually en). Example: Pro
     * @bodyParam description string A short description. Example: For growing offices
     * @bodyParam base_currency string required Base currency code (ISO). Example: USD
     * @bodyParam base_price number required Base price in base currency. Example: 49.99
     * @bodyParam billing_cycle string required monthly|annual. Example: monthly
     * @bodyParam active boolean Whether the plan is active. Example: 1
     * @bodyParam meta object Arbitrary JSON metadata (send as JSON string in form-data). Example: {"color":"#1e88e5"}
     *
     * @response status=201 scenario="Created" {"status":"success","message":"Plan created","data":{"code":"pro","name":"Pro"}}
     */
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

    /**
     * @group System / Plans
     * @authenticated
     * Update plan
     *
     * Update an existing plan by its code.
     *
     * @urlParam code string required Plan code (primary key). Example: pro
     * @contentType multipart/form-data
     *
     * @bodyParam name string Default name. Example: Pro Plus
     * @bodyParam description string Description. Example: For advanced usage
     * @bodyParam base_currency string Base currency code. Example: USD
     * @bodyParam base_price number Base price. Example: 59.99
     * @bodyParam billing_cycle string monthly|annual. Example: annual
     * @bodyParam active boolean Active flag. Example: 0
     * @bodyParam meta object JSON metadata (send as JSON string). Example: {"badge":"popular"}
     *
     * @response status=200 scenario="Updated" {"status":"success","message":"Plan updated"}
     * @response status=404 scenario="Not found" {"status":"error","message":"Plan not found"}
     */
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

    /**
     * @group System / Plans
     * @authenticated
     * Delete plan
     *
     * Soft-delete a plan by code.
     *
     * @urlParam code string required Plan code. Example: pro
     *
     * @response status=200 {"status":"success","message":"Plan deleted"}
     * @response status=404 {"status":"error","message":"Plan not found"}
     */
    public function destroy(string $code)
    {
        $ok = $this->repo->destroy($code);
        return $ok ? $this->responder->ok(null,'Plan deleted') : $this->responder->fail('Plan not found',status:404);
    }

    /**
     * @group System / Plans
     * @authenticated
     * Toggle plan status
     *
     * Enable/disable a plan.
     *
     * @urlParam code string required Plan code. Example: pro
     * @contentType multipart/form-data
     *
     * @bodyParam active boolean required 1 to enable, 0 to disable. Example: 1
     *
     * @response status=200 {"status":"success","message":"Plan status updated"}
     * @response status=404 {"status":"error","message":"Plan not found"}
     */
    public function toggle(Request $r, string $code)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle($code, (bool)$data['active']);
        if (!$row) return $this->responder->fail('Plan not found', status:404);
        return $this->responder->ok(new PlanResource($row), 'Plan status updated');
    }

    /**
     * @group System / Plans
     * @authenticated
     * Upsert translation
     *
     * Create or update a translation for a plan.
     *
     * @urlParam code string required Plan code. Example: pro
     * @contentType multipart/form-data
     *
     * @bodyParam lang_code string required Language code. Example: ar
     * @bodyParam name string required Translated name. Example: الخطة الاحترافية
     * @bodyParam description string Translated description. Example: مناسبة للمكاتب النامية
     *
     * @response status=200 {"status":"success","message":"Translation saved"}
     * @response status=422 {"status":"error","message":"Plan not found or error"}
     */
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

    /**
     * @group System / Plans
     * @authenticated
     * Sync features
     *
     * Replace all features of a plan with the provided list.
     *
     * @urlParam code string required Plan code. Example: pro
     * @contentType multipart/form-data
     *
     * @bodyParam features array required Features array.
     * @bodyParam features[].feature_key string required Feature key. Example: cv.limit
     * @bodyParam features[].limit integer Limit (if applicable). Example: 100
     * @bodyParam features[].value mixed Arbitrary value (JSON-serializable). Example: {"upload":true}
     * @bodyParam features[].active boolean Whether the feature is active. Example: 1
     *
     * @response status=200 {"status":"success","message":"Features synced"}
     */
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
