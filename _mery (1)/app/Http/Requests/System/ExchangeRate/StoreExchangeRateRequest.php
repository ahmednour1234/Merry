<?php

namespace App\Http\Requests\System\ExchangeRate;

use Illuminate\Foundation\Http\FormRequest;

class StoreExchangeRateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'base'       => ['required','string','max:8'],
            'quote'      => ['required','string','max:8','different:base'],
            'rate'       => ['required','numeric','gt:0'],
            'fetched_at' => ['nullable','date'],
            'active'     => ['nullable','boolean'],
        ];
    }
    public function bodyParameters(): array
{
    return [
        'base'       => ['description'=>'Base currency','example'=>'USD'],
        'quote'      => ['description'=>'Quote currency','example'=>'EGP'],
        'rate'       => ['description'=>'Exchange rate','example'=>48.25000000],
        'fetched_at' => ['description'=>'Timestamp','example'=>'2025-10-13T12:00:00Z'],
        'active'     => ['description'=>'Enabled','example'=>true],
    ];
}

}
