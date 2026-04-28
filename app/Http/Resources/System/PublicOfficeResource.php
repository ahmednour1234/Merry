<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Public office resource — no sensitive data exposed.
 */
class PublicOfficeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'city_id'    => $this->city_id,
            'address'    => $this->address,
            'phone'      => $this->phone,
            'email'      => $this->email,
            'image_url'  => $this->image_url,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
