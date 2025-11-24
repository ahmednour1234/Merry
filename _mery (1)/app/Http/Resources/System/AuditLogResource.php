<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class AuditLogResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'tenant_id' => $this->tenant_id,
            'user_id'   => $this->user_id,
            'action'    => $this->action,
            'model'     => $this->model,
            'model_id'  => $this->model_id,
            'request'   => $this->request ?? (object)[],
            'changes'   => $this->changes ?? (object)[],
            'ip'        => $this->ip,
            'ua'        => $this->ua,
            'active'    => (bool) $this->active,
            'created_at'=> optional($this->created_at)->toIso8601String(),
            'deleted_at'=> optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
