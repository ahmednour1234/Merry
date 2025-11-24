<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;
class RoleResource extends JsonResource
{
public function toArray($request): array
{
    return [
        'id'      => $this->id,
        'name'    => $this->name,
        'slug'    => $this->slug,
        'guard'   => $this->guard,
        'active'  => (bool)$this->active,
        'users_count' => (int) ($this->users_count ?? 0), // << هنا
        'permissions' => $this->whenLoaded('permissions', fn() => $this->permissions->map(fn($p)=>[
            'id'=>$p->id,'name'=>$p->name,'slug'=>$p->slug
        ])),
        'created_at'=> optional($this->created_at)->toIso8601String(),
        'updated_at'=> optional($this->updated_at)->toIso8601String(),
        'deleted_at'=> optional($this->deleted_at)->toIso8601String(),
    ];
}
}
