<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class InsuranceCompanyResource extends JsonResource
{
public function toArray($request): array
{
    /** @var \App\Services\CurrencyConversionService $fx */
    $fx = app(\App\Services\CurrencyConversionService::class);

    $from  = $this->currency_code ?: null;
    $to    = $fx->headerTarget(); // من الهيدر لو موجود
    $amt   = $this->insurance_amount !== null ? (float)$this->insurance_amount : null;

    $converted = ($amt !== null && $from && $to)
        ? $fx->convert($amt, $from, $to)
        : null;

    return [
        'id'        => $this->id,
        'name'      => $this->name,
        'website'   => $this->website,
        'active'    => (bool)$this->active,
        'logo_path' => $this->logo_path,
        'logo_url'  => $this->logo_path ? \Illuminate\Support\Facades\Storage::disk('public')->url($this->logo_path) : null,

        'insurance' => [
            'amount'        => $amt,
            'currency_code' => $from,
            'converted'     => [
                'amount'  => $converted,
                'to'      => $to,
                'rate'    => ($amt !== null && $from && $to) ? app(\App\Services\CurrencyConversionService::class)->rate($from, $to) : null,
            ],
        ],

        'created_at'=> optional($this->created_at)->toIso8601String(),
        'updated_at'=> optional($this->updated_at)->toIso8601String(),
        'deleted_at'=> optional($this->deleted_at)->toIso8601String(),
    ];
}

}
