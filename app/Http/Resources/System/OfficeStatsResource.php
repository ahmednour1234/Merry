<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeStatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * Expected input (any can be absent):
     * - total_offices
     * - active_offices
     * - blocked_offices
     * - inactive_offices (optional; if absent we compute it)
     * - total_cvs
     */
    public function toArray($request): array
    {
        $total   = (int) ($this->resource['total_offices']   ?? 0);
        $active  = (int) ($this->resource['active_offices']  ?? 0);
        $blocked = (int) ($this->resource['blocked_offices'] ?? 0);

        // Use provided inactive_offices if present; otherwise compute it.
        $inactive = array_key_exists('inactive_offices', (array) $this->resource)
            ? (int) $this->resource['inactive_offices']
            : max(0, $total - $active - $blocked);

        return [
            'total_offices'    => $total,
            'active_offices'   => $active,
            'inactive_offices' => $inactive,
            'blocked_offices'  => $blocked,
            'total_cvs'        => (int) ($this->resource['total_cvs'] ?? 0),
        ];
    }
}
