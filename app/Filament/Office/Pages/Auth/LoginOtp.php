<?php

namespace App\Filament\Office\Pages\Auth;

use App\Models\Office;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfficeResetCodeMail;

class LoginOtp extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'login-otp';

    protected string $view = 'filament.office.pages.auth.login-otp';

    protected static string $layout = 'filament-panels::components.layout.base';

    public $otp = '';

    public function mount(): void
    {
        if (!session()->has('login_office_id')) {
            $this->redirect(Login::getUrl());
            return;
        }

        $officeId = session()->get('login_office_id');
        $office = Office::on('system')->find($officeId);

        if (!$office) {
            $this->redirect(Login::getUrl());
            return;
        }

        if ($office->blocked || ! $office->active) {
            session()->forget('login_office_id');

            Notification::make()
                ->title('لا يمكن تسجيل الدخول قبل تفعيل الحساب')
                ->danger()
                ->send();

            $this->redirect(Login::getUrl());
            return;
        }

        $this->sendOtp($office);
    }

    public function verify(): void
    {
        $this->validate([
            'otp' => 'required|string|size:6',
        ], [
            'otp.required' => 'رمز التحقق مطلوب',
            'otp.size' => 'رمز التحقق يجب أن يكون 6 أرقام',
        ]);

        $officeId = session()->get('login_office_id');
        if (!$officeId) {
            Notification::make()
                ->title('جلسة غير صالحة')
                ->danger()
                ->send();
            $this->redirect(Login::getUrl());
            return;
        }

        $office = Office::on('system')->find($officeId);
        if (!$office) {
            Notification::make()
                ->title('المكتب غير موجود')
                ->danger()
                ->send();
            $this->redirect(Login::getUrl());
            return;
        }

        if ($office->blocked || ! $office->active) {
            session()->forget('login_office_id');

            Notification::make()
                ->title('لا يمكن تسجيل الدخول قبل تفعيل الحساب')
                ->danger()
                ->send();

            $this->redirect(Login::getUrl());
            return;
        }

        $row = DB::connection('system')->table('password_reset_tokens')->where('email', $office->email)->first();

        if (!$row || empty($row->code_hash)) {
            $this->sendOtp($office);
            Notification::make()
                ->title('تم إرسال رمز جديد')
                ->success()
                ->send();
            return;
        }

        if (!empty($row->expires_at) && now()->greaterThan($row->expires_at)) {
            $this->sendOtp($office);
            Notification::make()
                ->title('انتهت صلاحية الرمز، تم إرسال رمز جديد')
                ->warning()
                ->send();
            return;
        }

        $attempts = (int) ($row->attempts ?? 0);
        if ($attempts >= 5) {
            Notification::make()
                ->title('عدد المحاولات كبير. فضلاً اطلب رمزاً جديداً')
                ->danger()
                ->send();
            $this->sendOtp($office);
            return;
        }

        $isDevEnv = app()->environment(['local', 'development', 'dev', 'staging', 'testing']);
        $devBypassCode = '111111';
        $useBypass = $isDevEnv && $this->otp === $devBypassCode;

        if (!$useBypass && !Hash::check($this->otp, $row->code_hash)) {
            DB::connection('system')->table('password_reset_tokens')
                ->where('email', $office->email)
                ->update(['attempts' => $attempts + 1]);

            Notification::make()
                ->title('رمز التحقق غير صحيح')
                ->danger()
                ->send();
            return;
        }

        DB::connection('system')->table('password_reset_tokens')->where('email', $office->email)->delete();

        session()->forget('login_office_id');

        auth()->guard('office-panel')->login($office, false);
        session()->regenerate();

        Notification::make()
            ->title('تم التحقق بنجاح')
            ->success()
            ->send();

        $this->redirect(\Filament\Facades\Filament::getPanel('office')->getUrl());
    }

    public function resendOtp(): void
    {
        $officeId = session()->get('login_office_id');
        if (!$officeId) {
            Notification::make()
                ->title('جلسة غير صالحة')
                ->danger()
                ->send();
            return;
        }

        $office = Office::on('system')->find($officeId);
        if (!$office) {
            Notification::make()
                ->title('المكتب غير موجود')
                ->danger()
                ->send();
            return;
        }

        $this->sendOtp($office);

        Notification::make()
            ->title('تم إرسال رمز جديد')
            ->success()
            ->send();
    }

    protected function sendOtp(Office $office): void
    {
        $isDevEnv = app()->environment(['local', 'development', 'dev', 'staging', 'testing']);
        $code = $isDevEnv ? '111111' : (string) random_int(100000, 999999);
        $hash = Hash::make($code);
        $expiresAt = now()->addMinutes(15);

        DB::connection('system')->table('password_reset_tokens')->updateOrInsert(
            ['email' => $office->email],
            [
                'token' => null,
                'code_hash' => $hash,
                'expires_at' => $expiresAt,
                'attempts' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        if (!$isDevEnv) {
            Mail::to($office->email)->send(new OfficeResetCodeMail($code));
        }
    }

}
