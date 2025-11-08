<?php

namespace App\Http\Controllers\Api\Office;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\PlanResource;
use App\Http\Resources\System\OfficeSubscriptionResource;
use App\Repositories\System\Subscriptions\Contracts\PlanRepositoryInterface as PlanRepo;
use App\Repositories\System\Subscriptions\Contracts\SubscriptionRepositoryInterface as SubsRepo;
use App\Services\SubscriptionService;
use App\Services\CurrencyConversionService;
use Illuminate\Http\Request;
use App\Models\Plan;

class SubscriptionController extends ApiController
{
    public function __construct(
        protected PlanRepo $plans,
        protected SubsRepo $subs,
        protected SubscriptionService $svc
    ) {
        parent::__construct(app('api.responder'));
    }

    /**
     * GET /api/v1/office/plans
     * إرجاع قائمة الخطط مع سعر نهائي حسب العملة القادمة من الهيدر
     */
    public function plans(Request $request)
    {
        $perPage = max(1, (int) $request->integer('per_page', 50));

        // جلب الخطط المفعلة
        $paginator = $this->plans->paginate(['active' => 1], $perPage);

        // تحميل العلاقات المطلوبة
        $paginator->getCollection()->load(['translations', 'features']);

        // تحديد العملة المستهدفة من الهيدر
        /** @var CurrencyConversionService $currencySvc */
        $currencySvc = app(CurrencyConversionService::class);
        $targetCurrency = $currencySvc->headerTarget();

        // تجهيز الداتا مع PlanResource + final_price/final_currency
        $modifiedCollection = $paginator->getCollection()->map(function (Plan $plan) use ($targetCurrency) {
            $priced = $this->svc->priced(
                $plan->code,
                couponCode: null,
                targetCurrencyFromHeader: $targetCurrency
            );

            $base = (new PlanResource($plan))->toArray(request());

            return array_merge($base, [
                'final_price'    => isset($priced['price'])
                    ? (float) $priced['price']
                    : (float) $plan->base_price,
                'final_currency' => $priced['currency'] ?? $plan->base_currency,
            ]);
        });

        // استبدال الكولكشن داخل الـ paginator
        $paginator->setCollection($modifiedCollection);

        /**
         * ملاحظة:
         * أغلب Implementations لـ paginated تكون مثلاً:
         * paginated(LengthAwarePaginator $paginator, ?string $resourceClass = null, ?string $message = null)
         * عشان كده:
         * - المعامل الثاني = null (مش Resource class لأننا بالفعل رجعنا Arrays جاهزة)
         * - المعامل الثالث = رسالة
         */
        return $this->responder->paginated($paginator, null, 'Plans priced');
    }

    /**
     * GET /api/v1/office/subscription
     * إرجاع الاشتراك الحالي للمكتب
     */
    public function current(Request $request)
    {
        $office = $request->user();
        $sub = $this->subs->currentForOffice($office->id);

        if (!$sub) {
            return $this->responder->ok(null, 'No active subscription');
        }

        return $this->responder->ok(
            new OfficeSubscriptionResource($sub->load('plan')),
            'Current subscription'
        );
    }

    /**
     * POST /api/v1/office/subscribe
     * body: plan_code, coupon (optional)
     */
    public function subscribe(Request $request)
    {
        $office = $request->user();

        $data = $request->validate([
            'plan_code' => 'required|string|exists:system.plans,code',
            'coupon'    => 'nullable|string|max:64',
        ]);

        $priced = $this->svc->priced(
            $data['plan_code'],
            $data['coupon'] ?? null
        );

        if (!$priced) {
            return $this->responder->fail('Plan not available', 422);
        }

        // TODO: مكان تنفيذ الدفع الفعلي/التحقق
        $row = $this->subs->createForOffice(
            $office->id,
            $data['plan_code'],
            $priced['currency'],
            $priced['price'],
            [
                'features' => $priced['features'] ?? [],
                'coupon'   => $data['coupon'] ?? null,
            ]
        );

        return $this->responder->created(
            new OfficeSubscriptionResource($row->load('plan')),
            'Subscribed'
        );
    }

    /**
     * POST /api/v1/office/subscription/auto-renew
     * body: { auto_renew: bool }
     */
    public function autoRenew(Request $request)
    {
        $office = $request->user();

        $request->validate([
            'auto_renew' => 'required|boolean',
        ]);

        $sub = $this->subs->currentForOffice($office->id);

        if (!$sub) {
            return $this->responder->fail('No active subscription', 404);
        }

        $updated = $this->subs->setAutoRenew(
            $sub->id,
            (bool) $request->boolean('auto_renew')
        );

        return $this->responder->ok(
            new OfficeSubscriptionResource($updated->load('plan')),
            'Auto-renew updated'
        );
    }
}
