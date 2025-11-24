<?php

namespace App\Http\Requests\System\Currency;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'code'    => ['required','string','max:8'],
            'name'    => ['required','string','max:64'],
            'symbol'  => ['nullable','string','max:16'],
            'decimal' => ['nullable','integer','min:0','max:6'],
            'active'  => ['nullable','boolean'],
        ];
    }
    public function bodyParameters(): array
{
    return [
        'code'    => ['description'=>'ISO code','example'=>'SAR'],
        'name'    => ['description'=>'Display name','example'=>'Saudi Riyal'],
        'symbol'  => ['description'=>'Symbol','example'=>'﷼'],
        'decimal' => ['description'=>'Fraction digits','example'=>2],
        'active'  => ['description'=>'Enabled','example'=>true],
    ];
}

}
