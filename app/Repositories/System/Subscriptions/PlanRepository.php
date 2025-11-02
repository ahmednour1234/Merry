<?php

namespace App\Repositories\System\Subscriptions;

use App\Models\Plan;
use App\Models\PlanFeature;
use App\Models\PlanTranslation;
use App\Repositories\System\Subscriptions\Contracts\PlanRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PlanRepository implements PlanRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = Plan::on('system')->orderBy('code');

        if (!empty($filters['q'])) {
            $s = '%'.$filters['q'].'%';
            $q->where(function ($w) use ($s) {
                $w->where('code', 'like', $s)->orWhere('name', 'like', $s);
            });
        }

        if (isset($filters['active'])) {
            $q->where('active', (bool) $filters['active']);
        }

        if (!empty($filters['billing'])) {
            $q->where('billing_cycle', $filters['billing']);
        }

        return $q->paginate($perPage)->appends(request()->query());
    }

    public function find(string $code): ?Plan
    {
        return Plan::on('system')->with(['translations', 'features'])->find($code);
    }

    public function store(array $data): Plan
    {
        return Plan::on('system')->create($data);
    }

    public function storeWithFeatures(array $data, array $features): Plan
    {
        return DB::connection('system')->transaction(function () use ($data, $features) {
            $plan = Plan::on('system')->create($data);
            $this->syncFeatures($plan->code, $features);
            return $plan->fresh(['features', 'translations']);
        });
    }

    public function update(string $code, array $data): ?Plan
    {
        $p = Plan::on('system')->find($code);
        if (!$p) return null;

        $p->fill($data)->save();
        return $p->fresh();
    }

    public function updateWithFeatures(string $code, array $data, array $features): ?Plan
    {
        return DB::connection('system')->transaction(function () use ($code, $data, $features) {
            $p = Plan::on('system')->find($code);
            if (!$p) return null;

            if (!empty($data)) {
                $p->fill($data)->save();
            }

            $this->syncFeatures($code, $features);

            return $p->fresh(['features', 'translations']);
        });
    }

    public function destroy(string $code): bool
    {
        $p = Plan::on('system')->find($code);
        return $p ? (bool) $p->delete() : false;
    }

    public function toggle(string $code, bool $active): ?Plan
    {
        $p = Plan::on('system')->find($code);
        if (!$p) return null;

        $p->active = $active;
        $p->save();

        return $p;
    }

    public function syncFeatures(string $code, array $features): Plan
    {
        return DB::connection('system')->transaction(function () use ($code, $features) {
            $plan = Plan::on('system')->findOrFail($code);

            // امسح القديم
            PlanFeature::on('system')->where('plan_code', $code)->delete();

            if (!empty($features)) {
                // إدخال جماعي سريع
                $rows = [];
                $now  = now();

                foreach ($features as $f) {
                    $rows[] = [
                        'plan_code'   => $code,
                        'feature_key' => $f['feature_key'],
                        'limit'       => $f['limit'] ?? null,
                        'value'       => $f['value'] ?? null, // لو العمود JSON في الموديل هي تُحفظ كـ JSON
                        'active'      => isset($f['active']) ? (bool) $f['active'] : true,
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ];
                }

                PlanFeature::on('system')->insert($rows);
            }

            return $plan->fresh('features');
        });
    }

    public function upsertTranslation(string $code, string $lang, array $data): bool
    {
        // لو عايز تتأكد أن الخطة موجودة قبل التحديث:
        if (!Plan::on('system')->whereKey($code)->exists()) {
            return false;
        }

        return (bool) PlanTranslation::on('system')->updateOrInsert(
            ['plan_code' => $code, 'lang_code' => $lang],
            [
                'name'        => $data['name'] ?? null,
                'description' => $data['description'] ?? null,
                'updated_at'  => now(),
                'created_at'  => now(), // هتتجاهل لو Update
            ]
        );
    }
}
