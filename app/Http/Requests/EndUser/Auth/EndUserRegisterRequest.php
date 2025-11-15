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
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'max:191', 'unique:identity.end_users,email'],
            'phone' => ['nullable', 'string', 'max:32', 'unique:identity.end_users,phone'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'country_id' => ['nullable', 'integer', 'exists:system.nationalities,id'],
            'city_id' => ['nullable', 'integer', 'exists:system.cities,id'],
            'bio' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Full name of the end user.',
                'example' => 'John Doe',
            ],
            'email' => [
                'description' => 'Unique email address.',
                'example' => 'john@example.com',
            ],
            'phone' => [
                'description' => 'Phone number (optional).',
                'example' => '+966500000000',
            ],
            'password' => [
                'description' => 'Account password (min 6 characters).',
                'example' => 'secret123',
            ],
            'password_confirmation' => [
                'description' => 'Must match the password field.',
                'example' => 'secret123',
            ],
            'country_id' => [
                'description' => 'Related nationality identifier from the system database.',
                'example' => 1,
            ],
            'city_id' => [
                'description' => 'Related city identifier from the system database.',
                'example' => 5,
            ],
            'bio' => [
                'description' => 'Short bio or about text.',
                'example' => 'Travel enthusiast and blogger.',
            ],
            'avatar' => [
                'description' => 'Profile photo file (JPEG/PNG/WEBP).',
                'example' => 'avatar.jpg',
            ],
        ];
    }
}


