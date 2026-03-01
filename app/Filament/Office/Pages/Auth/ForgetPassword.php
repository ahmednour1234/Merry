<?php

namespace App\Filament\Office\Pages\Auth;

use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Office;
use App\Mail\OfficeResetCodeMail;

class ForgetPassword extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'forget-password';

    protected string $view = 'filament.office.pages.auth.forget-password';

    protected static string $layout = 'filament-panels::components.layout.base';

    public $email = '';

    public function mount(): void
    {
        if (auth()->guard('office-panel')->check()) {
            redirect()->intended(\Filament\Facades\Filament::getPanel('office')->getUrl());
        }
    }

    public function sendCode(): void
    {
        $this->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
        ]);

        $office = Office::on('system')->where('email', $this->email)->first();

        if (!$office) {
            Notification::make()
                ->title('إن وُجد البريد لدينا فسيتم إرسال رمز الاستعادة')
                ->success()
                ->send();
            return;
        }

        $isDevEnv = app()->environment(['local', 'development', 'dev', 'staging', 'testing']);
        $code = $isDevEnv ? '111111' : (string) random_int(100000, 999999);
        $hash = Hash::make($code);
        $expiresAt = now()->addMinutes(15);

        DB::connection('system')->table('password_reset_tokens')->updateOrInsert(
            ['email' => $this->email],
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
            Mail::to($this->email)->send(new OfficeResetCodeMail($code));
        }

        session()->put('reset_password_email', $this->email);

        Notification::make()
            ->title('تم إرسال رمز الاستعادة إلى بريدك الإلكتروني')
            ->success()
            ->send();

        $this->redirect(ResetPassword::getUrl());
    }

    public static function getUrl(array $parameters = [], bool $isAbsolute = true, ?string $panel = null, ?\Illuminate\Database\Eloquent\Model $tenant = null): string
    {
        return parent::getUrl($parameters, $isAbsolute, $panel, $tenant);
    }
}
