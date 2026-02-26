<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Models\Role;
use App\Models\Permission;
use App\Services\PermissionService;
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
        return 'System';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191)
                    ->label('Name'),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: true, modifyRuleUsing: function ($rule, $get) {
                        return $rule->where('guard', $get('guard') ?? 'api');
                    })
                    ->label('Slug'),
                Forms\Components\TextInput::make('guard')
                    ->required()
                    ->maxLength(32)
                    ->default('api')
                    ->label('Guard'),
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->label('Active'),
                Forms\Components\Select::make('permissions')
                    ->multiple()
                    ->relationship('permissions', 'name', fn (Builder $query) => $query->where('active', true))
                    ->preload()
                    ->searchable()
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->name . ' (' . $record->slug . ')')
                    ->label('Permissions'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->on('system'))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guard')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('users_count')
                    ->counts('users')
                    ->label('Users')
                    ->sortable(),
                Tables\Columns\TextColumn::make('permissions_count')
                    ->counts('permissions')
                    ->label('Permissions')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('name')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('Name'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['name'] ?? null,
                            fn ($query, $name) => $query->where('name', 'like', "%{$name}%")
                        );
                    }),
                Tables\Filters\Filter::make('slug')
                    ->form([
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['slug'] ?? null,
                            fn ($query, $slug) => $query->where('slug', 'like', "%{$slug}%")
                        );
                    }),
                Tables\Filters\SelectFilter::make('guard')
                    ->options([
                        'api' => 'API',
                        'web' => 'Web',
                        'filament' => 'Filament',
                    ]),
                Tables\Filters\TernaryFilter::make('active')
                    ->label('Active'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('From'),
                        Forms\Components\DatePicker::make('to')
                            ->label('To'),
                    ])
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
                Tables\Actions\Action::make('toggle')
                    ->label('Toggle Active')
                    ->icon('heroicon-o-power')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Toggle::make('active')
                            ->label('Active')
                            ->default(fn (Role $record) => $record->active),
                    ])
                    ->action(function (Role $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.roles.toggle')),
                Tables\Actions\Action::make('syncPermissions')
                    ->label('Sync Permissions')
                    ->icon('heroicon-o-key')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Select::make('permissions')
                            ->multiple()
                            ->relationship('permissions', 'name', fn (Builder $query) => $query->where('active', true))
                            ->preload()
                            ->searchable()
                            ->default(fn (Role $record) => $record->permissions->pluck('id')->toArray())
                            ->label('Permissions'),
                    ])
                    ->action(function (Role $record, array $data, PermissionService $permissionService) {
                        $permissionService->syncRolePermissions($record, $data['permissions'] ?? []);
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.roles.sync_permissions')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.roles.destroy')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
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
