<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Models\Coupon;
use App\Models\Currency;
use App\Services\PermissionService;
use BackedEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-ticket';

    public static function getNavigationGroup(): ?string
    {
        return 'المحتوى';
    }

    protected static ?string $navigationLabel = 'كوبونات الخصم';

    protected static ?string $modelLabel = 'كوبون';

    protected static ?string $pluralModelLabel = 'كوبونات الخصم';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: true)
                    ->label('رمز الكوبون')
                    ->helperText('مثل: SUMMER2024'),
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
                Forms\Components\TextInput::make('max_redemptions')
                    ->numeric()
                    ->minValue(0)
                    ->label('الحد الأقصى للاستخدام')
                    ->helperText('0 = غير محدود'),
                Forms\Components\TextInput::make('per_office_limit')
                    ->numeric()
                    ->minValue(0)
                    ->label('الحد لكل مكتب')
                    ->helperText('0 = غير محدود'),
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
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->label('الرمز')
                    ->badge()
                    ->color('primary'),
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
                Action::make('toggle')
                    ->label('تبديل الحالة')
                    ->icon('heroicon-o-power')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Toggle::make('active')
                            ->label('نشط')
                            ->default(fn (Coupon $record) => $record->active),
                    ])
                    ->action(function (Coupon $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.coupons.toggle')),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.coupons.update')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.coupons.destroy')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.coupons.destroy')),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.coupons.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.coupons.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.coupons.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.coupons.destroy');
    }
}
