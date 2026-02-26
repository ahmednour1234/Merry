<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Models\City;
use App\Models\CityTranslation;
use App\Models\SystemLanguage;
use App\Services\PermissionService;
use BackedEnum;
use Filament\Actions\Action as FilamentAction;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-map-pin';

    public static function getNavigationGroup(): ?string
    {
        return 'النظام';
    }

    protected static ?string $navigationLabel = 'المدن';

    protected static ?string $modelLabel = 'مدينة';

    protected static ?string $pluralModelLabel = 'المدن';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: true)
                    ->label('المعرف')
                    ->helperText('مثل: riyadh'),
                Forms\Components\TextInput::make('country_code')
                    ->required()
                    ->maxLength(2)
                    ->uppercase()
                    ->default('SA')
                    ->label('رمز الدولة'),
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
            ->modifyQueryUsing(fn (Builder $query) => $query->with('translations'))
            ->columns([
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->label('المعرف'),
                Tables\Columns\TextColumn::make('country_code')
                    ->badge()
                    ->sortable()
                    ->label('رمز الدولة'),
                Tables\Columns\TextColumn::make('translations.name')
                    ->label('الاسم')
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
                Tables\Filters\Filter::make('slug')
                    ->form([
                        Forms\Components\TextInput::make('slug')
                            ->label('المعرف'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['slug'] ?? null,
                            fn ($query, $slug) => $query->where('slug', 'like', "%{$slug}%")
                        );
                    }),
                Tables\Filters\Filter::make('country_code')
                    ->form([
                        Forms\Components\TextInput::make('country_code')
                            ->label('رمز الدولة'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['country_code'] ?? null,
                            fn ($query, $code) => $query->where('country_code', 'like', "%{$code}%")
                        );
                    }),
                Tables\Filters\TernaryFilter::make('active')
                    ->label('نشط'),
            ])
            ->actions([
                FilamentAction::make('toggle')
                    ->label('تبديل الحالة')
                    ->icon('heroicon-o-power')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Toggle::make('active')
                            ->label('نشط')
                            ->default(fn (City $record) => $record->active),
                    ])
                    ->action(function (City $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.cities.toggle')),
                \Filament\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.cities.update')),
                \Filament\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.cities.destroy')),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.cities.destroy')),
                ]),
            ])
            ->defaultSort('slug');
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
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.cities.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.cities.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.cities.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.cities.destroy');
    }
}
