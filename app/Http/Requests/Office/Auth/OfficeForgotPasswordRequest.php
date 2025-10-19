<?php

namespace App\Http\Requests\Office\Auth;

use Illuminate\Foundation\Http\FormRequest;

class OfficeForgotPasswordRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'email' => ['required','email','exists:system.offices,email'],
        ];
    }
    public function bodyParameters(): array
{
    return [
        'email' => [
            'description' => 'البريد المرتبط بحساب المكتب لتوليد رمز الاستعادة.',
            'example' => 'office@example.com',
        ],
    ];
}

}
