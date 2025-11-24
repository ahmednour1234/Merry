<?php

namespace App\Http\Requests\Office\Fcm;

use Illuminate\Foundation\Http\FormRequest;

class StoreFcmTokenRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'token' => ['required','string','max:512'],
            'device'=> ['nullable','string','max:191'],
            'platform'=> ['nullable','string','max:191'],
        ];
    }
    public function bodyParameters(): array
{
    return [
        'token' => [
            'description' => 'Firebase Cloud Messaging token.',
            'example' => 'fcm_token_xxx_yyy_zzz',
        ],
        'device' => [
            'description' => 'نوع الجهاز (ios / android / web).',
            'example' => 'android',
        ],
        'platform' => [
            'description' => 'منصة العميل/التطبيق إن لزم.',
            'example' => 'office-app',
        ],
    ];
}

}
