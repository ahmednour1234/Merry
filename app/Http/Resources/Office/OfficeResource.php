<?php

namespace App\Http\Resources\Office;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'commercial_reg_no' => $this->commercial_reg_no,
            'city_id' => $this->city_id,
            'address'=> $this->address,
            'phone'  => $this->phone,
            'email'  => $this->email,
            'active' => (bool)$this->active,
            'blocked'=> (bool)$this->blocked,
            'last_login_at' => optional($this->last_login_at)->toIso8601String(),
            'created_at'    => optional($this->created_at)->toIso8601String(),
            'updated_at'    => optional($this->updated_at)->toIso8601String(),
            'deleted_at'    => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
