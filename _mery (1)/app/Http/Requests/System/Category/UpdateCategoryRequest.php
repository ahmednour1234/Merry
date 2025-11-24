<?php

namespace App\Http\Requests\System\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = (int) $this->route('id');

        return [
            'parent_id' => ['sometimes','nullable','integer','exists:system.categories,id', "not_in:$id"], // لا تجعل الأب نفسه
            'slug'      => ['sometimes','nullable','string','max:191', Rule::unique('system.categories','slug')->ignore($id)],
            'name'      => ['sometimes','string','max:191'],
            'active'    => ['sometimes','boolean'],
            'meta'      => ['sometimes','array'],

            'translations' => ['sometimes','array'],
            'translations.*.lang_code' => ['required_with:translations','string','max:12'],
            'translations.*.name'      => ['required_with:translations','string','max:191'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'parent_id'=>['description'=>'Parent category ID','example'=>1],
            'slug'     =>['description'=>'Unique slug','example'=>'deep-cleaning'],
            'name'     =>['description'=>'Default name','example'=>'Deep Cleaning'],
            'active'   =>['description'=>'Active flag','example'=>false],
            'translations'=>['description'=>'Replace/upsert translations','example'=>[['lang_code'=>'ar','name'=>'تنظيف عميق']]],
        ];
    }
}
