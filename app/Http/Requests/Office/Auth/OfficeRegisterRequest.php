<?php

namespace App\Http\Requests\Office\Auth;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRegisterRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:191'],
            'commercial_reg_no' => ['required','string','max:191','unique:system.offices,commercial_reg_no'],
            'city_id' => ['nullable','integer'],
            'address' => ['nullable','string','max:255'],
            'phone' => ['nullable','string','max:32'],
            'email' => ['required','email','max:191','unique:system.offices,email'],
            'password' => ['required','string','min:6','confirmed'], // password_confirmation
        ];
    }
    public function bodyParameters(): array
{
    return [
        'name' => [
            'description' => 'اسم المكتب.',
            'example' => 'مكتب التميز للاستقدام',
        ],
        'commercial_reg_no' => [
            'description' => 'رقم السجل التجاري (فريد).',
            'example' => '1010123456',
        ],
        'city_id' => [
            'description' => 'معرّف المدينة (cities.id).',
            'example' => 1,
        ],
        'address' => [
            'description' => 'العنوان التفصيلي.',
            'example' => 'الرياض - حي العليا - شارع xx',
        ],
        'phone' => [
            'description' => 'رقم الجوال.',
            'example' => '+966500000000',
        ],
        'email' => [
            'description' => 'البريد الإلكتروني (فريد).',
            'example' => 'office@example.com',
        ],
        'password' => [
            'description' => 'كلمة المرور.',
            'example' => 'secret123',
        ],
        'password_confirmation' => [
            'description' => 'تأكيد كلمة المرور.',
            'example' => 'secret123',
        ],
    ];
}

}
