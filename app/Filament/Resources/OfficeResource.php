<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeResource\Pages;
use App\Models\Office;
use App\Models\City;
use App\Services\PermissionService;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class OfficeResource extends Resource
{
    protected static ?string $model = Office::class;

    protected static $navigationIcon = 'heroicon-o-building-office';

    public static function getNavigationGroup(): ?string
    {
        return 'النظام';
    }

    protected static ?string $navigationLabel = 'المكاتب';

    protected static ?string $modelLabel = 'مكتب';

    protected static ?string $pluralModelLabel = 'المكاتب';

    public static function form(Schema $schema): Schema
    {
        return $schema
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
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(191)
                    ->label('الهاتف'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: true)
                    ->label('البريد الإلكتروني'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->minLength(8)
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->label('كلمة المرور')
                    ->helperText('اتركه فارغاً إذا لم تريد تغييره'),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('offices')
                    ->label('الصورة'),
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->label('نشط'),
                Forms\Components\Toggle::make('blocked')
                    ->default(false)
                    ->label('محظور'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->on('system'))
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('الصورة')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('الاسم'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('البريد الإلكتروني'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('الهاتف'),
                Tables\Columns\TextColumn::make('commercial_reg_no')
                    ->searchable()
                    ->label('رقم السجل التجاري')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable()
                    ->label('نشط'),
                Tables\Columns\IconColumn::make('blocked')
                    ->boolean()
                    ->sortable()
                    ->label('محظور')
                    ->color(fn ($state) => $state ? 'danger' : 'success'),
                Tables\Columns\TextColumn::make('last_login_at')
                    ->dateTime()
                    ->sortable()
                    ->label('آخر تسجيل دخول')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TextInput::make('name')
                    ->label('الاسم'),
                Tables\Filters\TextInput::make('email')
                    ->label('البريد الإلكتروني'),
                Tables\Filters\TernaryFilter::make('active')
                    ->label('نشط'),
                Tables\Filters\TernaryFilter::make('blocked')
                    ->label('محظور'),
            ])
            ->actions([
                Tables\Actions\Action::make('block')
                    ->label('حظر/إلغاء حظر')
                    ->icon('heroicon-o-lock-closed')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Toggle::make('blocked')
                            ->label('محظور')
                            ->default(fn (Office $record) => $record->blocked),
                    ])
                    ->action(function (Office $record, array $data) {
                        $record->blocked = $data['blocked'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.offices.block')),
                Tables\Actions\Action::make('toggle')
                    ->label('تبديل الحالة')
                    ->icon('heroicon-o-power')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Toggle::make('active')
                            ->label('نشط')
                            ->default(fn (Office $record) => $record->active),
                    ])
                    ->action(function (Office $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.offices.toggle')),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.offices.update')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.offices.destroy')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.offices.destroy')),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffices::route('/'),
            'create' => Pages\CreateOffice::route('/create'),
            'edit' => Pages\EditOffice::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.offices.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.offices.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.offices.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.offices.destroy');
    }
}
