<?php

namespace App\Http\Requests\Office;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfficeRequest extends FormRequest
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
            'password' => ['required','string','min:6'],
            'active' => ['nullable','boolean'],
            'blocked' => ['nullable','boolean'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'], // 👈 إضافة الصورة
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name'=>['description'=>'اسم المكتب','example'=>'مكتب التميّز'],
            'commercial_reg_no'=>['description'=>'رقم السجل التجاري','example'=>'1010123456'],
            'city_id'=>['description'=>'معرّف المدينة (cities.id)','example'=>1],
            'address'=>['description'=>'العنوان التفصيلي','example'=>'الرياض - حي العليا'],
            'phone'=>['description'=>'رقم الجوال','example'=>'+966500000000'],
            'email'=>['description'=>'البريد الإلكتروني','example'=>'office@example.com'],
            'password'=>['description'=>'كلمة المرور','example'=>'secret123'],
            'active'=>['description'=>'نشط','example'=>true],
            'blocked'=>['description'=>'محظور','example'=>false],
            'image'=>['description'=>'صورة المكتب (اختيارية)','example'=>'resources/scribe/examples/office.jpg'],
        ];
    }
}
