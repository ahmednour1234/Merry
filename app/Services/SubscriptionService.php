<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SubscriptionService
{
    protected string $conn = 'system';

    public function __construct(
        protected CurrencyConversionService $fx
    ) {}

    public function getPlan(string $code): ?\stdClass
    {
        return DB::connection($this->conn)->table('plans')->where('code',$code)->where('active',1)->first();
    }

    public function features(string $planCode): array
    {
        $rows = DB::connection($this->conn)->table('plan_features')
            ->where('plan_code',$planCode)->where('active',1)->get();

        $out = [];
        foreach ($rows as $r) {
            $out[$r->feature_key] = $r->limit ?? (is_null($r->value) ? null : json_decode((string)$r->value, true));
        }
        return $out;
    }

    /** احسب أفضل سعر نهائي لخطة مع الأخذ في الاعتبار البروموشنز + كوبون (اختياري) + تحويل العملة (اختياري من الهيدر) */
    public function priced(string $planCode, ?string $couponCode = null, ?string $targetCurrencyFromHeader = null): ?array
    {
        $plan = $this->getPlan($planCode);
        if (!$plan) return null;

        $price = (float)$plan->base_price;
        $currency = $plan->base_currency;

        // 1) Promotions auto-apply
        $promo = $this->findAutoPromotion($planCode);
        if ($promo) {
            [$price, $currency] = $this->applyDiscount($price, $currency, $promo->type, (float)$promo->amount, $promo->currency_code);
        }

        // 2) Coupon (لو مطلوب)
        if ($couponCode) {
            $coupon = $this->findValidCoupon($couponCode, $planCode);
            if ($coupon) {
                [$price, $currency] = $this->applyDiscount($price, $currency, $coupon->type, (float)$coupon->amount, $coupon->currency_code);
            }
        }

        // 3) تحويل العملة إن وجد هيدر مطلوب
        $to = $targetCurrencyFromHeader ?: $this->fx->headerTarget();
        if ($to && strtoupper($to) !== strtoupper($currency)) {
            $converted = $this->fx->convert($price, $currency, $to);
            if ($converted !== null) {
                $price = $converted;
                $currency = strtoupper($to);
            }
        }

        return [
            'plan' => $plan,
            'price' => round($price, 2),
            'currency' => $currency,
            'features' => $this->features($planCode),
        ];
    }

    protected function findAutoPromotion(string $planCode): ?\stdClass
    {
        $now = now();
        return DB::connection($this->conn)->table('promotions')
            ->where('active',1)
            ->where('auto_apply',1)
            ->where(function($q) use ($planCode){
                $q->whereNull('plan_code')->orWhere('plan_code',$planCode);
            })
            ->where(function($q) use ($now){
                $q->whereNull('starts_at')->orWhere('starts_at','<=',$now);
            })
            ->where(function($q) use ($now){
                $q->whereNull('ends_at')->orWhere('ends_at','>=',$now);
            })
            ->orderByDesc('id')
            ->first();
    }

    protected function findValidCoupon(string $code, string $planCode): ?\stdClass
    {
        $now = now();
        $row = DB::connection($this->conn)->table('coupons')
            ->where('code',$code)->where('active',1)
            ->where(function($q) use ($now){
                $q->whereNull('starts_at')->orWhere('starts_at','<=',$now);
            })
            ->where(function($q) use ($now){
                $q->whereNull('ends_at')->orWhere('ends_at','>=',$now);
            })
            ->first();

        // شروط إضافية: ممكن تخزن داخل meta allowed_plans… إلخ
        // لو محتاج تتحقق: رجّع null لو الخطة غير مسموح بها.

        return $row ?: null;
    }

    protected function applyDiscount(float $price, string $priceCurrency, string $type, float $amount, ?string $amountCurrency = null): array
    {
        if ($type === 'percent') {
            $price = max(0, $price * (1 - ($amount/100)));
            return [$price, $priceCurrency];
        }

        // fixed: لو الكوبون/البروموشن عملته مختلفة، حوّلها لسعر العملة الحالية
        if ($type === 'fixed') {
            if ($amountCurrency && strtoupper($amountCurrency) !== strtoupper($priceCurrency)) {
                $converted = $this->fx->convert($amount, $amountCurrency, $priceCurrency);
                if ($converted !== null) $amount = $converted;
            }
            $price = max(0, $price - $amount);
            return [$price, $priceCurrency];
        }

        return [$price, $priceCurrency];
    }
}
