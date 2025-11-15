<?php

namespace App\Http\Requests\EndUser\Auth;

use Illuminate\Foundation\Http\FormRequest;

class EndUserResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'code' => ['required', 'digits:6'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'Email address used during registration.',
                'example' => 'john@example.com',
            ],
            'code' => [
                'description' => 'Six-digit verification code sent to the email.',
                'example' => '123456',
            ],
            'password' => [
                'description' => 'New password.',
                'example' => 'newsecret123',
            ],
            'password_confirmation' => [
                'description' => 'Must match the password field.',
                'example' => 'newsecret123',
            ],
        ];
    }
}


