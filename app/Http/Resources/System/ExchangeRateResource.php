<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeRateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'base'       => $this->base,
            'quote'      => $this->quote,
            'rate'       => (string) $this->rate,
            'fetched_at' => optional($this->fetched_at)->toIso8601String(),
            'active'     => (bool) $this->active,
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
            'deleted_at' => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
