<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExchangeRateResource\Pages;
use App\Models\ExchangeRate;
use App\Services\PermissionService;
use BackedEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExchangeRateResource extends Resource
{
    protected static ?string $model = ExchangeRate::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-path';

    public static function getNavigationGroup(): ?string
    {
        return 'النظام';
    }

    protected static ?string $navigationLabel = 'أسعار الصرف';

    protected static ?string $modelLabel = 'سعر صرف';

    protected static ?string $pluralModelLabel = 'أسعار الصرف';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('base')
                    ->required()
                    ->maxLength(3)
                    ->uppercase()
                    ->label('العملة الأساسية')
                    ->helperText('مثل: USD'),
                Forms\Components\TextInput::make('quote')
                    ->required()
                    ->maxLength(3)
                    ->uppercase()
                    ->label('العملة المقابلة')
                    ->helperText('مثل: SAR'),
                Forms\Components\TextInput::make('rate')
                    ->required()
                    ->numeric()
                    ->step(0.00000001)
                    ->label('سعر الصرف'),
                Forms\Components\DateTimePicker::make('fetched_at')
                    ->label('تاريخ الجلب')
                    ->default(now()),
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->label('نشط'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->on('system'))
            ->columns([
                Tables\Columns\TextColumn::make('base')
                    ->searchable()
                    ->sortable()
                    ->label('العملة الأساسية')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('quote')
                    ->searchable()
                    ->sortable()
                    ->label('العملة المقابلة')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('rate')
                    ->numeric(
                        decimalPlaces: 8,
                    )
                    ->sortable()
                    ->label('سعر الصرف'),
                Tables\Columns\TextColumn::make('fetched_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الجلب'),
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
                Tables\Filters\Filter::make('base')
                    ->form([
                        Forms\Components\TextInput::make('base')
                            ->label('العملة الأساسية'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['base'] ?? null,
                            fn ($query, $base) => $query->where('base', 'like', "%{$base}%")
                        );
                    }),
                Tables\Filters\Filter::make('quote')
                    ->form([
                        Forms\Components\TextInput::make('quote')
                            ->label('العملة المقابلة'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['quote'] ?? null,
                            fn ($query, $quote) => $query->where('quote', 'like', "%{$quote}%")
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
                            ->default(fn (ExchangeRate $record) => $record->active),
                    ])
                    ->action(function (ExchangeRate $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.exchange_rates.toggle')),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.exchange_rates.store')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.exchange_rates.store')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('base')
            ->defaultSort('quote');
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
            'index' => Pages\ListExchangeRates::route('/'),
            'create' => Pages\CreateExchangeRate::route('/create'),
            'edit' => Pages\EditExchangeRate::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.exchange_rates.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.exchange_rates.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.exchange_rates.store');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.exchange_rates.store');
    }
}
