<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeSubscriptionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'plan_code' => $this->plan_code,
            'status' => $this->status,
            'auto_renew' => (bool)$this->auto_renew,
            'starts_at' => optional($this->starts_at)->toIso8601String(),
            'ends_at' => optional($this->ends_at)->toIso8601String(),
            'currency_code' => $this->currency_code,
            'price' => (float)$this->price,
            'plan' => $this->whenLoaded('plan', fn() => new PlanResource($this->plan)),
            'created_at' => optional($this->created_at)->toIso8601String(),
        ];
    }
}
