<?php

namespace App\Http\Requests\EndUser\Auth;

use Illuminate\Foundation\Http\FormRequest;

class EndUserLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'national_id' => ['required', 'string', 'exists:identity.end_users,national_id'],
            'password' => ['required', 'string']
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'national_id' => [
                'description' => 'Registered national ID.',
                'example' => '1234567890',
            ],
            'password' => [
                'description' => 'Account password.',
                'example' => 'secret123',
            ],
        ];
    }
}


