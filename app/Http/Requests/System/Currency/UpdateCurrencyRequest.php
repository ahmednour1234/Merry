<?php

namespace App\Http\Requests\System\Currency;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCurrencyRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'    => ['sometimes','string','max:64'],
            'symbol'  => ['sometimes','nullable','string','max:16'],
            'decimal' => ['sometimes','integer','min:0','max:6'],
            'active'  => ['sometimes','boolean'],
        ];
    }
    public function bodyParameters(): array
{
    return [
        'name'    => ['description'=>'Display name','example'=>'Saudi Riyal'],
        'symbol'  => ['description'=>'Symbol','example'=>'﷼'],
        'decimal' => ['description'=>'Fraction digits','example'=>2],
        'active'  => ['description'=>'Enabled','example'=>true],
    ];
}

}
