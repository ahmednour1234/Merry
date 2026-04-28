<?php

namespace App\Http\Controllers\Office\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OfficeResetCodeMail;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function showForgetPassword()
    {
        if (auth()->guard('office-panel')->check()) {
            return redirect()->route('office.dashboard');
        }
        return view('office.auth.forget-password');
    }

    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email'    => 'البريد الإلكتروني غير صحيح',
        ]);

        $office = Office::on('system')->where('email', $request->email)->first();

        // Always show success to avoid email enumeration
        if (!$office) {
            return back()->with('success', 'إن وُجد البريد لدينا فسيتم إرسال رمز الاستعادة');
        }

        $isDevEnv  = app()->environment(['local', 'development', 'dev', 'staging', 'testing']);
        $code      = $isDevEnv ? '111111' : (string) random_int(100000, 999999);
        $hash      = Hash::make($code);
        $expiresAt = now()->addMinutes(15);

        DB::connection('system')->table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token'      => null,
                'code_hash'  => $hash,
                'expires_at' => $expiresAt,
                'attempts'   => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        if (!$isDevEnv) {
            Mail::to($request->email)->send(new OfficeResetCodeMail($code));
        }

        session()->put('reset_password_email', $request->email);

        return redirect()->route('office.password.reset')->with('success', 'تم إرسال رمز الاستعادة إلى بريدك الإلكتروني');
    }

    public function showResetPassword()
    {
        if (auth()->guard('office-panel')->check()) {
            return redirect()->route('office.dashboard');
        }
        return view('office.auth.reset-password', [
            'email' => session()->get('reset_password_email', ''),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'code'                  => 'required|string|size:6',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [
            'email.required'                 => 'البريد الإلكتروني مطلوب',
            'code.required'                  => 'رمز التحقق مطلوب',
            'code.size'                      => 'رمز التحقق يجب أن يكون 6 أرقام',
            'password.required'              => 'كلمة المرور مطلوبة',
            'password.min'                   => 'كلمة المرور يجب أن تكون على الأقل 6 أحرف',
            'password.confirmed'             => 'تأكيد كلمة المرور غير متطابق',
            'password_confirmation.required' => 'تأكيد كلمة المرور مطلوب',
        ]);

        $office = Office::on('system')->where('email', $request->email)->first();
        if (!$office) {
            return back()->withErrors(['email' => 'البريد الإلكتروني غير موجود']);
        }

        $row = DB::connection('system')->table('password_reset_tokens')->where('email', $request->email)->first();
        if (!$row || empty($row->code_hash)) {
            return back()->withErrors(['code' => 'الرمز غير صالح أو منتهٍ']);
        }

        if (!empty($row->expires_at) && now()->greaterThan($row->expires_at)) {
            DB::connection('system')->table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['code' => 'انتهت صلاحية الرمز']);
        }

        $attempts = (int) ($row->attempts ?? 0);
        if ($attempts >= 5) {
            return back()->withErrors(['code' => 'عدد المحاولات كبير. فضلاً اطلب رمزاً جديداً']);
        }

        $isDevEnv  = app()->environment(['local', 'development', 'dev', 'staging', 'testing']);
        $useBypass = $isDevEnv && $request->code === '111111';

        if (!$useBypass && !Hash::check($request->code, $row->code_hash)) {
            DB::connection('system')->table('password_reset_tokens')
                ->where('email', $request->email)
                ->update(['attempts' => $attempts + 1]);
            return back()->withErrors(['code' => 'رمز التحقق غير صحيح']);
        }

        $office->password = Hash::make($request->password);
        $office->save();

        DB::connection('system')->table('password_reset_tokens')->where('email', $request->email)->delete();
        session()->forget('reset_password_email');

        return redirect()->route('office.login')->with('success', 'تم تغيير كلمة المرور بنجاح. يمكنك تسجيل الدخول الآن.');
    }
}
