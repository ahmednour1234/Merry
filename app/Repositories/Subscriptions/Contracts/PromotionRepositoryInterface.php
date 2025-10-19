<?php

namespace App\Repositories\System\Subscriptions\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Promotion;

interface PromotionRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function store(array $data): Promotion;
    public function update(int $id, array $data): ?Promotion;
    public function destroy(int $id): bool;
    public function toggle(int $id, bool $active): ?Promotion;
}
