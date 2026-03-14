<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeSubscriptionLogResource\Pages;
use App\Models\OfficeSubscriptionLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OfficeSubscriptionLogResource extends Resource
{
    protected static ?string $model = OfficeSubscriptionLog::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    protected static ?string $navigationLabel = 'سجلات الاشتراكات';

    protected static ?string $modelLabel = 'سجل اشتراك';

    protected static ?string $pluralModelLabel = 'سجلات الاشتراكات';

    public static function getNavigationSort(): ?int
    {
        return 13;
    }

    public static function table(Table $table): Table
    {
        $actionLabels = [
            'created' => 'إنشاء',
            'updated' => 'تحديث',
            'cancelled' => 'إلغاء اشتراك',
            'deactivated' => 'إيقاف تفعيل',
            'auto_renew_toggled' => 'تجديد تلقائي',
            'renewed' => 'تجديد',
            'cv_created' => 'رفع سيرة ذاتية',
        ];

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('officeSubscription.id')->label('رقم الاشتراك')->sortable(),
                Tables\Columns\TextColumn::make('officeSubscription.office.name')->label('المكتب')->searchable(),
                Tables\Columns\TextColumn::make('action')
                    ->label('الإجراء')
                    ->formatStateUsing(fn (string $state) => $actionLabels[$state] ?? $state)
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'created' => 'success',
                        'updated' => 'info',
                        'cancelled' => 'danger',
                        'deactivated' => 'warning',
                        'auto_renew_toggled' => 'primary',
                        'renewed' => 'success',
                        'cv_created' => 'info',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('المستخدم')->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')->label('التاريخ')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('action')
                    ->label('الإجراء')
                    ->options([
                        'created' => 'إنشاء',
                        'updated' => 'تحديث',
                        'cancelled' => 'إلغاء اشتراك',
                        'deactivated' => 'إيقاف تفعيل',
                        'auto_renew_toggled' => 'تجديد تلقائي',
                        'renewed' => 'تجديد',
                        'cv_created' => 'رفع سيرة ذاتية',
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOfficeSubscriptionLogs::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
