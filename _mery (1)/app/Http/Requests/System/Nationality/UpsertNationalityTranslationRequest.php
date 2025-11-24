<?php

namespace App\Http\Requests\System\Nationality;

use Illuminate\Foundation\Http\FormRequest;

class UpsertNationalityTranslationRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'lang_code' => ['required','string','max:12'],
            'name'      => ['required','string','max:191'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'lang_code' => ['description'=>'Language code','example'=>'ar'],
            'name'      => ['description'=>'Translated name','example'=>'سعودي'],
        ];
    }
}
