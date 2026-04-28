<?php

namespace App\Http\Controllers\Office\Auth;

use App\Events\OfficeRegistered;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegister()
    {
        if (Auth::guard('office-panel')->check()) {
            return redirect()->route('office.dashboard');
        }

        $cities = City::on('system')->with('translations')->where('active', true)->get()->map(function ($city) {
            $name = $city->translations->where('lang_code', 'ar')->first()?->name
                ?? $city->translations->first()?->name
                ?? $city->slug;
            return ['id' => $city->id, 'name' => $name];
        });

        return view('office.auth.register', compact('cities'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:191',
            'commercial_reg_no' => 'required|string|max:191|unique:system.offices,commercial_reg_no',
            'city_id'           => 'nullable|integer',
            'address'           => 'nullable|string|max:255',
            'phone'             => 'nullable|string|max:32',
            'email'             => 'required|email|max:191|unique:system.offices,email',
            'password'          => ['required', 'string', Password::min(6), 'confirmed'],
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required'              => 'اسم المكتب مطلوب',
            'commercial_reg_no.required' => 'رقم السجل التجاري مطلوب',
            'commercial_reg_no.unique'   => 'رقم السجل التجاري مستخدم بالفعل',
            'email.required'             => 'البريد الإلكتروني مطلوب',
            'email.email'                => 'البريد الإلكتروني غير صحيح',
            'email.unique'               => 'البريد الإلكتروني مستخدم بالفعل',
            'password.required'          => 'كلمة المرور مطلوبة',
            'password.confirmed'         => 'تأكيد كلمة المرور غير متطابق',
        ]);

        $phone = $request->phone;
        if ($phone && !str_starts_with($phone, '+966')) {
            $phone = '+966' . ltrim($phone, '0');
        }

        $imagePath = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('offices', 'public');
        }

        $office = Office::on('system')->create([
            'name'              => $request->name,
            'commercial_reg_no' => $request->commercial_reg_no,
            'city_id'           => $request->city_id,
            'address'           => $request->address,
            'phone'             => $phone,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'active'            => false,
            'blocked'           => false,
            'image'             => $imagePath,
        ]);

        event(new OfficeRegistered($office->id));

        return redirect()->route('office.login')
            ->with('success', 'تم إنشاء الحساب بنجاح. حسابك قيد المراجعة وسيتم تفعيله من الإدارة أولاً.');
    }
}
