<?php

namespace App\Http\Requests\System\Cv;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCvRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id'      => ['sometimes', 'nullable', 'integer', 'exists:system.categories,id'],
            'nationality_code' => ['sometimes', 'string', 'max:8'],
            'gender'           => ['sometimes', 'nullable', 'in:male,female'],
            'has_experience'   => ['sometimes', 'boolean'],
            'is_muslim'        => ['sometimes', 'boolean'],
            'file'             => ['sometimes', 'file', 'mimetypes:application/pdf', 'max:10240'],
            'meta'             => ['sometimes', 'array'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'category_id' => [
                'description' => 'Optional category id',
                'example'     => 2,
            ],
            'nationality_code' => [
                'description' => 'Nationality code',
                'example'     => 'NP',
            ],
            'gender' => [
                'description' => 'Optional gender (male|female)',
                'example'     => 'male',
            ],
            'has_experience' => [
                'description' => 'Has experience?',
                'example'     => false,
            ],
            'is_muslim' => [
                'description' => 'Is Muslim? true/false',
                'example'     => false,
            ],
            'file' => [
                'description' => 'PDF CV file (replace existing)',
                'example'     => 'resources/scribe/examples/cv-sample.pdf',
            ],
            'meta' => [
                'description' => 'Optional JSON metadata',
                'example'     => ['languages' => ['ar', 'en']],
            ],
        ];
    }
}
