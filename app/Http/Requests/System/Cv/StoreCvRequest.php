<?php

namespace App\Http\Requests\System\Cv;

use Illuminate\Foundation\Http\FormRequest;

class StoreCvRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'category_id'      => ['nullable','integer','exists:system.categories,id'],
            'nationality_code' => ['required','string','max:8'],
            'gender'           => ['required','in:male,female'],
            'has_experience'   => ['required','boolean'],
            'file'             => ['required','file','mimetypes:application/pdf','max:10240'], // 10MB
            'meta'             => ['sometimes','array'],
        ];
    }

    // Scribe
    public function bodyParameters(): array
    {
        return [
            'category_id'      => ['description'=>'Optional category id','example'=>1],
            'nationality_code' => ['description'=>'Nationality code (ISO-2 or your code)','example'=>'PH'],
            'gender'           => ['description'=>'male|female','example'=>'female'],
            'has_experience'   => ['description'=>'Has experience?','example'=>true],
            'file'             => ['description'=>'PDF CV file','example'=>'(binary)'],
            'meta'             => ['description'=>'Free-form JSON metadata','example'=>['age'=>28,'notes'=>'live-in']],
        ];
    }
}
