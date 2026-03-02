<?php

namespace App\Repositories\System\Subscriptions;

use App\Models\OfficeSubscription;
use App\Repositories\System\Subscriptions\Contracts\SubscriptionRepositoryInterface;
use App\Services\Notifications\NotificationService;
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
        $plan = \App\Models\Plan::on('system')->with('translations')->findOrFail($planCode);
        $office = \App\Models\Office::findOrFail($officeId);
        $starts = now();
        $ends   = $plan->billing_cycle === 'annual' ? now()->addYear() : now()->addMonth();

        $subscription = OfficeSubscription::on('system')->create([
            'office_id' => $officeId,
            'plan_code' => $planCode,
            'status' => 'pending',
            'auto_renew' => false,
            'starts_at' => $starts,
            'ends_at' => $ends,
            'currency_code' => strtoupper($currency),
            'price' => $price,
            'meta' => $meta,
            'active' => 0,
        ]);

        $planName = $plan->translations->where('lang_code', 'ar')->first()?->name
            ?? $plan->translations->first()?->name
            ?? $plan->name;

        $notificationService = app(NotificationService::class);

        $adminNotification = $notificationService->createNotification([
            'type' => 'subscription_created',
            'title' => 'اشتراك جديد',
            'body' => "تم إنشاء اشتراك جديد للمكتب: {$office->name} - الخطة: {$planName}",
            'data' => [
                'subscription_id' => $subscription->id,
                'office_id' => $officeId,
                'plan_code' => $planCode,
            ],
            'priority' => 'normal',
        ]);

        $notificationService->notifyAdmins($adminNotification, ['inapp']);

        $officeNotification = $notificationService->createNotification([
            'type' => 'subscription_created',
            'title' => 'تم إنشاء اشتراك جديد',
            'body' => "تم إنشاء اشتراكك في الخطة: {$planName} بنجاح",
            'data' => [
                'subscription_id' => $subscription->id,
                'office_id' => $officeId,
                'plan_code' => $planCode,
            ],
            'priority' => 'normal',
        ]);

        $notificationService->notifyOffices($officeNotification, [$officeId], ['inapp']);

        return $subscription;
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
