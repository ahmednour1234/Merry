<?php

namespace App\Http\Resources\Office;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\System\CityResource;
use App\Http\Resources\System\PlanResource;
use App\Http\Resources\System\OfficeSubscriptionResource;
use App\Models\City;
use App\Models\OfficeSubscription;

class OfficeResource extends JsonResource
{
    public function toArray($request): array
    {
        // City
        $city = null;
        if ($this->city_id) {
            $c = City::on('system')->with('translations')->find($this->city_id);
            if ($c) $city = new CityResource($c);
        }

        // Active subscription
        $subscription = OfficeSubscription::on('system')
            ->with(['plan.translations','plan.features'])
            ->where('office_id', $this->id)
            ->where('active', true)
            ->orderByDesc('ends_at')
            ->first();

        // Image URL (prefers accessor if exists)
        $imageUrl = null;
        if (!empty($this->image)) {
            $imageUrl = $this->image_url ?? asset('storage/' . ltrim($this->image, '/'));
        }

        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'commercial_reg_no' => $this->commercial_reg_no,

            'city_id'           => $this->city_id,
            'city'              => $city,

            'address'           => $this->address,
            'phone'             => $this->phone,
            'email'             => $this->email,

            'active'            => (bool) $this->active,
            'blocked'           => (bool) $this->blocked,

            // 👇 الإضافات الجديدة الخاصة بالصورة
            'image'             => $this->image,     // المسار النسبي داخل الستوريج
            'image_url'         => $imageUrl,        // رابط كامل قابل للعرض

            'plan'              => $subscription && $subscription->plan ? new PlanResource($subscription->plan) : null,
            'subscription'      => $subscription ? new OfficeSubscriptionResource($subscription) : null,

            'last_login_at'     => optional($this->last_login_at)->toIso8601String(),
            'created_at'        => optional($this->created_at)->toIso8601String(),
            'updated_at'        => optional($this->updated_at)->toIso8601String(),
            'deleted_at'        => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
