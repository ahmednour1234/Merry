<?php

namespace App\Http\Requests\System\Page;

use Illuminate\Foundation\Http\FormRequest;

class UpsertPageTranslationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lang_code' => ['required', 'string', 'max:12'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'lang_code' => ['description' => 'Language code', 'example' => 'ar'],
            'title' => ['description' => 'Translated title', 'example' => 'عنوان الصفحة'],
            'content' => ['description' => 'Translated content', 'example' => 'محتوى الصفحة'],
            'meta_title' => ['description' => 'Translated meta title', 'example' => 'عنوان Meta'],
            'meta_description' => ['description' => 'Translated meta description', 'example' => 'وصف Meta'],
        ];
    }
}

