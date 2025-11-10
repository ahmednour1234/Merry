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
        // مود Bulk: في حالة وجود "cvs"
        if ($this->has('cvs')) {
            return [
                'cvs'                       => ['required', 'array', 'min:1'],

                'cvs.*.category_id'        => ['nullable', 'integer', 'exists:system.categories,id'],
                'cvs.*.nationality_code'   => ['required', 'string', 'max:8'],
                'cvs.*.gender'             => ['nullable', 'in:male,female'],
                'cvs.*.has_experience'     => ['required', 'boolean'],
                'cvs.*.is_muslim'          => ['required', 'boolean'],
                'cvs.*.file'               => ['required', 'file', 'mimetypes:application/pdf', 'max:10240'],
                'cvs.*.meta'               => ['sometimes', 'array'],
            ];
        }

        // مود Single: نفس القديم
        return [
            'category_id'      => ['nullable', 'integer', 'exists:system.categories,id'],
            'nationality_code' => ['required', 'string', 'max:8'],
            'gender'           => ['nullable', 'in:male,female'],
            'has_experience'   => ['required', 'boolean'],
            'is_muslim'        => ['required', 'boolean'],
            'file'             => ['required', 'file', 'mimetypes:application/pdf', 'max:10240'],
            'meta'             => ['sometimes', 'array'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            // Single mode
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

            // Bulk mode
            'cvs' => [
                'description' => 'Array of CVs for bulk create. Each item uses the same fields as single mode.',
                'example' => [
                    [
                        'category_id'      => 1,
                        'nationality_code' => 'PH',
                        'gender'           => 'female',
                        'has_experience'   => true,
                        'is_muslim'        => true,
                        'file'             => '(binary)',
                        'meta'             => ['age' => 28],
                    ],
                    [
                        'category_id'      => 2,
                        'nationality_code' => 'NP',
                        'gender'           => 'female',
                        'has_experience'   => false,
                        'is_muslim'        => false,
                        'file'             => '(binary)',
                        'meta'             => ['age' => 25],
                    ],
                ],
            ],
        ];
    }
}
