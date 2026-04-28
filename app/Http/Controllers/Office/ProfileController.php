<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $office = Auth::guard('office-panel')->user();

        $cities = City::on('system')
            ->with('translations')
            ->orderBy('id')
            ->get()
            ->map(fn($c) => [
                'id'   => $c->id,
                'name' => $c->translations->where('lang_code', 'ar')->first()?->name
                       ?? $c->translations->first()?->name
                       ?? $c->name
                       ?? $c->id,
            ]);

        return view('office.profile', compact('office', 'cities'));
    }

    public function update(Request $request)
    {
        $office = Auth::guard('office-panel')->user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'city_id'  => 'nullable|integer',
            'address'  => 'nullable|string|max:500',
            'email'    => ['required','email','max:255',
                           Rule::unique('system.offices','email')->ignore($office->id)],
            'password'         => 'nullable|string|min:8|confirmed',
            'image'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name','phone','city_id','address','email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('offices', 'public');
        }

        $office->update($data);

        return back()->with('success', 'تم تحديث البيانات بنجاح.');
    }
}
