<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Repositories\System\Subscriptions\Contracts\CouponRepositoryInterface as Repo;
use Illuminate\Http\Request;

class CouponController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * @group System / Coupons
     * @authenticated
     * List coupons
     *
     * Paginated list of coupons with optional filters.
     *
     * @queryParam code string Filter by code (LIKE). Example: WELCOME10
     * @queryParam active boolean Filter by active status. Example: 1
     * @queryParam per_page integer Results per page (default 15). Example: 20
     *
     * @responseFile status=200 storage/app/private/scribe/examples/ok.json
     */
    public function index(Request $r)
    {
        $filters = $r->only(['code','active']);
        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $this->repo->paginate($filters, $per);
        return $this->responder->paginated($p, null, 'Coupons');
    }

    /**
     * @group System / Coupons
     * @authenticated
     * Create coupon
     *
     * Create a new coupon. Supports percent or fixed discounts.
     *
     * @contentType multipart/form-data
     *
     * @bodyParam code string required Unique coupon code. Example: WELCOME10
     * @bodyParam type string required Discount type: percent|fixed. Example: percent
     * @bodyParam amount number required Amount; if percent, 10 means 10%. Example: 10
     * @bodyParam currency_code string Currency of amount (only for fixed). Example: USD
     * @bodyParam starts_at datetime Start date (Y-m-d H:i:s). Example: 2025-01-01 00:00:00
     * @bodyParam ends_at datetime End date (Y-m-d H:i:s). Must be after starts_at. Example: 2025-12-31 23:59:59
     * @bodyParam max_redemptions integer Max total redemptions (null for unlimited). Example: 1000
     * @bodyParam per_office_limit integer Max redemptions per office (null for unlimited). Example: 1
     * @bodyParam active boolean Whether coupon is active. Example: 1
     * @bodyParam meta object Free-form JSON metadata (send as JSON string in form-data). Example: {"note":"new year"}
     *
     * @response status=201 scenario="Created" {"status":"success","message":"Coupon created","data":{"id":1,"code":"WELCOME10"}}
     */
    public function store(Request $r)
    {
        $data = $r->validate([
            'code'=>'required|string|max:64|unique:system.coupons,code',
            'type'=>'required|in:percent,fixed',
            'amount'=>'required|numeric|min:0',
            'currency_code'=>'nullable|string|max:8',
            'starts_at'=>'nullable|date',
            'ends_at'=>'nullable|date|after:starts_at',
            'max_redemptions'=>'nullable|integer|min:0',
            'per_office_limit'=>'nullable|integer|min:0',
            'active'=>'boolean',
            'meta'=>'array',
        ]);
        $row = $this->repo->store($data);
        return $this->responder->created($row, 'Coupon created');
    }

    /**
     * @group System / Coupons
     * @authenticated
     * Update coupon
     *
     * Update an existing coupon by ID.
     *
     * @urlParam id integer required The coupon ID. Example: 5
     * @contentType multipart/form-data
     *
     * @bodyParam type string Discount type: percent|fixed. Example: fixed
     * @bodyParam amount number Amount (see type). Example: 25
     * @bodyParam currency_code string Currency for fixed type. Example: SAR
     * @bodyParam starts_at datetime Start date (Y-m-d H:i:s). Example: 2025-01-01 00:00:00
     * @bodyParam ends_at datetime End date (Y-m-d H:i:s). Must be after starts_at. Example: 2025-06-30 23:59:59
     * @bodyParam max_redemptions integer Max total redemptions. Example: 500
     * @bodyParam per_office_limit integer Per-office limit. Example: 2
     * @bodyParam active boolean Active flag. Example: 0
     * @bodyParam meta object Free-form JSON metadata (send as JSON string in form-data). Example: {"channel":"web"}
     *
     * @response status=200 scenario="Updated" {"status":"success","message":"Coupon updated"}
     * @response status=404 scenario="Not found" {"status":"error","message":"Not found"}
     */
    public function update(Request $r, int $id)
    {
        $data = $r->validate([
            'type'=>'sometimes|in:percent,fixed',
            'amount'=>'sometimes|numeric|min:0',
            'currency_code'=>'sometimes|nullable|string|max:8',
            'starts_at'=>'sometimes|nullable|date',
            'ends_at'=>'sometimes|nullable|date|after:starts_at',
            'max_redemptions'=>'sometimes|nullable|integer|min:0',
            'per_office_limit'=>'sometimes|nullable|integer|min:0',
            'active'=>'sometimes|boolean',
            'meta'=>'sometimes|array',
        ]);
        $row = $this->repo->update($id, $data);
        if (!$row) return $this->responder->fail('Not found',404);
        return $this->responder->ok($row, 'Coupon updated');
    }

    /**
     * @group System / Coupons
     * @authenticated
     * Delete coupon
     *
     * Soft-delete a coupon.
     *
     * @urlParam id integer required The coupon ID. Example: 5
     *
     * @response status=200 {"status":"success","message":"Coupon deleted"}
     * @response status=404 {"status":"error","message":"Not found"}
     */
    public function destroy(int $id)
    {
        $ok = $this->repo->destroy($id);
        return $ok ? $this->responder->ok(null,'Coupon deleted') : $this->responder->fail('Not found',404);
    }

    /**
     * @group System / Coupons
     * @authenticated
     * Toggle coupon status
     *
     * Enable/disable a coupon.
     *
     * @urlParam id integer required The coupon ID. Example: 5
     * @contentType multipart/form-data
     *
     * @bodyParam active boolean required Set to 1 to enable, 0 to disable. Example: 1
     *
     * @response status=200 {"status":"success","message":"Coupon status updated"}
     * @response status=404 {"status":"error","message":"Not found"}
     */
    public function toggle(Request $r, int $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle($id, (bool)$data['active']);
        if (!$row) return $this->responder->fail('Not found',404);
        return $this->responder->ok($row, 'Coupon status updated');
    }
}
