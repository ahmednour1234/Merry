<?php

namespace App\Http\Controllers\Api\Office;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\PlanResource;
use App\Http\Resources\System\OfficeSubscriptionResource;
use App\Repositories\System\Subscriptions\Contracts\PlanRepositoryInterface as PlanRepo;
use App\Repositories\System\Subscriptions\Contracts\SubscriptionRepositoryInterface as SubsRepo;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends ApiController
{
    public function __construct(
        protected PlanRepo $plans,
        protected SubsRepo $subs,
        protected SubscriptionService $svc
    ) {
        parent::__construct(app('api.responder'));
    }

    /** GET /api/v1/office/plans  (قائمة خطط + سعر نهائي بالعملة الهيدر) */
    public function plans(Request $r)
    {
        $per = max(1, (int)$r->integer('per_page', 50));
        $p = $this->plans->paginate(['active'=>1], $per);
        $p->getCollection()->load(['translations','features']);

        // أضف pricing سريع
        $target = app(\App\Services\CurrencyConversionService::class)->headerTarget();
        $data = $p->getCollection()->map(function($plan) use ($target){
            $priced = $this->svc->priced($plan->code, couponCode: null, targetCurrencyFromHeader: $target);
            return array_merge((new PlanResource($plan))->toArray(request()), [
                'final_price' => $priced['price'] ?? (float)$plan->base_price,
                'final_currency' => $priced['currency'] ?? $plan->base_currency,
            ]);
        });

        // رجّع Paginated بنفس الشكل
        $p->setCollection(collect($data));
        return $this->responder->paginated($p, 'Plans priced');
    }

    /** GET /api/v1/office/subscription (الحالي) */
    public function current(Request $r)
    {
        $office = $r->user();
        $sub = $this->subs->currentForOffice($office->id);
        if (!$sub) return $this->responder->ok(null, 'No active subscription');
        return $this->responder->ok(new OfficeSubscriptionResource($sub->load('plan')), 'Current subscription');
    }

    /** POST /api/v1/office/subscribe  (plan_code, coupon?) */
    public function subscribe(Request $r)
    {
        $office = $r->user();
        $data = $r->validate([
            'plan_code' => 'required|string|exists:system.plans,code',
            'coupon' => 'nullable|string|max:64',
        ]);

        $priced = $this->svc->priced($data['plan_code'], $data['coupon']);
        if (!$priced) return $this->responder->fail('Plan not available', 422);

        // NOTE: هنا الدفع الحقيقي/التحقّق… نحن ننشئ الاشتراك مباشرةً
        $row = $this->subs->createForOffice(
            $office->id,
            $data['plan_code'],
            $priced['currency'],
            $priced['price'],
            ['features'=>$priced['features'],'coupon'=>$data['coupon']]
        );

        return $this->responder->created(new OfficeSubscriptionResource($row->load('plan')), 'Subscribed');
    }

    /** POST /api/v1/office/subscription/auto-renew {auto_renew:bool} */
    public function autoRenew(Request $r)
    {
        $office = $r->user();
        $r->validate(['auto_renew'=>'required|boolean']);
        $sub = $this->subs->currentForOffice($office->id);
        if (!$sub) return $this->responder->fail('No active subscription', 404);

        $updated = $this->subs->setAutoRenew($sub->id, (bool)$r->boolean('auto_renew'));
        return $this->responder->ok(new OfficeSubscriptionResource($updated->load('plan')), 'Auto-renew updated');
    }
}
