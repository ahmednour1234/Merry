<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\PlanResource;
use App\Repositories\System\Subscriptions\Contracts\PlanRepositoryInterface as Repo;
use App\Enums\PlanFeatureKey;
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
     * @response status=200 scenario="OK" {"status":"success","message":"Plans","data":{"items":[{"code":"pro","name":"Pro","base_currency":"USD","base_price":49.0,"billing_cycle":"monthly","active":true}],"pagination":{"current_page":1,"per_page":15,"total":1}}}
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
     * Create a new subscription plan. You can also pass features on creation.
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
     * @bodyParam features array Feature list (optional).
     * @bodyParam features[].feature_key string required One of PlanFeatureKey values. Example: cv.limit
     * @bodyParam features[].limit integer Limit if applicable. Example: 100
     * @bodyParam features[].value mixed Arbitrary value (send JSON string if multipart). Example: {"upload":true}
     * @bodyParam features[].active boolean Whether the feature is active. Example: 1
     *
     * @response status=201 scenario="Created" {"status":"success","message":"Plan created","data":{"code":"pro","name":"Pro"}}
     */
    public function store(Request $r)
    {
        $allowedKeys = array_map(fn($c) => $c->value, PlanFeatureKey::cases());

        $data = $r->validate([
            'code'          => 'required|string|max:64|unique:system.plans,code',
            'name'          => 'required|string|max:191',
            'description'   => 'nullable|string',
            'base_currency' => 'required|string|max:8',
            'base_price'    => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,annual',
            'active'        => 'boolean',
            'meta'          => 'nullable',
            // features (optional)
            'features'                  => 'sometimes|array',
            'features.*.feature_key'    => 'required_with:features|string|in:'.implode(',', $allowedKeys),
            'features.*.limit'          => 'nullable|integer',
            'features.*.value'          => 'nullable',
            'features.*.active'         => 'nullable|boolean',
        ]);

        // Normalize meta if sent as JSON string in multipart
        if (array_key_exists('meta', $data) && is_string($data['meta'])) {
            $decoded = json_decode($data['meta'], true);
            $data['meta'] = json_last_error() === JSON_ERROR_NONE ? $decoded : [];
        } elseif (!isset($data['meta'])) {
            $data['meta'] = null;
        }

        // Extract & normalize features if provided
        $features = null;
        if (isset($data['features']) && is_array($data['features'])) {
            $features = $this->normalizeFeatures($data['features']);
            unset($data['features']);
        }

        // If features provided, use storeWithFeatures, else plain store
        $row = $features !== null
            ? $this->repo->storeWithFeatures($data, $features)
            : $this->repo->store($data);

        return $this->responder->created(new PlanResource($row->load(['features','translations'])), 'Plan created');
    }

    /**
     * @group System / Plans
     * @authenticated
     * Update plan
     *
     * Update an existing plan by its code. You can also pass features to replace the current feature set.
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
     * @bodyParam features array Feature list (optional, replaces existing).
     * @bodyParam features[].feature_key string required One of PlanFeatureKey values. Example: office.users.limit
     * @bodyParam features[].limit integer Limit if applicable. Example: 10
     * @bodyParam features[].value mixed Arbitrary value (send JSON string if multipart). Example: true
     * @bodyParam features[].active boolean Whether the feature is active. Example: 1
     *
     * @response status=200 scenario="Updated" {"status":"success","message":"Plan updated"}
     * @response status=404 scenario="Not found" {"status":"error","message":"Plan not found"}
     */
    public function update(Request $r, string $code)
    {
        $allowedKeys = array_map(fn($c) => $c->value, PlanFeatureKey::cases());

        $data = $r->validate([
            'name'          => 'sometimes|string|max:191',
            'description'   => 'sometimes|nullable|string',
            'base_currency' => 'sometimes|string|max:8',
            'base_price'    => 'sometimes|numeric|min:0',
            'billing_cycle' => 'sometimes|in:monthly,annual',
            'active'        => 'sometimes|boolean',
            'meta'          => 'sometimes|nullable',
            // features (optional)
            'features'                  => 'sometimes|array',
            'features.*.feature_key'    => 'required_with:features|string|in:'.implode(',', $allowedKeys),
            'features.*.limit'          => 'nullable|integer',
            'features.*.value'          => 'nullable',
            'features.*.active'         => 'nullable|boolean',
        ]);

        if (array_key_exists('meta', $data) && is_string($data['meta'])) {
            $decoded = json_decode($data['meta'], true);
            $data['meta'] = json_last_error() === JSON_ERROR_NONE ? $decoded : [];
        }

        $features = null;
        if (isset($data['features']) && is_array($data['features'])) {
            $features = $this->normalizeFeatures($data['features']);
            unset($data['features']);
        }

        $row = $features !== null
            ? $this->repo->updateWithFeatures($code, $data, $features)   // replaces/syncs features
            : $this->repo->update($code, $data);

        if (!$row) {
            return $this->responder->fail('Plan not found', status: 404);
        }

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
        return $ok
            ? $this->responder->ok(null, 'Plan deleted')
            : $this->responder->fail('Plan not found', status: 404);
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
        $data = $r->validate(['active' => 'required|boolean']);
        $row = $this->repo->toggle($code, (bool) $data['active']);
        if (!$row) return $this->responder->fail('Plan not found', status: 404);
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
            'lang_code'   => 'required|string|max:12',
            'name'        => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);
        $ok = $this->repo->upsertTranslation($code, $data['lang_code'], $data);
        if (!$ok) return $this->responder->fail('Plan not found or error', status: 422);
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
        $allowedKeys = array_map(fn($c) => $c->value, PlanFeatureKey::cases());

        $data = $r->validate([
            'features'               => 'required|array',
            'features.*.feature_key' => 'required|string|in:'.implode(',', $allowedKeys),
            'features.*.limit'       => 'nullable|integer',
            'features.*.value'       => 'nullable',
            'features.*.active'      => 'nullable|boolean',
        ]);

        $features = $this->normalizeFeatures($data['features']);
        $row = $this->repo->syncFeatures($code, $features);

        return $this->responder->ok(new PlanResource($row->load('features')), 'Features synced');
    }

    /* ===================== Helpers ===================== */

    /**
     * Normalize features array:
     * - Decode JSON strings for "value"
     * - Cast "active" to bool and "limit" to int|null
     * - Ensure only expected keys are present
     */
    private function normalizeFeatures(array $features): array
    {
        return array_map(function ($f) {
            $out = [
                'feature_key' => (string)($f['feature_key'] ?? ''),
                'limit'       => array_key_exists('limit', $f) ? (is_null($f['limit']) ? null : (int)$f['limit']) : null,
                'active'      => array_key_exists('active', $f) ? (bool)$f['active'] : true,
            ];

            // value may come as JSON string in multipart
            if (array_key_exists('value', $f)) {
                $val = $f['value'];
                if (is_string($val)) {
                    $decoded = json_decode($val, true);
                    $out['value'] = (json_last_error() === JSON_ERROR_NONE) ? $decoded : $val;
                } else {
                    $out['value'] = $val;
                }
            } else {
                $out['value'] = null;
            }

            return $out;
        }, $features);
    }
}
