<?php

namespace App\Filament\Office\Pages\Auth;

use App\Models\City;
use App\Models\Office;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Register extends Page implements HasForms
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'register';

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
                    ->searchable()
                    ->nullable(),
                Textarea::make('address')
                    ->label('العنوان')
                    ->rows(3)
                    ->maxLength(255)
                    ->nullable(),
                TextInput::make('phone')
                    ->label('رقم الجوال')
                    ->tel()
                    ->maxLength(32)
                    ->nullable(),
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
                    ->same('password_confirmation')
                    ->dehydrated(fn ($state) => filled($state)),
                TextInput::make('password_confirmation')
                    ->label('تأكيد كلمة المرور')
                    ->password()
                    ->required()
                    ->dehydrated(false),
                FileUpload::make('image')
                    ->label('صورة المكتب')
                    ->image()
                    ->directory('offices')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                    ->nullable(),
            ])
            ->statePath('data');
    }

    public function register(): void
    {
        $data = $this->form->getState();

        if (isset($data['image'])) {
            if (is_array($data['image']) && !empty($data['image'])) {
                $data['image'] = $data['image'][0] ?? null;
            }
            if (empty($data['image'])) {
                $data['image'] = null;
            }
        } else {
            $data['image'] = null;
        }

        if (isset($data['phone']) && !empty($data['phone']) && !str_starts_with($data['phone'], '+966')) {
            $data['phone'] = '+966' . ltrim($data['phone'], '0');
        }

        $data['password'] = Hash::make($data['password']);
        $data['active'] = false;
        $data['blocked'] = false;

        unset($data['password_confirmation']);

        $office = Office::on('system')->create($data);

        Auth::guard('office-panel')->login($office);

        session()->regenerate();

        redirect()->intended(\Filament\Facades\Filament::getPanel('office')->getUrl());
    }

    public function getFormValidationAttributes(): array
    {
        return [
            'name' => 'اسم المكتب',
            'commercial_reg_no' => 'رقم السجل التجاري',
            'city_id' => 'المدينة',
            'address' => 'العنوان',
            'phone' => 'رقم الجوال',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'password_confirmation' => 'تأكيد كلمة المرور',
            'image' => 'صورة المكتب',
        ];
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('register')
                ->label('إنشاء حساب')
                ->submit('register'),
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
