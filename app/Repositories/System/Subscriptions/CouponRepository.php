<?php

namespace App\Repositories\System\Subscriptions;

use App\Models\Coupon;
use App\Repositories\System\Subscriptions\Contracts\CouponRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CouponRepository implements CouponRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = Coupon::on('system')->orderByDesc('created_at');

        if (!empty($filters['code'])) $q->where('code','like','%'.$filters['code'].'%');
        if (isset($filters['active'])) $q->where('active',(bool)$filters['active']);

        return $q->paginate($perPage)->appends(request()->query());
    }

    public function store(array $data): Coupon { return Coupon::on('system')->create($data); }

    public function update(int $id, array $data): ?Coupon
    {
        $row = Coupon::on('system')->find($id);
        if (!$row) return null;
        $row->fill($data)->save();
        return $row;
    }

    public function destroy(int $id): bool
    {
        $row = Coupon::on('system')->find($id);
        return $row ? (bool)$row->delete() : false;
    }

    public function toggle(int $id, bool $active): ?Coupon
    {
        $row = Coupon::on('system')->find($id);
        if (!$row) return null;
        $row->active = $active; $row->save();
        return $row;
    }
}
