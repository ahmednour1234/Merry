<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages;
use App\Models\Promotion;
use App\Models\Plan;
use App\Models\Currency;
use App\Services\PermissionService;
use BackedEnum;
use Filament\Actions\Action as FilamentAction;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';

    public static function getNavigationGroup(): ?string
    {
        return 'المحتوى';
    }

    protected static ?string $navigationLabel = 'العروض الترويجية';

    protected static ?string $modelLabel = 'عرض ترويجي';

    protected static ?string $pluralModelLabel = 'العروض الترويجية';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191)
                    ->label('الاسم'),
                Forms\Components\Select::make('plan_code')
                    ->options(fn () => Plan::on('system')->where('active', true)->pluck('name', 'code')->toArray())
                    ->searchable()
                    ->label('الخطة'),
                Forms\Components\Select::make('type')
                    ->options([
                        'fixed' => 'مبلغ ثابت',
                        'percentage' => 'نسبة مئوية',
                    ])
                    ->required()
                    ->label('النوع'),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->step(0.01)
                    ->label('المبلغ/النسبة'),
                Forms\Components\Select::make('currency_code')
                    ->options(fn () => Currency::on('system')->where('active', true)->pluck('name', 'code')->toArray())
                    ->label('العملة')
                    ->visible(fn ($get) => $get('type') === 'fixed'),
                Forms\Components\DateTimePicker::make('starts_at')
                    ->required()
                    ->label('تاريخ البدء'),
                Forms\Components\DateTimePicker::make('ends_at')
                    ->required()
                    ->after('starts_at')
                    ->label('تاريخ الانتهاء'),
                Forms\Components\Toggle::make('auto_apply')
                    ->default(false)
                    ->label('تطبيق تلقائي'),
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->label('نشط'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('الاسم'),
                Tables\Columns\TextColumn::make('plan_code')
                    ->badge()
                    ->label('الخطة'),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'fixed' => 'success',
                        'percentage' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'fixed' => 'مبلغ ثابت',
                        'percentage' => 'نسبة مئوية',
                        default => $state,
                    })
                    ->label('النوع'),
                Tables\Columns\TextColumn::make('amount')
                    ->money(fn ($record) => $record->currency_code ?? 'SAR')
                    ->formatStateUsing(fn ($state, $record) => $record->type === 'percentage' ? $state . '%' : $state)
                    ->label('المبلغ/النسبة'),
                Tables\Columns\IconColumn::make('auto_apply')
                    ->boolean()
                    ->label('تطبيق تلقائي'),
                Tables\Columns\TextColumn::make('starts_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ البدء'),
                Tables\Columns\TextColumn::make('ends_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الانتهاء'),
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
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'fixed' => 'مبلغ ثابت',
                        'percentage' => 'نسبة مئوية',
                    ])
                    ->label('النوع'),
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
                            ->default(fn (Promotion $record) => $record->active),
                    ])
                    ->action(function (Promotion $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.promotions.toggle')),
                \Filament\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.promotions.update')),
                \Filament\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.promotions.destroy')),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.promotions.destroy')),
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
            'index' => Pages\ListPromotions::route('/'),
            'create' => Pages\CreatePromotion::route('/create'),
            'edit' => Pages\EditPromotion::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.promotions.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.promotions.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.promotions.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.promotions.destroy');
    }
}
