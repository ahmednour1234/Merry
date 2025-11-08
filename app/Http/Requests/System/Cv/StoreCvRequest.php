<?php

namespace App\Http\Requests\System\Cv;

use Illuminate\Foundation\Http\FormRequest;

class StoreCvRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id'      => ['nullable', 'integer', 'exists:system.categories,id'],
            'nationality_code' => ['required', 'string', 'max:8'],
            'gender'           => ['nullable', 'in:male,female'],
            'has_experience'   => ['required', 'boolean'],

            // هل هي مسلمة ولا لا (إجباري yes/no)
            'is_muslim'        => ['required', 'boolean'],

            'file'             => ['required', 'file', 'mimetypes:application/pdf', 'max:10240'],
            'meta'             => ['sometimes', 'array'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'category_id' => [
                'description' => 'Optional category id',
                'example'     => 1,
            ],
            'nationality_code' => [
                'description' => 'Nationality code (ISO-2 or your custom code)',
                'example'     => 'PH',
            ],
            'gender' => [
                'description' => 'Optional gender (male|female)',
                'example'     => 'female',
            ],
            'has_experience' => [
                'description' => 'Has previous experience? true/false',
                'example'     => true,
            ],
            'is_muslim' => [
                'description' => 'Is Muslim? true/false',
                'example'     => true,
            ],
            'file' => [
                'description' => 'Required PDF CV file',
                'example'     => '(binary)',
            ],
            'meta' => [
                'description' => 'Optional JSON metadata',
                'example'     => ['age' => 28, 'notes' => 'live-in'],
            ],
        ];
    }
}
