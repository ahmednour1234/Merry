<?php

namespace App\Filament\Office\Pages\Auth;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'login';

    protected string $view = 'filament.office.pages.auth.login';

    protected static string $layout = 'filament-panels::components.layout.base';

    public $email = '';
    public $password = '';
    public $remember = false;
    public $showPassword = false;

    public function togglePassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function mount(): void
    {
        if (Auth::guard('office-panel')->check()) {
            redirect()->intended(\Filament\Facades\Filament::getPanel('office')->getUrl());
        }
    }

    public function authenticate(): void
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
        ]);

        $office = \App\Models\Office::on('system')->where('email', $this->email)->first();

        if (!$office || !\Illuminate\Support\Facades\Hash::check($this->password, $office->password)) {
            throw ValidationException::withMessages([
                'email' => 'بيانات الدخول غير صحيحة',
            ]);
        }

        if ($office->blocked) {
            throw ValidationException::withMessages([
                'email' => 'تم حظر حسابك. يرجى التواصل مع الإدارة.',
            ]);
        }

        if (! $office->active) {
            throw ValidationException::withMessages([
                'email' => 'حسابك قيد المراجعة. سيتم تفعيله من الإدارة أولاً قبل تسجيل الدخول.',
            ]);
        }

        session()->put('login_office_id', $office->id);
        session()->regenerate();

        redirect()->to(LoginOtp::getUrl());
    }

    public static function getUrl(array $parameters = [], bool $isAbsolute = true, ?string $panel = null, ?\Illuminate\Database\Eloquent\Model $tenant = null): string
    {
        $officePanel = \Filament\Facades\Filament::getPanel($panel ?? 'office');

        return url(trim($officePanel->getPath(), '/') . '/login');
    }

}
