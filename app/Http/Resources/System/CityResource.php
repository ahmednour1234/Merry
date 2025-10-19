<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'           => $this->id,
            'slug'         => $this->slug,
            'country_code' => $this->country_code,
            'active'       => (bool)$this->active,
            'translations' => $this->whenLoaded('translations', function () {
                return $this->translations->mapWithKeys(fn($t) => [$t->lang_code => $t->name]);
            }),
            'created_at'   => optional($this->created_at)->toIso8601String(),
            'updated_at'   => optional($this->updated_at)->toIso8601String(),
            'deleted_at'   => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
