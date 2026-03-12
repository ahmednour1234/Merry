<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Models\Role;
use App\Models\Permission;
use App\Services\PermissionService;
use Filament\Actions\Action as FilamentAction;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-shield-check';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
    }

    protected static ?string $modelLabel = 'دور';

    protected static ?string $pluralModelLabel = 'الأدوار';

    public static function getNavigationLabel(): string
    {
        return 'الأدوار';
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
                    ->label('الاسم'),
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
                Forms\Components\Select::make('permissions')
                    ->multiple()
                    ->relationship('permissions', 'name', fn (Builder $query) => $query->where('active', true))
                    ->preload()
                    ->searchable()
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->name . ' (' . $record->slug . ')')
                    ->label('الصلاحيات'),
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
                Tables\Columns\TextColumn::make('users_count')
                    ->counts('users')
                    ->label('المستخدمون')
                    ->sortable(),
                Tables\Columns\TextColumn::make('permissions_count')
                    ->counts('permissions')
                    ->label('الصلاحيات')
                    ->sortable(),
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
                            ->default(fn (Role $record) => $record->active),
                    ])
                    ->action(function (Role $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.roles.toggle')),
                FilamentAction::make('syncPermissions')
                    ->label('مزامنة الصلاحيات')
                    ->icon('heroicon-o-key')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Select::make('permissions')
                            ->multiple()
                            ->relationship('permissions', 'name', fn (Builder $query) => $query->where('active', true))
                            ->preload()
                            ->searchable()
                            ->default(fn (Role $record) => $record->permissions->pluck('id')->toArray())
                            ->label('الصلاحيات'),
                    ])
                    ->action(function (Role $record, array $data, PermissionService $permissionService) {
                        $permissionService->syncRolePermissions($record, $data['permissions'] ?? []);
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.roles.sync_permissions')),
                \Filament\Actions\DeleteAction::make()
                    ->label('حذف')
                    ->modalHeading('تأكيد الحذف')
                    ->modalDescription('هل أنت متأكد من الحذف؟')
                    ->modalSubmitActionLabel('نعم، احذف')
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.roles.destroy')),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.roles.destroy')),
                ]),
            ])
            ->defaultSort('name');
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.roles.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.roles.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.roles.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.roles.destroy');
    }
}
