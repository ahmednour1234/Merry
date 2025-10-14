<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class SystemLanguageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'code'        => $this->code,
            'name'        => $this->name,
            'native_name' => $this->native_name,
            'rtl'         => (bool) $this->rtl,
            'status'      => $this->status,
            'meta'        => $this->meta ?? (object) [],
            'updated_at'  => optional($this->updated_at)->toIso8601String(),
            'created_at'  => optional($this->created_at)->toIso8601String(),
        ];
    }
}
