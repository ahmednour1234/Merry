<?php

namespace App\Filament\Office\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ResetPassword extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.office.pages.auth.reset-password';

    protected static bool $shouldRegisterNavigation = false;

    public ?string $email = null;
    public ?array $data = [];

    public function mount(?string $email = null): void
    {
        $this->email = $email ?? request()->query('email');
        $this->form->fill(['email' => $this->email]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required()
                    ->default($this->email)
                    ->disabled(fn () => filled($this->email)),
                TextInput::make('code')
                    ->label('رمز الاستعادة (6 أرقام)')
                    ->required()
                    ->length(6)
                    ->numeric(),
                TextInput::make('password')
                    ->label('كلمة المرور الجديدة')
                    ->password()
                    ->required()
                    ->rules([Password::min(6)])
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                TextInput::make('password_confirmation')
                    ->label('تأكيد كلمة المرور')
                    ->password()
                    ->required()
                    ->same('password'),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $email = $data['email'];
        $code = $data['code'];
        $password = $data['password'];

        $office = \App\Models\Office::on('system')->where('email', $email)->first();
        if (!$office) {
            $this->form->get('email')->addError('المكتب غير موجود');
            return;
        }

        $devBypassCode = (string) config('auth.reset_dev_code', '123456');
        $isDevEnv = app()->environment(['local', 'development', 'dev', 'staging', 'testing']);
        $useBypass = $isDevEnv && $code === $devBypassCode;

        if (!$useBypass) {
            $row = DB::connection('system')->table('password_reset_tokens')->where('email', $email)->first();

            if (!$row || empty($row->code_hash)) {
                $this->form->get('code')->addError('الرمز غير صالح أو منتهٍ');
                return;
            }

            if (!empty($row->expires_at) && now()->greaterThan($row->expires_at)) {
                DB::connection('system')->table('password_reset_tokens')->where('email', $email)->delete();
                $this->form->get('code')->addError('انتهت صلاحية الرمز');
                return;
            }

            $attempts = (int) ($row->attempts ?? 0);
            if ($attempts >= 5) {
                $this->form->get('code')->addError('عدد المحاولات كبير. فضلاً اطلب رمزاً جديداً');
                return;
            }

            if (!Hash::check($code, $row->code_hash)) {
                DB::connection('system')->table('password_reset_tokens')
                    ->where('email', $email)
                    ->update(['attempts' => $attempts + 1, 'updated_at' => now()]);
                $this->form->get('code')->addError('الرمز غير صحيح');
                return;
            }
        }

        $office->password = Hash::make($password);
        $office->save();

        DB::connection('system')->table('password_reset_tokens')->where('email', $email)->delete();

        \Filament\Notifications\Notification::make()
            ->title('تم تحديث كلمة المرور بنجاح')
            ->success()
            ->send();

        $this->redirect(Login::getUrl());
    }
}
