<?php

namespace App\Filament\Office\Pages;

use App\Models\City;
use BackedEnum;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('البيانات الأساسية')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(191)
                            ->label('الاسم'),
                        Forms\Components\TextInput::make('commercial_reg_no')
                            ->maxLength(191)
                            ->label('رقم السجل التجاري'),
                        Forms\Components\Select::make('city_id')
                            ->options(fn () => City::on('system')->with('translations')->get()->mapWithKeys(function ($city) {
                                $name = $city->translations->where('lang_code', 'ar')->first()?->name ?? $city->translations->first()?->name ?? $city->slug;
                                return [$city->id => $name];
                            })->toArray())
                            ->searchable()
                            ->label('المدينة'),
                        Forms\Components\Textarea::make('address')
                            ->rows(3)
                            ->label('العنوان'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('معلومات الاتصال')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(191)
                            ->label('الهاتف'),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(191)
                            ->unique(ignoreRecord: fn () => Auth::guard('office-panel')->user())
                            ->label('البريد الإلكتروني'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('الصورة')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('offices')
                            ->label('الصورة')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                                '1:1',
                            ]),
                    ]),
                Forms\Components\Section::make('كلمة المرور')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->minLength(8)
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                            ->label('كلمة المرور الجديدة')
                            ->helperText('اتركه فارغاً إذا لم تريد تغييره'),
                    ]),
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
