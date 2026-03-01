<?php

namespace App\Filament\Office\Pages\Auth;

use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Office;

class ResetPassword extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'reset-password';

    protected string $view = 'filament.office.pages.auth.reset-password';

    protected static string $layout = 'filament-panels::components.layout.base';

    public $email = '';
    public $code = '';
    public $password = '';
    public $password_confirmation = '';
    public $showPassword = false;

    public function mount(): void
    {
        if (auth()->guard('office-panel')->check()) {
            redirect()->intended(\Filament\Facades\Filament::getPanel('office')->getUrl());
        }

        $this->email = session()->get('reset_password_email', '');
    }

    public function togglePassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function reset(): void
    {
        $this->validate([
            'email' => 'required|email',
            'code' => 'required|string|size:6',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'code.required' => 'رمز التحقق مطلوب',
            'code.size' => 'رمز التحقق يجب أن يكون 6 أرقام',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 6 أحرف',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
        ]);

        $office = Office::on('system')->where('email', $this->email)->first();

        if (!$office) {
            Notification::make()
                ->title('المكتب غير موجود')
                ->danger()
                ->send();
            return;
        }

        $row = DB::connection('system')->table('password_reset_tokens')->where('email', $this->email)->first();

        if (!$row || empty($row->code_hash)) {
            Notification::make()
                ->title('الرمز غير صالح أو منتهٍ')
                ->danger()
                ->send();
            return;
        }

        if (!empty($row->expires_at) && now()->greaterThan($row->expires_at)) {
            DB::connection('system')->table('password_reset_tokens')->where('email', $this->email)->delete();
            Notification::make()
                ->title('انتهت صلاحية الرمز')
                ->danger()
                ->send();
            return;
        }

        $attempts = (int) ($row->attempts ?? 0);
        if ($attempts >= 5) {
            Notification::make()
                ->title('عدد المحاولات كبير. فضلاً اطلب رمزاً جديداً')
                ->danger()
                ->send();
            return;
        }

        if (!Hash::check($this->code, $row->code_hash)) {
            DB::connection('system')->table('password_reset_tokens')
                ->where('email', $this->email)
                ->update(['attempts' => $attempts + 1]);

            Notification::make()
                ->title('رمز التحقق غير صحيح')
                ->danger()
                ->send();
            return;
        }

        $office->password = Hash::make($this->password);
        $office->save();

        DB::connection('system')->table('password_reset_tokens')->where('email', $this->email)->delete();

        session()->forget('reset_password_email');

        Notification::make()
            ->title('تم تغيير كلمة المرور بنجاح')
            ->success()
            ->send();

        $this->redirect(Login::getUrl());
    }

    public static function getUrl(): string
    {
        return '/office/reset-password';
    }
}
