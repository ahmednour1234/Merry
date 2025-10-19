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

    public function index(Request $r)
    {
        $filters = $r->only(['code','active']);
        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $this->repo->paginate($filters, $per);
        return $this->responder->paginated($p, null, 'Coupons'); // (ريソورس بسيط لاحقاً لو حبيت)
    }

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

    public function destroy(int $id)
    {
        $ok = $this->repo->destroy($id);
        return $ok ? $this->responder->ok(null,'Coupon deleted') : $this->responder->fail('Not found',404);
    }

    public function toggle(Request $r, int $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle($id, (bool)$data['active']);
        if (!$row) return $this->responder->fail('Not found',404);
        return $this->responder->ok($row, 'Coupon status updated');
    }
}
