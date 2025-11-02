<?php

namespace App\Repositories\System\Subscriptions\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Plan;

interface PlanRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function find(string $code): ?Plan;

    /** إنشاء خطة بدون مزايا */
    public function store(array $data): Plan;

    /** إنشاء خطة مع مزايا */
    public function storeWithFeatures(array $data, array $features): Plan;

    /** تحديث خطة بدون مزايا */
    public function update(string $code, array $data): ?Plan;

    /** تحديث خطة مع استبدال كامل للمزايا */
    public function updateWithFeatures(string $code, array $data, array $features): ?Plan;

    public function destroy(string $code): bool;

    public function toggle(string $code, bool $active): ?Plan;

    /**
     * استبدال (Sync) كل مزايا الخطة بالمصفوفة الجديدة:
     * كل عنصر: ['feature_key'=>'cv.limit','limit'=>100,'value'=>mixed,'active'=>bool]
     */
    public function syncFeatures(string $code, array $features): Plan;

    /**
     * إنشاء/تحديث ترجمة
     * $data = ['name' => ..., 'description' => ...]
     */
    public function upsertTranslation(string $code, string $lang, array $data): bool;
}
