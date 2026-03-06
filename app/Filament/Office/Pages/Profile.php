<?php

namespace App\Filament\Office\Pages;

use App\Models\City;
use BackedEnum;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Page implements HasForms
{
    use InteractsWithForms;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';

    protected string $view = 'filament.office.pages.profile';

    protected static ?string $navigationLabel = 'الملف الشخصي';

    protected static ?string $title = 'الملف الشخصي';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $office = Auth::guard('office-panel')->user();
        $this->form->fill([
            'name' => $office->name,
            'commercial_reg_no' => $office->commercial_reg_no,
            'city_id' => $office->city_id,
            'address' => $office->address,
            'phone' => $office->phone,
            'email' => $office->email,
            'image' => $office->image,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(191)
                    ->label('الاسم'),
                TextInput::make('commercial_reg_no')
                    ->maxLength(191)
                    ->label('رقم السجل التجاري'),
                Select::make('city_id')
                    ->options(fn () => City::on('system')->with('translations')->get()->mapWithKeys(function ($city) {
                        $name = $city->translations->where('lang_code', 'ar')->first()?->name ?? $city->translations->first()?->name ?? $city->slug;
                        return [$city->id => $name];
                    })->toArray())
                    ->searchable()
                    ->label('المدينة'),
                Textarea::make('address')
                    ->rows(3)
                    ->label('العنوان')
                    ->columnSpanFull(),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(191)
                    ->label('الهاتف'),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: fn () => Auth::guard('office-panel')->user())
                    ->label('البريد الإلكتروني'),
                FileUpload::make('image')
                    ->image()
                    ->directory('offices')
                    ->label('الصورة')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        null,
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->columnSpanFull(),
                TextInput::make('password')
                    ->password()
                    ->minLength(8)
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->label('كلمة المرور الجديدة')
                    ->helperText('اتركه فارغاً إذا لم تريد تغييره')
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $office = Auth::guard('office-panel')->user();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $office->update($data);

        \Filament\Notifications\Notification::make()
            ->title('تم تحديث الملف الشخصي بنجاح')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('حفظ')
                ->submit('save'),
        ];
    }
}
