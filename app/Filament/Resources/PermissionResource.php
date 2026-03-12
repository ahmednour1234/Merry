<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use App\Models\Permission;
use App\Services\PermissionService;
use Filament\Actions\Action as FilamentAction;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-key';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    public static function getNavigationSort(): ?int
    {
        return 9;
    }

    protected static ?string $modelLabel = 'صلاحية';

    protected static ?string $pluralModelLabel = 'الصلاحيات';

    public static function getNavigationLabel(): string
    {
        return 'الصلاحيات';
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::on('system')->count();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191)
                    ->label('الاسم')
                    ->helperText(fn ($get) => (function () use ($get) {
                        $slug = $get('slug');
                        if (!$slug) return null;
                        $key = 'permissions.names_' . str_replace('.', '_', $slug);
                        $t = __($key);
                        return $t !== $key ? 'الاسم المعروض: ' . $t : null;
                    })()),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: true, modifyRuleUsing: function ($rule, $get) {
                        return $rule->where('guard', $get('guard') ?? 'api');
                    })
                    ->label('المعرف'),
                Forms\Components\TextInput::make('guard')
                    ->required()
                    ->maxLength(32)
                    ->default('api')
                    ->label('الحارس'),
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
                    ->label('الاسم')
                    ->formatStateUsing(function (string $state, Permission $record): string {
                        $key = 'permissions.names_' . str_replace('.', '_', $record->slug);
                        $t = __($key);
                        return $t === $key ? $state : $t;
                    }),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->label('المعرف'),
                Tables\Columns\TextColumn::make('guard')
                    ->searchable()
                    ->sortable()
                    ->label('الحارس'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable()
                    ->label('نشط'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ التحديث')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('name')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('الاسم'),
                    ])
                    ->label('الاسم')
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['name'] ?? null,
                            fn ($query, $name) => $query->where('name', 'like', "%{$name}%")
                        );
                    }),
                Tables\Filters\Filter::make('slug')
                    ->form([
                        Forms\Components\TextInput::make('slug')
                            ->label('المعرف'),
                    ])
                    ->label('المعرف')
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['slug'] ?? null,
                            fn ($query, $slug) => $query->where('slug', 'like', "%{$slug}%")
                        );
                    }),
                Tables\Filters\SelectFilter::make('guard')
                    ->options([
                        'api' => 'API',
                        'web' => 'ويب',
                        'filament' => 'Filament',
                    ])
                    ->label('الحارس'),
                Tables\Filters\TernaryFilter::make('active')
                    ->label('نشط'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('من'),
                        Forms\Components\DatePicker::make('to')
                            ->label('إلى'),
                    ])
                    ->label('تاريخ الإنشاء')
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['to'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                FilamentAction::make('toggle')
                    ->label('تبديل الحالة')
                    ->icon('heroicon-o-power')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Toggle::make('active')
                            ->label('نشط')
                            ->default(fn (Permission $record) => $record->active),
                    ])
                    ->action(function (Permission $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.permissions.toggle')),
                \Filament\Actions\DeleteAction::make()
                    ->label('حذف')
                    ->modalHeading('تأكيد الحذف')
                    ->modalDescription('هل أنت متأكد من الحذف؟')
                    ->modalSubmitActionLabel('نعم، احذف')
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.permissions.destroy')),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.permissions.destroy')),
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
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.permissions.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.permissions.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.permissions.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.permissions.destroy');
    }
}
