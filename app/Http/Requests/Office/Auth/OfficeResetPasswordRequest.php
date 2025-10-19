<?php

namespace App\Http\Requests\Office\Auth;

use Illuminate\Foundation\Http\FormRequest;

class OfficeResetPasswordRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'email' => ['required','email','exists:system.offices,email'],
            'token' => ['required','string'],
            'password' => ['required','string','min:6','confirmed'],
        ];
    }
    public function bodyParameters(): array
{
    return [
        'email' => [
            'description' => 'البريد المرتبط بالحساب.',
            'example' => 'office@example.com',
        ],
        'token' => [
            'description' => 'رمز الاستعادة المُولَّد عبر forgot-password.',
            'example' => 'b8b0b4d6b3d34d5c9c3a7f2b4e0a6f8c9d1e2f3a4b5c6d7e8f9a0b1c2d3e4f5',
        ],
        'password' => [
            'description' => 'كلمة المرور الجديدة.',
            'example' => 'NewStrongPass!23',
        ],
        'password_confirmation' => [
            'description' => 'تأكيد كلمة المرور الجديدة.',
            'example' => 'NewStrongPass!23',
        ],
    ];
}

}
