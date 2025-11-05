<?php

namespace App\Http\Requests\Office;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfficeRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = (int) $this->route('id');
        return [
            'name' => ['sometimes','string','max:191'],
            'commercial_reg_no' => ["sometimes","string","max:191","unique:system.offices,commercial_reg_no,{$id}"],
            'city_id' => ['sometimes','nullable','integer'],
            'address' => ['sometimes','nullable','string','max:255'],
            'phone' => ['sometimes','nullable','string','max:32'],
            'email' => ["sometimes","email","max:191","unique:system.offices,email,{$id}"],
            'password' => ['sometimes','nullable','string','min:6'],
            'active' => ['sometimes','boolean'],
            'blocked' => ['sometimes','boolean'],
            'image' => ['sometimes','nullable','image','mimes:jpg,jpeg,png,webp','max:2048'], // 👈 إضافة الصورة
        ];
    }
}
