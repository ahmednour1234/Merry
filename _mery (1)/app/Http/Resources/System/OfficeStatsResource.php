<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeStatsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'total_offices'  => (int) ($this->resource['total_offices'] ?? 0),
            'active_offices' => (int) ($this->resource['active_offices'] ?? 0),
            'blocked_offices'=> (int) ($this->resource['blocked_offices'] ?? 0),
            'total_cvs'      => (int) ($this->resource['total_cvs'] ?? 0),
        ];
    }
}


