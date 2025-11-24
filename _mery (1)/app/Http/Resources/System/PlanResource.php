<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    public function toArray($request): array
    {
        $locale = app(\App\Services\LocaleService::class);
        $selected = null;
        if ($this->relationLoaded('translations')) {
            $selected = $locale->pickNameFromTranslations($this->translations, $locale->preferred($request));
        }

        return [
            'code' => $this->code,
            'name' => $selected['name'] ?? $this->name,
            'name_lang' => $selected['lang'] ?? null,
            'description' => $selected && $selected['lang']
                ? optional($this->translations->firstWhere('lang_code',$selected['lang']))?->description ?? $this->description
                : $this->description,
            'base_currency' => $this->base_currency,
            'base_price' => (float)$this->base_price,
            'billing_cycle' => $this->billing_cycle,
            'active' => (bool)$this->active,
            'features' => $this->whenLoaded('features', function () {
                return $this->features->mapWithKeys(function($f){
                    return [$f->feature_key => $f->limit ?? $f->value];
                });
            }),
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
        ];
    }
}
