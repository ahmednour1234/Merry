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

        if (!Auth::guard('office-panel')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => 'بيانات الدخول غير صحيحة',
            ]);
        }

        session()->regenerate();

        redirect()->intended(\Filament\Facades\Filament::getPanel('office')->getUrl());
    }

}
