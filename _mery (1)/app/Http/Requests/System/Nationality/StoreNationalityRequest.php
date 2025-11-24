<?php

namespace App\Http\Requests\System\Nationality;

use Illuminate\Foundation\Http\FormRequest;

class StoreNationalityRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'code'   => ['required','string','max:8','unique:system.nationalities,code'],
            'name'   => ['required','string','max:191'],
            'active' => ['nullable','boolean'],
            'meta'   => ['nullable','array'],
            // optional translations on create
            'translations' => ['sometimes','array'],
            'translations.*.lang_code' => ['required_with:translations','string','max:12'],
            'translations.*.name'      => ['required_with:translations','string','max:191'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'code' => ['description'=>'Unique code (ISO like)','example'=>'SA'],
            'name' => ['description'=>'Default name','example'=>'Saudi'],
            'active' => ['description'=>'Active flag','example'=>true],
            'translations' => ['description'=>'Optional translations array','example'=>[['lang_code'=>'ar','name'=>'سعودي']]],
        ];
    }
}
