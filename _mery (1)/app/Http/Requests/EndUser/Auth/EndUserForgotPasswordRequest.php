<?php

namespace App\Http\Requests\EndUser\Auth;

use Illuminate\Foundation\Http\FormRequest;

class EndUserForgotPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'national_id' => ['required', 'string', 'exists:identity.end_users,national_id'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'national_id' => [
                'description' => 'National ID to locate the account.',
                'example' => '1234567890',
            ],
        ];
    }
}


