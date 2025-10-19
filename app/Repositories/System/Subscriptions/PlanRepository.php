<?php

namespace App\Repositories\System\Subscriptions;

use App\Models\Plan;
use App\Models\PlanFeature;
use App\Models\PlanTranslation;
use App\Repositories\System\Subscriptions\Contracts\PlanRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PlanRepository implements PlanRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = Plan::on('system')->orderBy('code');

        if (!empty($filters['q'])) {
            $s = '%'.$filters['q'].'%';
            $q->where(function($w) use ($s){
                $w->where('code','like',$s)->orWhere('name','like',$s);
            });
        }
        if (isset($filters['active'])) $q->where('active', (bool)$filters['active']);
        if (!empty($filters['billing'])) $q->where('billing_cycle', $filters['billing']);

        return $q->paginate($perPage)->appends(request()->query());
    }

    public function find(string $code): ?Plan
    {
        return Plan::on('system')->with(['translations','features'])->find($code);
    }

    public function store(array $data): Plan
    {
        return Plan::on('system')->create($data);
    }

    public function update(string $code, array $data): ?Plan
    {
        $p = Plan::on('system')->find($code);
        if (!$p) return null;
        $p->fill($data)->save();
        return $p->fresh();
    }

    public function destroy(string $code): bool
    {
        $p = Plan::on('system')->find($code);
        return $p ? (bool)$p->delete() : false;
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
        $p = Plan::on('system')->findOrFail($code);

        // امسح القديمة واعمل upsert سريع (تقدر تعمل smarter diff لو حابب)
        PlanFeature::on('system')->where('plan_code',$code)->delete();

        foreach ($features as $f) {
            PlanFeature::on('system')->create([
                'plan_code' => $code,
                'feature_key' => $f['feature_key'],
                'limit' => $f['limit'] ?? null,
                'value' => $f['value'] ?? null,
                'active'=> isset($f['active']) ? (bool)$f['active'] : true,
            ]);
        }

        return $p->fresh('features');
    }

    public function upsertTranslation(string $code, string $lang, array $data): bool
    {
        return (bool) PlanTranslation::on('system')->updateOrInsert(
            ['plan_code'=>$code, 'lang_code'=>$lang],
            ['name'=>$data['name'] ?? null, 'description'=>$data['description'] ?? null, 'updated_at'=>now(), 'created_at'=>now()]
        );
    }
}
