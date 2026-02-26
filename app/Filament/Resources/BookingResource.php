<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\CvBooking;
use App\Services\PermissionService;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingResource extends Resource
{
    protected static ?string $model = CvBooking::class;

    // ✅ Fix: must match Resource::$navigationIcon type (BackedEnum|string|null)
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'الحجوزات';
    protected static ?string $modelLabel = 'حجز';
    protected static ?string $pluralModelLabel = 'الحجوزات';

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    /**
     * ✅ Better place to force connection/query.
     * If "system" is a DB connection name, this is correct.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->on('system');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),

                Tables\Columns\TextColumn::make('cv_id')
                    ->sortable()
                    ->label('السيرة الذاتية'),

                Tables\Columns\TextColumn::make('office_id')
                    ->sortable()
                    ->label('المكتب'),

                Tables\Columns\TextColumn::make('end_user_id')
                    ->sortable()
                    ->label('المستخدم'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'pending'   => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                        default     => 'gray',
                    })
                    ->label('الحالة'),

                Tables\Columns\TextColumn::make('booked_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الحجز'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending'   => 'قيد الانتظار',
                        'confirmed' => 'مؤكد',
                        'cancelled' => 'ملغي',
                        'completed' => 'مكتمل',
                    ])
                    ->label('الحالة'),

                Tables\Filters\Filter::make('booked_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('من'),
                        Forms\Components\DatePicker::make('to')->label('إلى'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('booked_at', '>=', $date),
                            )
                            ->when(
                                $data['to'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('booked_at', '<=', $date),
                            );
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }

        return app(PermissionService::class)->userHas($user, 'system.bookings.index');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}
