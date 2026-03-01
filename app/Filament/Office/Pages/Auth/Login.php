<?php

namespace App\Filament\Office\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;

class Login extends BaseLogin
{

    public ?array $data = [];

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->autocomplete()
                            ->autofocus(),
                        TextInput::make('password')
                            ->label('كلمة المرور')
                            ->password()
                            ->required(),
                        Checkbox::make('remember')
                            ->label('تذكرني'),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    public function authenticate(): void
    {
        $data = $this->form->getState();

        $office = \App\Models\Office::on('system')->where('email', $data['email'])->first();

        if (!$office || !Hash::check($data['password'], $office->password)) {
            Notification::make()
                ->title('بيانات الدخول غير صحيحة')
                ->danger()
                ->send();
            return;
        }

        if (!$office->active || $office->blocked) {
            Notification::make()
                ->title('حسابك قيد المراجعة')
                ->danger()
                ->send();
            return;
        }

        $office->last_login_at = now();
        $office->save();

        Auth::guard('office-panel')->login($office, $data['remember'] ?? false);

        session()->regenerate();

        $this->redirect($this->getRedirectUrl());
    }

    protected function getRedirectUrl(): string
    {
        $office = Auth::guard('office-panel')->user();
        
        $hasActiveSubscription = \App\Models\OfficeSubscription::on('system')
            ->where('office_id', $office->id)
            ->where('active', true)
            ->where('ends_at', '>=', now())
            ->exists();
        
        if ($hasActiveSubscription) {
            return Filament::getPanel('office')->getUrl();
        }
        
        return \App\Filament\Office\Pages\Subscriptions::getUrl();
    }
}
