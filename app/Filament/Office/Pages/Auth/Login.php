<?php

namespace App\Filament\Office\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    protected function getEmailFormComponent(): TextInput
    {
        return TextInput::make('email')
            ->label('البريد الإلكتروني')
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getPasswordFormComponent(): TextInput
    {
        return TextInput::make('password')
            ->label('كلمة المرور')
            ->password()
            ->required()
            ->autocomplete('current-password')
            ->extraInputAttributes(['tabindex' => 2]);
    }
}
