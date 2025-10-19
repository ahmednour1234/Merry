<?php

namespace App\Repositories\System\Subscriptions;

use App\Models\Promotion;
use App\Repositories\System\Subscriptions\Contracts\PromotionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PromotionRepository implements PromotionRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = Promotion::on('system')->orderByDesc('created_at');

        if (!empty($filters['plan_code'])) $q->where('plan_code', $filters['plan_code']);
        if (isset($filters['active'])) $q->where('active',(bool)$filters['active']);

        return $q->paginate($perPage)->appends(request()->query());
    }

    public function store(array $data): Promotion { return Promotion::on('system')->create($data); }

    public function update(int $id, array $data): ?Promotion
    {
        $row = Promotion::on('system')->find($id);
        if (!$row) return null;
        $row->fill($data)->save();
        return $row;
    }

    public function destroy(int $id): bool
    {
        $row = Promotion::on('system')->find($id);
        return $row ? (bool)$row->delete() : false;
    }

    public function toggle(int $id, bool $active): ?Promotion
    {
        $row = Promotion::on('system')->find($id);
        if (!$row) return null;
        $row->active = $active; $row->save();
        return $row;
    }
}
