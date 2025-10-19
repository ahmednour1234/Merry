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

    public function index(Request $r)
    {
        $filters = $r->only(['plan_code','active']);
        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $this->repo->paginate($filters, $per);
        return $this->responder->paginated($p, null, 'Promotions');
    }

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

    public function destroy(int $id)
    {
        $ok = $this->repo->destroy($id);
        return $ok ? $this->responder->ok(null,'Promotion deleted') : $this->responder->fail('Not found',404);
    }

    public function toggle(Request $r, int $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle($id, (bool)$data['active']);
        if (!$row) return $this->responder->fail('Not found',404);
        return $this->responder->ok($row, 'Promotion status updated');
    }
}
