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
            'reset_token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'reset_token' => [
                'description' => 'Token received after phone verification.',
                'example' => 'rp_abcdef123456',
            ],
            'password' => [
                'description' => 'New password.',
                'example' => 'newsecret1234',
            ],
            'password_confirmation' => [
                'description' => 'Must match the password field.',
                'example' => 'newsecret1234',
            ],
        ];
    }
}


