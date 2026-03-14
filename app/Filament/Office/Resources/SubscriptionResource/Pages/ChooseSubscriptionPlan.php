<?php

namespace App\Filament\Office\Resources\SubscriptionResource\Pages;

use App\Filament\Office\Resources\SubscriptionResource;
use App\Models\OfficeSubscription;
use App\Models\Plan;
use App\Repositories\System\Subscriptions\Contracts\PlanRepositoryInterface;
use App\Repositories\System\Subscriptions\Contracts\SubscriptionRepositoryInterface;
use App\Services\SubscriptionService;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class ChooseSubscriptionPlan extends Page
{
    protected static string $resource = SubscriptionResource::class;

    protected string $view = 'filament.office.pages.choose-subscription-plan';

    public ?string $couponCode = null;

    public function mount(): void
    {
        $this->couponCode = null;
    }

    public function getTitle(): string
    {
        return 'اختيار الباقة';
    }

    public function getPlans()
    {
        $repo = app(PlanRepositoryInterface::class);
        $plans = $repo->paginate(['active' => 1], 50);
        $plans->getCollection()->load(['translations', 'features']);

        $svc = app(SubscriptionService::class);
        $office = Auth::guard('office-panel')->user();
        $currentSubscription = OfficeSubscription::on('system')
            ->with(['plan.translations'])
            ->where('office_id', $office->id)
            ->where('status', 'active')
            ->where('active', true)
            ->where('ends_at', '>=', now())
            ->orderByDesc('ends_at')
            ->first();

        return $plans->getCollection()->map(function (Plan $plan) use ($svc, $currentSubscription) {
            $priced = $svc->priced($plan->code, $this->couponCode);

            $planName = $plan->translations->where('lang_code', 'ar')->first()?->name
                ?? $plan->translations->first()?->name
                ?? $plan->name;

            $isCurrent = $currentSubscription && $currentSubscription->plan_code === $plan->code;

            return [
                'code' => $plan->code,
                'name' => $planName,
                'description' => $plan->translations->where('lang_code', 'ar')->first()?->description
                    ?? $plan->translations->first()?->description
                    ?? $plan->description,
                'base_price' => $plan->base_price,
                'final_price' => $priced['price'] ?? $plan->base_price,
                'currency' => $priced['currency'] ?? $plan->base_currency,
                'billing_cycle' => $plan->billing_cycle,
                'features' => $plan->features->where('active', true)->map(function ($feature) {
                    return [
                        'key' => $feature->feature_key,
                        'limit' => $feature->limit,
                        'value' => $feature->value,
                    ];
                }),
                'is_current' => $isCurrent,
                'current_subscription' => $isCurrent ? [
                    'ends_at' => $currentSubscription->ends_at->format('Y-m-d'),
                    'auto_renew' => $currentSubscription->auto_renew,
                ] : null,
            ];
        });
    }

    public function subscribe(string $planCode): void
    {
        $office = Auth::guard('office-panel')->user();
        $svc = app(SubscriptionService::class);
        $subsRepo = app(SubscriptionRepositoryInterface::class);

        $priced = $svc->priced($planCode, $this->couponCode);

        if (! $priced) {
            Notification::make()
                ->title('الخطة غير متاحة')
                ->danger()
                ->send();

            return;
        }

        $subsRepo->createForOffice(
            $office->id,
            $planCode,
            $priced['currency'],
            $priced['price'],
            [
                'features' => $priced['features'] ?? [],
                'coupon' => $this->couponCode,
            ]
        );

        Notification::make()
            ->title('تم الاشتراك بنجاح')
            ->success()
            ->send();

        $this->redirect(SubscriptionResource::getUrl());
    }

    public function toggleAutoRenew($subscriptionId): void
    {
        $office = Auth::guard('office-panel')->user();
        $subsRepo = app(SubscriptionRepositoryInterface::class);

        $sub = OfficeSubscription::on('system')
            ->where('id', $subscriptionId)
            ->where('office_id', $office->id)
            ->first();

        if (! $sub) {
            Notification::make()
                ->title('لا يوجد اشتراك نشط')
                ->danger()
                ->send();

            return;
        }

        $currentSubscriptionId = OfficeSubscription::on('system')
            ->where('office_id', $office->id)
            ->where('status', 'active')
            ->where('active', true)
            ->where('ends_at', '>=', now())
            ->orderByDesc('ends_at')
            ->value('id');

        if (! $sub->auto_renew && $sub->id !== $currentSubscriptionId) {
            Notification::make()
                ->title('يمكن تفعيل التجديد التلقائي للباقة الحالية فقط')
                ->danger()
                ->send();

            return;
        }

        $updated = $subsRepo->setAutoRenew($sub->id, ! $sub->auto_renew);

        Notification::make()
            ->title($updated?->auto_renew ? 'تم تفعيل التجديد التلقائي' : 'تم إلغاء التجديد التلقائي')
            ->success()
            ->send();
    }

    public function getCurrentSubscription()
    {
        $office = Auth::guard('office-panel')->user();

        return OfficeSubscription::on('system')
            ->with(['plan.translations', 'plan.features'])
            ->where('office_id', $office->id)
            ->where('status', 'active')
            ->where('active', true)
            ->where('ends_at', '>=', now())
            ->orderByDesc('ends_at')
            ->first();
    }
}
