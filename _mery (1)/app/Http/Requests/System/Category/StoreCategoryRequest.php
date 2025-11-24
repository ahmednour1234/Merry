<?php

namespace App\Http\Requests\System\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'parent_id' => ['nullable','integer','exists:system.categories,id'],
            'slug'      => ['nullable','string','max:191','unique:system.categories,slug'],
            'name'      => ['required','string','max:191'],
            'active'    => ['nullable','boolean'],
            'meta'      => ['nullable','array'],

            'translations' => ['sometimes','array'],
            'translations.*.lang_code' => ['required_with:translations','string','max:12'],
            'translations.*.name'      => ['required_with:translations','string','max:191'],
        ];
    }

    // Scribe
    public function bodyParameters(): array
    {
        return [
            'parent_id'=>['description'=>'Parent category ID (optional)','example'=>null],
            'slug'     =>['description'=>'Unique slug (optional)','example'=>'home-cleaning'],
            'name'     =>['description'=>'Default name','example'=>'Home Cleaning'],
            'active'   =>['description'=>'Active flag','example'=>true],
            'translations'=>['description'=>'Optional translations','example'=>[['lang_code'=>'ar','name'=>'تنظيف منزلي']]],
        ];
    }
}
