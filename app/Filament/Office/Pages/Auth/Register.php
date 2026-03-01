<?php

namespace App\Filament\Office\Pages\Auth;

use App\Http\Requests\Office\Auth\OfficeRegisterRequest;
use App\Models\City;
use App\Models\Office;
use App\Support\Uploads\ImageUploader;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Register extends BaseRegister
{
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
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
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
            ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['active'] = false;
        $data['blocked'] = false;

        if (isset($data['image']) && is_array($data['image'])) {
            $data['image'] = $data['image'][0] ?? null;
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getUrl();
    }
}
