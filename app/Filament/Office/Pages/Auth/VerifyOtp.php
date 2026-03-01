<?php

namespace App\Filament\Office\Pages\Auth;

use App\Models\Office;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfficeResetCodeMail;

class VerifyOtp extends Page implements HasForms
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'verify-otp';

    protected string $view = 'filament.office.pages.auth.verify-otp';

    public ?array $data = [];

    public function mount(): void
    {
        if (!session()->has('office_registration_id')) {
            $this->redirect(Register::getUrl());
            return;
        }

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('otp')
                    ->label('رمز التحقق')
                    ->required()
                    ->numeric()
                    ->length(6)
                    ->autofocus(),
            ])
            ->statePath('data');
    }

    public function verify(): void
    {
        $data = $this->form->getState();
        $otp = (string) $data['otp'];
        $officeId = session()->get('office_registration_id');

        if (!$officeId) {
            Notification::make()
                ->title('جلسة غير صالحة')
                ->danger()
                ->send();
            $this->redirect(Register::getUrl());
            return;
        }

        $office = Office::on('system')->find($officeId);
        if (!$office) {
            Notification::make()
                ->title('المكتب غير موجود')
                ->danger()
                ->send();
            $this->redirect(Register::getUrl());
            return;
        }

        $row = DB::connection('system')->table('password_reset_tokens')->where('email', $office->email)->first();

        if (!$row || empty($row->code_hash)) {
            $this->sendOtp($office);
            Notification::make()
                ->title('تم إرسال رمز جديد')
                ->success()
                ->send();
            return;
        }

        if (!empty($row->expires_at) && now()->greaterThan($row->expires_at)) {
            $this->sendOtp($office);
            Notification::make()
                ->title('انتهت صلاحية الرمز، تم إرسال رمز جديد')
                ->warning()
                ->send();
            return;
        }

        $attempts = (int) ($row->attempts ?? 0);
        if ($attempts >= 5) {
            Notification::make()
                ->title('عدد المحاولات كبير. فضلاً اطلب رمزاً جديداً')
                ->danger()
                ->send();
            $this->sendOtp($office);
            return;
        }

        if (!Hash::check($otp, $row->code_hash)) {
            DB::connection('system')->table('password_reset_tokens')
                ->where('email', $office->email)
                ->update(['attempts' => $attempts + 1]);

            Notification::make()
                ->title('رمز التحقق غير صحيح')
                ->danger()
                ->send();
            return;
        }

        DB::connection('system')->table('password_reset_tokens')->where('email', $office->email)->delete();

        session()->forget('office_registration_id');

        auth()->guard('office-panel')->login($office, false);
        session()->regenerate();

        Notification::make()
            ->title('تم التحقق بنجاح')
            ->success()
            ->send();

        $this->redirect(\App\Filament\Office\Pages\Subscriptions::getUrl());
    }

    protected function sendOtp(Office $office): void
    {
        $code = (string) random_int(100000, 999999);
        $hash = Hash::make($code);
        $expiresAt = now()->addMinutes(15);

        DB::connection('system')->table('password_reset_tokens')->updateOrInsert(
            ['email' => $office->email],
            [
                'token' => null,
                'code_hash' => $hash,
                'expires_at' => $expiresAt,
                'attempts' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        Mail::to($office->email)->send(new OfficeResetCodeMail($code));
    }

    public function resendOtp(): void
    {
        $officeId = session()->get('office_registration_id');
        if (!$officeId) {
            Notification::make()
                ->title('جلسة غير صالحة')
                ->danger()
                ->send();
            return;
        }

        $office = Office::on('system')->find($officeId);
        if (!$office) {
            Notification::make()
                ->title('المكتب غير موجود')
                ->danger()
                ->send();
            return;
        }

        $this->sendOtp($office);

        Notification::make()
            ->title('تم إرسال رمز جديد')
            ->success()
            ->send();
    }

    public function getTitle(): string
    {
        return 'التحقق من البريد الإلكتروني';
    }

    public function getHeading(): string
    {
        return 'التحقق من البريد الإلكتروني';
    }
}
