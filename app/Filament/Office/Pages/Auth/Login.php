<?php

namespace App\Filament\Office\Pages\Auth;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Page implements HasForms
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'login';

    protected static string $layout = 'filament-panels::components.layout.simple';

    public ?array $data = [];

    public function mount(): void
    {
        if (Auth::guard('office-panel')->check()) {
            redirect()->intended(\Filament\Facades\Filament::getPanel('office')->getUrl());
        }

        $this->form->fill();
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required()
                    ->autocomplete()
                    ->autofocus()
                    ->extraInputAttributes(['tabindex' => 1]),
                TextInput::make('password')
                    ->label('كلمة المرور')
                    ->password()
                    ->required()
                    ->autocomplete('current-password')
                    ->extraInputAttributes(['tabindex' => 2]),
                Checkbox::make('remember')
                    ->label('تذكرني'),
            ])
            ->statePath('data');
    }

    public function authenticate(): void
    {
        $data = $this->form->getState();

        if (!Auth::guard('office-panel')->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $data['remember'] ?? false)) {
            throw ValidationException::withMessages([
                'data.email' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        }

        session()->regenerate();

        redirect()->intended(\Filament\Facades\Filament::getPanel('office')->getUrl());
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('authenticate')
                ->label('تسجيل الدخول')
                ->submit('authenticate'),
        ];
    }

    public function getCachedFormActions(): array
    {
        return $this->getFormActions();
    }

    public function hasFullWidthFormActions(): bool
    {
        return true;
    }
}
