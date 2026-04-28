<?php

namespace App\Http\Controllers\Office\Auth;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('office-panel')->check()) {
            return redirect()->route('office.dashboard');
        }
        return view('office.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'البريد الإلكتروني مطلوب',
            'email.email'       => 'البريد الإلكتروني غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
        ]);

        $office = Office::on('system')->where('email', $request->email)->first();

        if (!$office || !Hash::check($request->password, $office->password)) {
            return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة'])->withInput();
        }

        if ($office->blocked) {
            return back()->withErrors(['email' => 'تم حظر حسابك. يرجى التواصل مع الإدارة.'])->withInput();
        }

        if (!$office->active) {
            return back()->withErrors(['email' => 'حسابك قيد المراجعة. سيتم تفعيله من الإدارة أولاً قبل تسجيل الدخول.'])->withInput();
        }

        session()->put('login_office_id', $office->id);
        session()->regenerate();

        return redirect()->route('office.otp');
    }

    public function logout(Request $request)
    {
        Auth::guard('office-panel')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('office.login');
    }
}
