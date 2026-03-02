<?php

namespace App\Filament\Office\Pages;

use App\Models\OfficeSubscription;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SubscriptionHistory extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'سجل الاشتراكات';

    protected static ?string $title = 'سجل الاشتراكات';

    protected static ?int $navigationSort = 3;

    public function table(Table $table): Table
    {
        $office = Auth::guard('office-panel')->user();

        return $table
            ->query(OfficeSubscription::on('system')
                ->with('plan.translations')
                ->where('office_id', $office->id)
                ->orderByDesc('created_at')
            )
            ->columns([
                Tables\Columns\TextColumn::make('plan.translations.name')
                    ->label('الخطة')
                    ->getStateUsing(function ($record) {
                        $plan = $record->plan;
                        if (!$plan) return $record->plan_code;
                        
                        $translation = $plan->translations->where('lang_code', 'ar')->first()
                            ?? $plan->translations->first();
                        return $translation?->name ?? $plan->name ?? $record->plan_code;
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'gray',
                        'expired' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'نشط',
                        'pending' => 'قيد الانتظار',
                        'cancelled' => 'ملغي',
                        'expired' => 'منتهي',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('price')
                    ->label('السعر')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency_code')
                    ->label('العملة')
                    ->sortable(),
                Tables\Columns\IconColumn::make('auto_renew')
                    ->label('تجديد تلقائي')
                    ->boolean(),
                Tables\Columns\TextColumn::make('starts_at')
                    ->label('تاريخ البدء')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ends_at')
                    ->label('تاريخ الانتهاء')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'active' => 'نشط',
                        'pending' => 'قيد الانتظار',
                        'cancelled' => 'ملغي',
                        'expired' => 'منتهي',
                    ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
