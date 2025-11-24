<?php

namespace App\Http\Requests\Office\Auth;

use Illuminate\Foundation\Http\FormRequest;

class OfficeLoginRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'email' => ['required','email'],
            'password' => ['required','string'],
        ];
    }
    public function bodyParameters(): array
{
    return [
        'email' => [
            'description' => 'البريد الإلكتروني للمكتب.',
            'example' => 'office@example.com',
        ],
        'password' => [
            'description' => 'كلمة المرور.',
            'example' => 'secret123',
        ],
    ];
}

}
