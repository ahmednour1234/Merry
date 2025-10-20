<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Repositories\System\Subscriptions\Contracts\PromotionRepositoryInterface as Repo;
use Illuminate\Http\Request;

class PromotionController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * @group System / Promotions
     * @authenticated
     * List promotions
     *
     * Paginated list of promotions with optional filters.
     *
     * @queryParam plan_code string Filter by plan code. Example: pro
     * @queryParam active boolean Filter by active status. Example: 1
     * @queryParam per_page integer Results per page (default 15). Example: 20
     *
     * @response status=200 scenario="OK" {"status":"success","message":"Promotions","data":{"items":[{"id":1,"name":"New Year","type":"percent","amount":20,"active":true}],"pagination":{"current_page":1,"per_page":15,"total":1}}}
     */
    public function index(Request $r)
    {
        $filters = $r->only(['plan_code','active']);
        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $this->repo->paginate($filters, $per);
        return $this->responder->paginated($p, null, 'Promotions');
    }

    /**
     * @group System / Promotions
     * @authenticated
     * Create promotion
     *
     * Create a promotion which can be tied to a specific plan or globally applied.
     *
     * @contentType multipart/form-data
     *
     * @bodyParam name string required Promotion name. Example: New Year 20%
     * @bodyParam plan_code string Plan code (optional for global promo). Example: pro
     * @bodyParam type string required Discount type: percent|fixed. Example: percent
     * @bodyParam amount number required Discount amount (if percent: 20 = 20%). Example: 20
     * @bodyParam currency_code string Currency (only required for fixed). Example: USD
     * @bodyParam starts_at datetime Start date (Y-m-d H:i:s). Example: 2025-01-01 00:00:00
     * @bodyParam ends_at datetime End date (Y-m-d H:i:s). Must be after starts_at. Example: 2025-01-31 23:59:59
     * @bodyParam auto_apply boolean Automatically apply when eligible. Example: 1
     * @bodyParam active boolean Whether promo is active. Example: 1
     * @bodyParam meta object Arbitrary JSON metadata (send JSON string in form-data). Example: {"channel":"web"}
     *
     * @response status=201 scenario="Created" {"status":"success","message":"Promotion created","data":{"id":10,"name":"New Year 20%"}}
     */
    public function store(Request $r)
    {
        $data = $r->validate([
            'name'=>'required|string',
            'plan_code'=>'nullable|string|max:64',
            'type'=>'required|in:percent,fixed',
            'amount'=>'required|numeric|min:0',
            'currency_code'=>'nullable|string|max:8',
            'starts_at'=>'nullable|date',
            'ends_at'=>'nullable|date|after:starts_at',
            'auto_apply'=>'boolean',
            'active'=>'boolean',
            'meta'=>'array',
        ]);
        $row = $this->repo->store($data);
        return $this->responder->created($row, 'Promotion created');
    }

    /**
     * @group System / Promotions
     * @authenticated
     * Update promotion
     *
     * Update an existing promotion by ID.
     *
     * @urlParam id integer required Promotion ID. Example: 10
     * @contentType multipart/form-data
     *
     * @bodyParam name string Promotion name. Example: Spring 15%
     * @bodyParam plan_code string Plan code or null. Example: pro
     * @bodyParam type string percent|fixed. Example: fixed
     * @bodyParam amount number Discount amount. Example: 25
     * @bodyParam currency_code string Currency for fixed discounts. Example: SAR
     * @bodyParam starts_at datetime Start date (Y-m-d H:i:s). Example: 2025-03-01 00:00:00
     * @bodyParam ends_at datetime End date (Y-m-d H:i:s), after starts_at. Example: 2025-03-31 23:59:59
     * @bodyParam auto_apply boolean Auto apply flag. Example: 0
     * @bodyParam active boolean Active flag. Example: 1
     * @bodyParam meta object Arbitrary JSON metadata (send JSON string). Example: {"segment":"returning"}
     *
     * @response status=200 scenario="Updated" {"status":"success","message":"Promotion updated"}
     * @response status=404 scenario="Not found" {"status":"error","message":"Not found"}
     */
    public function update(Request $r, int $id)
    {
        $data = $r->validate([
            'name'=>'sometimes|string',
            'plan_code'=>'sometimes|nullable|string|max:64',
            'type'=>'sometimes|in:percent,fixed',
            'amount'=>'sometimes|numeric|min:0',
            'currency_code'=>'sometimes|nullable|string|max:8',
            'starts_at'=>'sometimes|nullable|date',
            'ends_at'=>'sometimes|nullable|date|after:starts_at',
            'auto_apply'=>'sometimes|boolean',
            'active'=>'sometimes|boolean',
            'meta'=>'sometimes|array',
        ]);
        $row = $this->repo->update($id, $data);
        if (!$row) return $this->responder->fail('Not found',404);
        return $this->responder->ok($row, 'Promotion updated');
    }

    /**
     * @group System / Promotions
     * @authenticated
     * Delete promotion
     *
     * Soft-delete a promotion.
     *
     * @urlParam id integer required Promotion ID. Example: 10
     *
     * @response status=200 {"status":"success","message":"Promotion deleted"}
     * @response status=404 {"status":"error","message":"Not found"}
     */
    public function destroy(int $id)
    {
        $ok = $this->repo->destroy($id);
        return $ok ? $this->responder->ok(null,'Promotion deleted') : $this->responder->fail('Not found',404);
    }

    /**
     * @group System / Promotions
     * @authenticated
     * Toggle promotion status
     *
     * Enable/disable a promotion.
     *
     * @urlParam id integer required Promotion ID. Example: 10
     * @contentType multipart/form-data
     *
     * @bodyParam active boolean required 1 to enable, 0 to disable. Example: 0
     *
     * @response status=200 {"status":"success","message":"Promotion status updated"}
     * @response status=404 {"status":"error","message":"Not found"}
     */
    public function toggle(Request $r, int $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle($id, (bool)$data['active']);
        if (!$row) return $this->responder->fail('Not found',404);
        return $this->responder->ok($row, 'Promotion status updated');
    }
}
