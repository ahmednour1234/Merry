<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'guard'         => $this->guard,
            'active'        => (bool) $this->active,
            'roles'         => $this->whenLoaded('roles', fn() => $this->roles->map(fn($r)=>[
                                    'id'=>$r->id,'name'=>$r->name,'slug'=>$r->slug,'guard'=>$r->guard
                                ])),
            'last_login_at' => optional($this->last_login_at)->toIso8601String(),
            'created_at'    => optional($this->created_at)->toIso8601String(),
            'updated_at'    => optional($this->updated_at)->toIso8601String(),
            'deleted_at'    => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
