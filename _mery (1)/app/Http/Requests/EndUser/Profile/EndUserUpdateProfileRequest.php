<?php

namespace App\Http\Requests\EndUser\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EndUserUpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = (int) ($this->user()?->getKey() ?? 0);

        return [
            'name' => ['sometimes', 'required', 'string', 'max:191'],
            'phone' => [
                'sometimes',
                'nullable',
                'string',
                'max:32',
                Rule::unique('identity.end_users', 'phone')->ignore($userId),
            ],
            'country_id' => ['sometimes', 'nullable', 'integer', 'exists:system.nationalities,id'],
            'city_id' => ['sometimes', 'nullable', 'integer', 'exists:system.cities,id'],
            'bio' => ['sometimes', 'nullable', 'string'],
            'avatar' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Updated full name.',
                'example' => 'Johnathan Doe',
            ],
            'phone' => [
                'description' => 'Updated phone number.',
                'example' => '+966511111111',
            ],
            'country_id' => [
                'description' => 'Updated nationality identifier.',
                'example' => 2,
            ],
            'city_id' => [
                'description' => 'Updated city identifier.',
                'example' => 8,
            ],
            'bio' => [
                'description' => 'Updated bio text.',
                'example' => 'Photographer and traveler.',
            ],
            'avatar' => [
                'description' => 'New profile photo.',
                'example' => 'resources/scribe/examples/avatar.png',
            ],
        ];
    }
}


