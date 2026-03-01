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
use Filament\Schemas\Schema;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Filament\Notifications\Notification;
use App\Support\Uploads\ImageUploader;

class Register extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.office.pages.auth.register';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        if (Auth::guard('office-panel')->check()) {
            redirect()->intended(Filament::getPanel('office')->getUrl());
        }

        $this->form->fill();
    }

    public function form(Schema $form): Schema
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
                    ->rules([Password::min(6)])
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null),
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

        $data['password'] = Hash::make($data['password']);
        $data['active'] = false;
        $data['blocked'] = false;

        $office = Office::on('system')->create($data);

        event(new OfficeRegistered($office->id));

        Notification::make()
            ->title('تم استلام طلبك، حسابك قيد المراجعة')
            ->success()
            ->send();

        $this->redirect(Filament::getPanel('office')->getLoginUrl());
    }

    public function getTitle(): string | Htmlable
    {
        return 'إنشاء حساب جديد';
    }

    public function getHeading(): string | Htmlable
    {
        return 'إنشاء حساب جديد';
    }
}
