<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeSubscriptionResource\Pages;
use App\Models\OfficeSubscription;
use App\Models\Plan;
use BackedEnum;
use Carbon\Carbon;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Actions\Action as FilamentAction;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OfficeSubscriptionResource extends Resource
{
    protected static ?string $model = OfficeSubscription::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-credit-card';

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    public static function getNavigationSort(): ?int
    {
        return 8;
    }

    protected static ?string $navigationLabel = 'الاشتراكات';

    protected static ?string $modelLabel = 'اشتراك';

    protected static ?string $pluralModelLabel = 'الاشتراكات';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::on('system')->count();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('office_id')
                    ->relationship('office', 'name')
                    ->required()
                    ->label('المكتب')
                    ->searchable(),
                Forms\Components\Select::make('plan_code')
                    ->relationship('plan', 'code')
                    ->required()
                    ->label('الباقة')
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function (?string $state, Set $set, Get $get): void {
                        if (!$state) return;
                        $plan = Plan::on('system')->find($state);
                        if ($plan) {
                            $set('price', (string) $plan->base_price);
                            $set('_billing_cycle', $plan->billing_cycle === 'annual' ? 'سنوي' : 'شهري');
                            $starts = $get('starts_at');
                            if ($starts) {
                                $dt = Carbon::parse($starts);
                                $ends = $plan->billing_cycle === 'annual' ? $dt->copy()->addYear() : $dt->copy()->addMonth();
                                $set('ends_at', $ends);
                            }
                        }
                    }),
                Forms\Components\TextInput::make('_billing_cycle')
                    ->label('دورة الفوترة')
                    ->default('—')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'قيد الانتظار',
                        'active' => 'نشط',
                        'cancelled' => 'ملغي',
                        'expired' => 'منتهي',
                    ])
                    ->required()
                    ->label('الحالة'),
                Forms\Components\Toggle::make('auto_renew')
                    ->label('التجديد التلقائي'),
                Forms\Components\Toggle::make('active')
                    ->label('نشط'),
                Forms\Components\DateTimePicker::make('starts_at')
                    ->required()
                    ->label('تاريخ البدء')
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set, Get $get): void {
                        if (!$state) return;
                        $code = $get('plan_code');
                        if (!$code) return;
                        $plan = Plan::on('system')->find($code);
                        if (!$plan) return;
                        $dt = Carbon::parse($state);
                        $ends = $plan->billing_cycle === 'annual' ? $dt->copy()->addYear() : $dt->copy()->addMonth();
                        $set('ends_at', $ends);
                    }),
                Forms\Components\DateTimePicker::make('ends_at')
                    ->required()
                    ->label('تاريخ الانتهاء')
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\Hidden::make('currency_code')
                    ->default('SAR'),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->label('السعر')
                    ->default(fn (Get $get) => (function () use ($get) {
                        $code = $get('plan_code');
                        if (!$code) return null;
                        $plan = Plan::on('system')->find($code);
                        return $plan ? (string) $plan->base_price : null;
                    })())
                    ->disabled()
                    ->dehydrated(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),
                Tables\Columns\TextColumn::make('office.name')
                    ->sortable()
                    ->label('المكتب')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plan.name')
                    ->formatStateUsing(fn ($record) => $record->plan?->translations->where('lang_code', 'ar')->first()?->name ?? $record->plan?->name ?? '-')
                    ->label('الباقة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'pending' => 'قيد الانتظار',
                        'active' => 'نشط',
                        'cancelled' => 'ملغي',
                        'expired' => 'منتهي',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'pending' => 'warning',
                        'active' => 'success',
                        'cancelled' => 'gray',
                        'expired' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\IconColumn::make('auto_renew')
                    ->label('تجديد تلقائي')
                    ->boolean(),
                Tables\Columns\IconColumn::make('active')
                    ->label('نشط')
                    ->boolean(),
                Tables\Columns\TextColumn::make('price')
                    ->money(fn ($record) => $record->currency_code ?? 'USD')
                    ->label('السعر')
                    ->sortable(),
                Tables\Columns\TextColumn::make('starts_at')
                    ->dateTime()
                    ->label('تاريخ البدء')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ends_at')
                    ->dateTime()
                    ->label('تاريخ الانتهاء')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('تاريخ الإنشاء')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'قيد الانتظار',
                        'active' => 'نشط',
                        'cancelled' => 'ملغي',
                        'expired' => 'منتهي',
                    ])
                    ->label('الحالة'),
                Tables\Filters\TernaryFilter::make('active')
                    ->label('نشط'),
                Tables\Filters\TernaryFilter::make('auto_renew')
                    ->label('تجديد تلقائي'),
            ])
            ->actions([
                \Filament\Actions\EditAction::make()->label('تعديل'),
                FilamentAction::make('renew')
                    ->label('إعادة تجديد الاشتراك')
                    ->icon('heroicon-o-arrow-path')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('إعادة تجديد الاشتراك')
                    ->modalDescription(fn (OfficeSubscription $record) => $record->ends_at->isFuture()
                        ? 'لا يمكن التجديد الآن. التجديد يتم في معاده؛ الفترة الجديدة تبدأ من تاريخ الانتهاء المحدد ويتم التجديد في نفس ذلك اليوم.'
                        : 'سيتم تجديد الاشتراك؛ الفترة الجديدة تبدأ من اليوم حسب دورة الفوترة للخطة. هل تريد المتابعة؟')
                    ->modalSubmitActionLabel('نعم، جدد')
                    ->action(function (OfficeSubscription $record) {
                        if ($record->ends_at->isFuture()) {
                            \Filament\Notifications\Notification::make()
                                ->title('لا، أنت لسة مجدد الاشتراك')
                                ->body('التجديد يتم في معاده؛ الفترة الجديدة تبدأ من تاريخ الانتهاء المحدد ويتم التجديد في نفس ذلك اليوم.')
                                ->warning()
                                ->send();
                            return;
                        }
                        $plan = $record->plan;
                        $startsAt = now();
                        if ($plan && $plan->billing_cycle === 'annual') {
                            $endsAt = $startsAt->copy()->addYear();
                        } else {
                            $endsAt = $startsAt->copy()->addMonth();
                        }
                        $record->update([
                            'starts_at' => $startsAt,
                            'ends_at' => $endsAt,
                            'status' => 'active',
                            'active' => true,
                        ]);
                        \App\Models\OfficeSubscriptionLog::log($record->id, 'renewed', [
                            'starts_at' => $startsAt->toIso8601String(),
                            'ends_at' => $endsAt->toIso8601String(),
                        ]);
                    }),
                FilamentAction::make('deactivate')
                    ->label('إيقاف تفعيل')
                    ->icon('heroicon-o-no-symbol')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('إيقاف تفعيل الاشتراك')
                    ->modalDescription('هل أنت متأكد من إيقاف تفعيل هذا الاشتراك؟')
                    ->modalSubmitActionLabel('نعم، أوقف التفعيل')
                    ->action(function (OfficeSubscription $record) {
                        $record->update(['active' => false]);
                        \App\Models\OfficeSubscriptionLog::log($record->id, 'deactivated');
                    })
                    ->visible(fn (OfficeSubscription $record) => $record->active),
                FilamentAction::make('cancel')
                    ->label('إلغاء الاشتراك')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('إلغاء الاشتراك')
                    ->modalDescription('هل أنت متأكد من إلغاء هذا الاشتراك؟')
                    ->modalSubmitActionLabel('نعم، ألغي الاشتراك')
                    ->action(function (OfficeSubscription $record) {
                        $record->update(['status' => 'cancelled', 'active' => false]);
                        \App\Models\OfficeSubscriptionLog::log($record->id, 'cancelled');
                    }),
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
            'index' => Pages\ListOfficeSubscriptions::route('/'),
            'create' => Pages\CreateOfficeSubscription::route('/create'),
            'edit' => Pages\EditOfficeSubscription::route('/{record}/edit'),
        ];
    }
}
