<?php

namespace App\Filament\Office\Resources;

use App\Filament\Office\Resources\SubscriptionResource\Pages;
use App\Models\OfficeSubscription;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SubscriptionResource extends Resource
{
    protected static ?string $model = OfficeSubscription::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'الاشتراكات';

    protected static ?string $modelLabel = 'اشتراك';

    protected static ?string $pluralModelLabel = 'الاشتراكات';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        $officeId = Auth::guard('office-panel')->id();

        if (! $officeId) {
            return null;
        }

        return (string) static::getModel()::on('system')
            ->where('office_id', $officeId)
            ->where('active', true)
            ->count();
    }

    public static function table(Table $table): Table
    {
        $officeId = Auth::guard('office-panel')->id();

        return $table
            ->modifyQueryUsing(function (Builder $query) use ($officeId): Builder {
                if (! $officeId) {
                    return $query->whereRaw('1 = 0');
                }

                return $query
                    ->where('office_id', $officeId)
                    ->with(['plan.translations']);
            })
            ->columns([
                Tables\Columns\TextColumn::make('plan_code')
                    ->label('الخطة')
                    ->formatStateUsing(fn (OfficeSubscription $record): string => $record->plan?->translations?->firstWhere('lang_code', 'ar')?->name
                        ?? $record->plan?->translations?->first()?->name
                        ?? $record->plan?->name
                        ?? $record->plan_code)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'cancelled', 'canceled', 'expired' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('active')
                    ->label('نشط')
                    ->boolean(),
                Tables\Columns\TextColumn::make('price')
                    ->label('السعر')
                    ->money(fn (OfficeSubscription $record): string => $record->currency_code ?? 'USD'),
                Tables\Columns\TextColumn::make('starts_at')
                    ->label('تاريخ البداية')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ends_at')
                    ->label('تاريخ الانتهاء')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                Tables\Columns\IconColumn::make('auto_renew')
                    ->label('تجديد تلقائي')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime('Y-m-d H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\Action::make('toggle_auto_renew')
                    ->label(fn (OfficeSubscription $record): string => $record->auto_renew ? 'إيقاف التجديد التلقائي' : 'تفعيل التجديد التلقائي')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(function (OfficeSubscription $record): void {
                        if ($record->office_id !== Auth::guard('office-panel')->id()) {
                            Notification::make()
                                ->title('غير مصرح بهذا الإجراء')
                                ->danger()
                                ->send();

                            return;
                        }

                        $record->update([
                            'auto_renew' => ! $record->auto_renew,
                        ]);

                        Notification::make()
                            ->title($record->auto_renew ? 'تم تفعيل التجديد التلقائي' : 'تم إيقاف التجديد التلقائي')
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('ends_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
        ];
    }
}
