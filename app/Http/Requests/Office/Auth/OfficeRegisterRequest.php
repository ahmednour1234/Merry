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
            'password' => ['required','string','min:6','confirmed'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'], // 👈 إضافة التحقق
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => ['description' => 'اسم المكتب.', 'example' => 'مكتب التميز للاستقدام'],
            'commercial_reg_no' => ['description' => 'رقم السجل التجاري (فريد).', 'example' => '1010123456'],
            'city_id' => ['description' => 'معرّف المدينة.', 'example' => 1],
            'address' => ['description' => 'العنوان.', 'example' => 'الرياض - حي العليا'],
            'phone' => ['description' => 'رقم الجوال.', 'example' => '+966500000000'],
            'email' => ['description' => 'البريد الإلكتروني.', 'example' => 'office@example.com'],
            'password' => ['description' => 'كلمة المرور.', 'example' => 'secret123'],
            'password_confirmation' => ['description' => 'تأكيد كلمة المرور.', 'example' => 'secret123'],
            'image' => ['description' => 'صورة المكتب (اختيارية).', 'example' => 'office.jpg'],
        ];
    }
}
