<?php

namespace App\Http\Requests\System\Page;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => ['required','string','max:64','regex:/^[a-z0-9\-_.]+$/','unique:system.pages,slug'],
            'active' => ['sometimes','boolean'],
            'meta' => ['nullable','array'],
            'translations' => ['required','array','min:1'],
            'translations.*.title' => ['required','string','max:255'],
            'translations.*.content' => ['nullable','string'],
        ];
    }
}


