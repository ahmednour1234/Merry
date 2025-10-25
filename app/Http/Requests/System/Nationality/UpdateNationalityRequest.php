<?php

namespace App\Http\Requests\System\Nationality;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNationalityRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = (int)$this->route('id');

        return [
            'code'   => ['sometimes','string','max:8', Rule::unique('system.nationalities','code')->ignore($id)],
            'name'   => ['sometimes','string','max:191'],
            'active' => ['sometimes','boolean'],
            'meta'   => ['sometimes','array'],
            // optional replace/upsert translations
            'translations' => ['sometimes','array'],
            'translations.*.lang_code' => ['required_with:translations','string','max:12'],
            'translations.*.name'      => ['required_with:translations','string','max:191'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'code' => ['description'=>'Unique code','example'=>'EG'],
            'name' => ['description'=>'Default name','example'=>'Egyptian'],
            'active' => ['description'=>'Active flag','example'=>false],
            'translations' => ['description'=>'Replace/upsert translations','example'=>[['lang_code'=>'ar','name'=>'مصري']]],
        ];
    }
}
