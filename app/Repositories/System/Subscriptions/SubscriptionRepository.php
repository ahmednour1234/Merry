<?php

namespace App\Repositories\System\Subscriptions;

use App\Models\OfficeSubscription;
use App\Repositories\System\Subscriptions\Contracts\SubscriptionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = OfficeSubscription::on('system')->with('plan')->orderByDesc('created_at');

        if (!empty($filters['office_id'])) $q->where('office_id', (int)$filters['office_id']);
        if (!empty($filters['plan_code'])) $q->where('plan_code', $filters['plan_code']);
        if (!empty($filters['status']))    $q->where('status', $filters['status']);
        if (!empty($filters['from']))      $q->where('created_at','>=',$filters['from']);
        if (!empty($filters['to']))        $q->where('created_at','<=',$filters['to']);

        return $q->paginate($perPage)->appends(request()->query());
    }

    public function currentForOffice(int $officeId): ?OfficeSubscription
    {
        return OfficeSubscription::on('system')
            ->where('office_id',$officeId)
            ->where('status','active')
            ->where('ends_at','>=', now())
            ->orderByDesc('ends_at')
            ->with('plan')
            ->first();
    }

    public function createForOffice(int $officeId, string $planCode, string $currency, float $price, array $meta = []): OfficeSubscription
    {
        // دورة حسب الخطة (monthly/annual) – تقدر تحسبها من خطة أو تمررها من الخدمة
        $plan = \App\Models\Plan::on('system')->findOrFail($planCode);
        $starts = now();
        $ends   = $plan->billing_cycle === 'annual' ? now()->addYear() : now()->addMonth();

        return OfficeSubscription::on('system')->create([
            'office_id' => $officeId,
            'plan_code' => $planCode,
            'status' => 'active',
            'auto_renew' => false,
            'starts_at' => $starts,
            'ends_at' => $ends,
            'currency_code' => strtoupper($currency),
            'price' => $price,
            'meta' => $meta,
            'active' => 1,
        ]);
    }

    public function setAutoRenew(int $subscriptionId, bool $auto): ?OfficeSubscription
    {
        $s = OfficeSubscription::on('system')->find($subscriptionId);
        if (!$s) return null;
        $s->auto_renew = $auto;
        $s->save();
        return $s;
    }
}
