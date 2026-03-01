<?php

namespace App\Filament\Office\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfficeResetCodeMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgotPassword extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.office.pages.auth.forgot-password';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required()
                    ->exists('system.offices', 'email'),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $email = $data['email'];

        $exists = \App\Models\Office::on('system')->where('email', $email)->exists();
        if (!$exists) {
            \Filament\Notifications\Notification::make()
                ->title('تم إرسال رمز الاستعادة')
                ->success()
                ->send();
            return;
        }

        $code = (string) random_int(100000, 999999);
        $hash = Hash::make($code);
        $expiresAt = now()->addMinutes(15);

        DB::connection('system')->table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => null,
                'code_hash' => $hash,
                'expires_at' => $expiresAt,
                'attempts' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        Mail::to($email)->send(new OfficeResetCodeMail($code));

        \Filament\Notifications\Notification::make()
            ->title('تم إرسال رمز الاستعادة إلى بريدك الإلكتروني')
            ->success()
            ->send();

        $this->redirect(\App\Filament\Office\Pages\Auth\ResetPassword::getUrl(['email' => $email]));
    }
}
