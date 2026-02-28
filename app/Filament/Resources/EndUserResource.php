<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EndUserResource\Pages;
use App\Filament\Resources\EndUserResource\RelationManagers;
use App\Models\Identity\EndUser;
use App\Services\PermissionService;
use BackedEnum;
use Filament\Actions\Action as FilamentAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EndUserResource extends Resource
{
    protected static ?string $model = EndUser::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'المستخدمين';

    protected static ?string $modelLabel = 'مستخدم';

    protected static ?string $pluralModelLabel = 'المستخدمين';

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->on('identity');
            })
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),

                Tables\Columns\ImageColumn::make('avatar_path')
                    ->label('الصورة')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png')),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('الاسم'),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->sortable()
                    ->label('الهاتف'),

                Tables\Columns\TextColumn::make('national_id')
                    ->searchable()
                    ->label('الهوية الوطنية')
                    ->toggleable(),

                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable()
                    ->label('نشط')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),

                Tables\Columns\IconColumn::make('blocked')
                    ->boolean()
                    ->sortable()
                    ->label('محظور')
                    ->color(fn ($state) => $state ? 'danger' : 'success'),

                Tables\Columns\TextColumn::make('bookings_count')
                    ->label('عدد الحجوزات')
                    ->getStateUsing(function (EndUser $record): int {
                        return \App\Models\CvBooking::on('system')
                            ->where('end_user_id', $record->id)
                            ->count();
                    }),

                Tables\Columns\TextColumn::make('favourites_count')
                    ->label('عدد المفضلة')
                    ->getStateUsing(function (EndUser $record): int {
                        return \App\Models\Identity\FavouriteCv::on('identity')
                            ->where('end_user_id', $record->id)
                            ->count();
                    }),

                Tables\Columns\TextColumn::make('last_login_at')
                    ->dateTime()
                    ->sortable()
                    ->label('آخر تسجيل دخول')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label('نشط'),

                Tables\Filters\TernaryFilter::make('blocked')
                    ->label('محظور'),

                Tables\Filters\Filter::make('name')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('الاسم'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['name'] ?? null,
                            fn (Builder $query, $name): Builder => $query->where('name', 'like', "%{$name}%")
                        );
                    }),

                Tables\Filters\Filter::make('phone')
                    ->form([
                        Forms\Components\TextInput::make('phone')
                            ->label('الهاتف'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['phone'] ?? null,
                            fn (Builder $query, $phone): Builder => $query->where('phone', 'like', "%{$phone}%")
                        );
                    }),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('من'),
                        Forms\Components\DatePicker::make('to')->label('إلى'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['to'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                FilamentAction::make('block')
                    ->label('حظر/إلغاء حظر')
                    ->icon('heroicon-o-lock-closed')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Toggle::make('blocked')
                            ->label('محظور')
                            ->default(fn (EndUser $record) => $record->blocked ?? false),
                    ])
                    ->action(function (EndUser $record, array $data) {
                        $record->blocked = $data['blocked'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.endusers.block')),

                \Filament\Actions\ViewAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.endusers.view')),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\BookingsRelationManager::class,
            RelationManagers\FavouriteCvsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEndUsers::route('/'),
            'view' => Pages\ViewEndUser::route('/{record}'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }

        return app(PermissionService::class)->userHas($user, 'system.endusers.index');
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

    public static function canView($record): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }

        return app(PermissionService::class)->userHas($user, 'system.endusers.view');
    }
}
