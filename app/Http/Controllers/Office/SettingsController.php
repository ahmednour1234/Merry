<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function edit()
    {
        $office = Auth::guard('office-panel')->user();
        return view('office.settings', compact('office'));
    }

    public function update(Request $request)
    {
        $office = Auth::guard('office-panel')->user();

        $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'address'      => 'nullable|string|max:500',
            'email'        => ['required','email','max:255',
                               Rule::unique('system.offices','email')->ignore($office->id)],
            'current_password' => 'nullable|string',
            'password'     => 'nullable|string|min:8|confirmed',
        ]);

        // If changing password, verify current password first
        if ($request->filled('password')) {
            if (!$request->filled('current_password') || !Hash::check($request->current_password, $office->password)) {
                return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة.'])->withInput();
            }
        }

        $data = $request->only(['name','phone','address','email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $office->update($data);

        return back()->with('success', 'تم حفظ الإعدادات بنجاح.');
    }
}
