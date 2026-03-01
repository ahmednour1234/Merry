<?php

namespace App\Filament\Office\Pages\Auth;

use App\Models\City;
use App\Models\Office;
use App\Events\OfficeRegistered;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Support\Uploads\ImageUploader;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Register extends Page implements HasForms
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'register';

    protected string $view = 'filament.office.pages.auth.register';

    public ?array $data = [];

    public function mount(): void
    {
        if (Auth::guard('office-panel')->check()) {
            redirect()->intended(\Filament\Facades\Filament::getPanel('office')->getUrl());
        }

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('اسم المكتب')
                    ->required()
                    ->maxLength(191),
                TextInput::make('commercial_reg_no')
                    ->label('رقم السجل التجاري')
                    ->required()
                    ->maxLength(191)
                    ->unique(Office::class, 'commercial_reg_no', ignoreRecord: true),
                Select::make('city_id')
                    ->label('المدينة')
                    ->options(fn () => City::on('system')->with('translations')->active()->get()->mapWithKeys(function ($city) {
                        $name = $city->translations->where('lang_code', 'ar')->first()?->name ?? $city->translations->first()?->name ?? $city->slug;
                        return [$city->id => $name];
                    })->toArray())
                    ->searchable(),
                Textarea::make('address')
                    ->label('العنوان')
                    ->rows(3),
                TextInput::make('phone')
                    ->label('الهاتف')
                    ->tel()
                    ->prefix('+966')
                    ->placeholder('500000000')
                    ->maxLength(32),
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required()
                    ->maxLength(191)
                    ->unique(Office::class, 'email', ignoreRecord: true),
                TextInput::make('password')
                    ->label('كلمة المرور')
                    ->password()
                    ->required()
                    ->rules([Password::min(6)]),
                TextInput::make('password_confirmation')
                    ->label('تأكيد كلمة المرور')
                    ->password()
                    ->required()
                    ->same('password'),
                FileUpload::make('image')
                    ->label('صورة المكتب')
                    ->image()
                    ->directory('offices')
                    ->maxSize(2048),
            ])
            ->statePath('data');
    }

    public function register(): void
    {
        $data = $this->form->getState();

        if (isset($data['image']) && is_array($data['image'])) {
            $data['image'] = $data['image'][0] ?? null;
        }

        if (isset($data['image']) && $data['image']) {
            $data['image'] = ImageUploader::upload($data['image'], 'offices');
        }

        if (isset($data['phone']) && !empty($data['phone']) && !str_starts_with($data['phone'], '+966')) {
            $data['phone'] = '+966' . ltrim($data['phone'], '0');
        }

        $data['password'] = Hash::make($data['password']);
        $data['active'] = false;
        $data['blocked'] = false;

        $office = Office::on('system')->create($data);

        event(new OfficeRegistered($office->id));

        session()->put('office_registration_id', $office->id);

        $this->sendOtp($office);

        Notification::make()
            ->title('تم إرسال رمز التحقق إلى بريدك الإلكتروني')
            ->success()
            ->send();

        $this->redirect(VerifyOtp::getUrl());
    }

    protected function sendOtp(Office $office): void
    {
        $code = (string) random_int(100000, 999999);
        $hash = Hash::make($code);
        $expiresAt = now()->addMinutes(15);

        \Illuminate\Support\Facades\DB::connection('system')->table('password_reset_tokens')->updateOrInsert(
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

        \Illuminate\Support\Facades\Mail::to($office->email)->send(new \App\Mail\OfficeResetCodeMail($code));
    }

    public function getTitle(): string
    {
        return 'إنشاء حساب جديد';
    }

    public function getHeading(): string
    {
        return 'إنشاء حساب جديد';
    }
}
