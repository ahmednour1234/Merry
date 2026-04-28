<?php

namespace App\Http\Controllers\Office\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OfficeResetCodeMail;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function showLoginOtp()
    {
        if (!session()->has('login_office_id')) {
            return redirect()->route('office.login');
        }

        $officeId = session()->get('login_office_id');
        $office   = Office::on('system')->find($officeId);

        if (!$office || $office->blocked || !$office->active) {
            session()->forget('login_office_id');
            return redirect()->route('office.login')->with('error', 'لا يمكن تسجيل الدخول قبل تفعيل الحساب');
        }

        // Send OTP automatically on first load
        $this->sendOtp($office);

        return view('office.auth.otp-login');
    }

    public function verifyLoginOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ], [
            'otp.required' => 'رمز التحقق مطلوب',
            'otp.size'     => 'رمز التحقق يجب أن يكون 6 أرقام',
        ]);

        $officeId = session()->get('login_office_id');
        if (!$officeId) {
            return redirect()->route('office.login')->with('error', 'جلسة غير صالحة');
        }

        $office = Office::on('system')->find($officeId);
        if (!$office) {
            return redirect()->route('office.login')->with('error', 'المكتب غير موجود');
        }

        if ($office->blocked || !$office->active) {
            session()->forget('login_office_id');
            return redirect()->route('office.login')->with('error', 'لا يمكن تسجيل الدخول قبل تفعيل الحساب');
        }

        $row = DB::connection('system')->table('password_reset_tokens')->where('email', $office->email)->first();

        if (!$row || empty($row->code_hash)) {
            $this->sendOtp($office);
            return back()->with('warning', 'تم إرسال رمز جديد');
        }

        if (!empty($row->expires_at) && now()->greaterThan($row->expires_at)) {
            $this->sendOtp($office);
            return back()->with('warning', 'انتهت صلاحية الرمز، تم إرسال رمز جديد');
        }

        $attempts = (int) ($row->attempts ?? 0);
        if ($attempts >= 5) {
            $this->sendOtp($office);
            return back()->with('error', 'عدد المحاولات كبير. تم إرسال رمز جديد');
        }

        $isDevEnv    = app()->environment(['local', 'development', 'dev', 'staging', 'testing']);
        $useBypass   = $isDevEnv && $request->otp === '111111';

        if (!$useBypass && !Hash::check($request->otp, $row->code_hash)) {
            DB::connection('system')->table('password_reset_tokens')
                ->where('email', $office->email)
                ->update(['attempts' => $attempts + 1]);
            return back()->withErrors(['otp' => 'رمز التحقق غير صحيح']);
        }

        DB::connection('system')->table('password_reset_tokens')->where('email', $office->email)->delete();
        session()->forget('login_office_id');

        Auth::guard('office-panel')->login($office, false);
        session()->regenerate();

        return redirect()->route('office.dashboard');
    }

    public function resendOtp()
    {
        $officeId = session()->get('login_office_id');
        if (!$officeId) {
            return redirect()->route('office.login')->with('error', 'جلسة غير صالحة');
        }

        $office = Office::on('system')->find($officeId);
        if (!$office) {
            return redirect()->route('office.login')->with('error', 'المكتب غير موجود');
        }

        $this->sendOtp($office);

        return back()->with('success', 'تم إرسال رمز جديد');
    }

    protected function sendOtp(Office $office): void
    {
        $isDevEnv = app()->environment(['local', 'development', 'dev', 'staging', 'testing']);
        $code     = $isDevEnv ? '111111' : (string) random_int(100000, 999999);
        $hash     = Hash::make($code);
        $expiresAt = now()->addMinutes(15);

        DB::connection('system')->table('password_reset_tokens')->updateOrInsert(
            ['email' => $office->email],
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
            Mail::to($office->email)->send(new OfficeResetCodeMail($code));
        }
    }
}
