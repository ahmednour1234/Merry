<?php

namespace App\Repositories\System\Subscriptions\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Plan;

interface PlanRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(string $code): ?Plan;
    public function store(array $data): Plan;
    public function update(string $code, array $data): ?Plan;
    public function destroy(string $code): bool;
    public function toggle(string $code, bool $active): ?Plan;
    public function syncFeatures(string $code, array $features): Plan; // [['feature_key'=>'cv.limit','limit'=>100], ...]
    public function upsertTranslation(string $code, string $lang, array $data): bool; // ['name','description']
}
