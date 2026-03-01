<?php

namespace App\Filament\Office\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Schemas\Schema;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;

class Login extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.office.pages.auth.login';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        if (Auth::guard('office-panel')->check()) {
            redirect()->intended($this->getRedirectUrl());
        }

        $this->form->fill();
    }

    public function form(Schema $form): Form
    {
        return $form
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
                    ->label('تذكرني')
                    ->default(false),
            ])
            ->statePath('data');
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

    public function getTitle(): string | Htmlable
    {
        return 'تسجيل الدخول';
    }

    public function getHeading(): string | Htmlable
    {
        return 'تسجيل الدخول';
    }

    protected function getRedirectUrl(): string
    {
        return Filament::getPanel('office')->getUrl();
    }
}
