<?php

namespace App\Http\Requests\System\Page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = (int) $this->route('id');
        return [
            'slug' => ['sometimes','string','max:64','regex:/^[a-z0-9\-_.]+$/', Rule::unique('system.pages','slug')->ignore($id)],
            'active' => ['sometimes','boolean'],
            'meta' => ['nullable','array'],
            'translations' => ['sometimes','array'],
            'translations.*.title' => ['required_with:translations','string','max:255'],
            'translations.*.content' => ['nullable','string'],
        ];
    }
}


