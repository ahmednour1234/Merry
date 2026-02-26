<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NationalityResource\Pages;
use App\Models\Nationality;
use App\Models\NationalityTranslation;
use App\Models\SystemLanguage;
use App\Services\PermissionService;
use BackedEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NationalityResource extends Resource
{
    protected static ?string $model = Nationality::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-globe-alt';

    public static function getNavigationGroup(): ?string
    {
        return 'المحتوى';
    }

    protected static ?string $navigationLabel = 'الجنسيات';

    protected static ?string $modelLabel = 'جنسية';

    protected static ?string $pluralModelLabel = 'الجنسيات';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(3)
                    ->uppercase()
                    ->unique(ignoreRecord: true)
                    ->label('رمز الجنسية')
                    ->helperText('مثل: SA, US, EG'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191)
                    ->label('الاسم الافتراضي'),
                Forms\Components\Repeater::make('translations')
                    ->relationship('translations')
                    ->schema([
                        Forms\Components\Select::make('lang_code')
                            ->options(fn () => SystemLanguage::on('system')->pluck('name', 'code')->toArray())
                            ->required()
                            ->label('اللغة'),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(191)
                            ->label('الاسم'),
                    ])
                    ->defaultItems(1)
                    ->collapsible()
                    ->label('الترجمات'),
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->label('نشط'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->on('system')->with('translations'))
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->label('الرمز')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('الاسم الافتراضي'),
                Tables\Columns\TextColumn::make('translations.name')
                    ->label('الاسم المترجم')
                    ->formatStateUsing(fn ($record) => $record->translations->where('lang_code', 'ar')->first()?->name ?? $record->translations->first()?->name ?? '-'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable()
                    ->label('نشط'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('code')
                    ->form([
                        Forms\Components\TextInput::make('code')
                            ->label('الرمز'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['code'] ?? null,
                            fn ($query, $code) => $query->where('code', 'like', "%{$code}%")
                        );
                    }),
                Tables\Filters\Filter::make('name')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('الاسم'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['name'] ?? null,
                            fn ($query, $name) => $query->where('name', 'like', "%{$name}%")
                        );
                    }),
                Tables\Filters\TernaryFilter::make('active')
                    ->label('نشط'),
            ])
            ->actions([
                Tables\Actions\Action::make('toggle')
                    ->label('تبديل الحالة')
                    ->icon('heroicon-o-power')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Toggle::make('active')
                            ->label('نشط')
                            ->default(fn (Nationality $record) => $record->active),
                    ])
                    ->action(function (Nationality $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.nationalities.toggle')),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.nationalities.update')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.nationalities.destroy')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.nationalities.destroy')),
                ]),
            ])
            ->defaultSort('code');
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
            'index' => Pages\ListNationalities::route('/'),
            'create' => Pages\CreateNationality::route('/create'),
            'edit' => Pages\EditNationality::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.nationalities.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.nationalities.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.nationalities.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.nationalities.destroy');
    }
}
