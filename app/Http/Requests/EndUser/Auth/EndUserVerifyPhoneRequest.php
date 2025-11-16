<?php

namespace App\Http\Requests\EndUser\Auth;

use Illuminate\Foundation\Http\FormRequest;

class EndUserVerifyPhoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'token' => [
                'description' => 'Token received from the start step.',
                'example' => 'fp_abcd1234',
            ],
            'phone' => [
                'description' => 'Phone number associated with the account.',
                'example' => '+966500000001',
            ],
        ];
    }
}



