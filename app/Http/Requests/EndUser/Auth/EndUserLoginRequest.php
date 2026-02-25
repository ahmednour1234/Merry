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
            'phone' => ['required', 'string', 'exists:identity.end_users,phone'],
            'password' => ['required', 'string']
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'phone' => [
                'description' => 'Registered phone number.',
                'example' => '+966500000001',
            ],
            'password' => [
                'description' => 'Account password.',
                'example' => 'secret123',
            ],
        ];
    }
}


