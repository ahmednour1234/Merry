<?php

namespace App\Http\Requests\System\SystemLanguage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSystemLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code'        => ['required','string','max:12', 'regex:/^[a-z]{2}(-[A-Z]{2})?$/'],
            'name'        => ['required','string','max:100'],
            'native_name' => ['nullable','string','max:100'],
            'rtl'         => ['nullable','boolean'],
            'status'      => ['nullable', Rule::in(['active','inactive'])],
            'meta'        => ['nullable','array'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.regex' => 'Code must be like en or en-US',
        ];
    }
    public function bodyParameters(): array
{
    return [
        'code' => ['description'=>'Two-letter or RFC (en-US).','example'=>'ar'],
        'name' => ['description'=>'Localized name.','example'=>'Arabic'],
        'native_name' => ['description'=>'Native name.','example'=>'العربية'],
        'rtl' => ['description'=>'Right-to-left language.','example'=>true],
        'status' => ['description'=>'active|inactive','example'=>'active'],
    ];
}

}
