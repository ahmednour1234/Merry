<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemSettingsResource\Pages;
use App\Models\SystemSetting;
use App\Services\PermissionService;
use BackedEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SystemSettingsResource extends Resource
{
    protected static ?string $model = SystemSetting::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function getNavigationGroup(): ?string
    {
        return 'النظام';
    }

    protected static ?string $navigationLabel = 'إعدادات النظام';

    protected static ?string $modelLabel = 'إعداد';

    protected static ?string $pluralModelLabel = 'إعدادات النظام';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('scope')
                    ->required()
                    ->maxLength(64)
                    ->label('النطاق')
                    ->default('global'),
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(191)
                    ->label('المفتاح')
                    ->unique(ignoreRecord: true, modifyRuleUsing: function ($rule, $get) {
                        return $rule->where('scope', $get('scope') ?? 'global');
                    }),
                Forms\Components\Textarea::make('value')
                    ->label('القيمة')
                    ->rows(3)
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'string' => 'نص',
                        'json' => 'JSON',
                        'int' => 'رقم',
                        'bool' => 'منطقي',
                    ])
                    ->default('json')
                    ->label('النوع')
                    ->required(),
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
                Tables\Columns\TextColumn::make('scope')
                    ->searchable()
                    ->sortable()
                    ->label('النطاق'),
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->sortable()
                    ->label('المفتاح'),
                Tables\Columns\TextColumn::make('value')
                    ->limit(50)
                    ->label('القيمة')
                    ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state, JSON_UNESCAPED_UNICODE) : (string) $state),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'json' => 'info',
                        'string' => 'success',
                        'int' => 'warning',
                        'bool' => 'danger',
                        default => 'gray',
                    })
                    ->label('النوع'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable()
                    ->label('نشط'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('آخر تحديث')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('scope')
                    ->options(fn () => SystemSetting::on('system')
                        ->distinct()
                        ->pluck('scope', 'scope')
                        ->toArray())
                    ->label('النطاق'),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'string' => 'نص',
                        'json' => 'JSON',
                        'int' => 'رقم',
                        'bool' => 'منطقي',
                    ])
                    ->label('النوع'),
                Tables\Filters\TernaryFilter::make('active')
                    ->label('نشط'),
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.settings.update')),
            ])
            ->defaultSort('scope')
            ->defaultSort('key');
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
            'index' => Pages\ListSystemSettings::route('/'),
            'edit' => Pages\EditSystemSetting::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.settings.index');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.settings.update');
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}
