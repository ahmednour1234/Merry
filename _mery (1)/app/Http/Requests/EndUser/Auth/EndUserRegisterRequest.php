<?php

namespace App\Http\Requests\EndUser\Auth;

use Illuminate\Foundation\Http\FormRequest;

class EndUserRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'national_id' => ['required', 'string', 'unique:identity.end_users,national_id'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', 'min:8'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'national_id' => [
                'description' => 'Unique national identifier used for login.',
                'example' => '1234567890',
            ],
            'name' => [
                'description' => 'Full name.',
                'example' => 'John Doe',
            ],
            'phone' => [
                'description' => 'Phone number.',
                'example' => '+966500000001',
            ],
            'password' => [
                'description' => 'Password (min 8 characters).',
                'example' => 'secret1234',
            ],
            'password_confirmation' => [
                'description' => 'Must match the password field.',
                'example' => 'secret1234',
            ],
        ];
    }
}

