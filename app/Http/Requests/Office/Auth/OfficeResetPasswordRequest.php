<?php

namespace App\Http\Requests\Office\Auth;

use Illuminate\Foundation\Http\FormRequest;

class OfficeResetPasswordRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'email'                 => ['required','email','exists:system.offices,email'],
            'code'                  => ['required','string','size:6'], // 6 أرقام
            'password'              => ['required','string','min:6'],
        ];
    }

    // توثيق Scribe
    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'البريد المرتبط بالحساب.',
                'example' => 'office@example.com',
            ],
            'code' => [
                'description' => 'كود الاستعادة المرسل عبر البريد (6 أرقام).',
                'example' => '123456',
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
