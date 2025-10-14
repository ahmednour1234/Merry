<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class InsuranceCompanyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'website'   => $this->website,
            'active'    => (bool)$this->active,
            'logo_path' => $this->logo_path,
            'logo_url'  => $this->logo_path ? Storage::disk('public')->url($this->logo_path) : null,
            'created_at'=> optional($this->created_at)->toIso8601String(),
            'updated_at'=> optional($this->updated_at)->toIso8601String(),
            'deleted_at'=> optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
