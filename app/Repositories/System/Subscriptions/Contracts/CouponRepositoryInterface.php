<?php

namespace App\Repositories\System\Subscriptions\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Coupon;

interface CouponRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function store(array $data): Coupon;
    public function update(int $id, array $data): ?Coupon;
    public function destroy(int $id): bool;
    public function toggle(int $id, bool $active): ?Coupon;
}
