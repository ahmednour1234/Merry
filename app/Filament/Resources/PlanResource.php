<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Models\Plan;
use App\Models\PlanTranslation;
use App\Models\PlanFeature;
use App\Models\SystemLanguage;
use App\Models\Currency;
use App\Services\PermissionService;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static $navigationIcon = 'heroicon-o-credit-card';

    public static function getNavigationGroup(): ?string
    {
        return 'المحتوى';
    }

    protected static ?string $navigationLabel = 'الخطط';

    protected static ?string $modelLabel = 'خطة';

    protected static ?string $pluralModelLabel = 'الخطط';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(64)
                    ->unique(ignoreRecord: true)
                    ->label('رمز الخطة')
                    ->helperText('مثل: free, pro, enterprise'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191)
                    ->label('الاسم الافتراضي'),
                Forms\Components\Textarea::make('description')
                    ->rows(3)
                    ->label('الوصف الافتراضي'),
                Forms\Components\Select::make('base_currency')
                    ->options(fn () => Currency::on('system')->where('active', true)->pluck('name', 'code')->toArray())
                    ->default('USD')
                    ->label('العملة الأساسية'),
                Forms\Components\TextInput::make('base_price')
                    ->numeric()
                    ->step(0.01)
                    ->default(0)
                    ->label('السعر الأساسي'),
                Forms\Components\Select::make('billing_cycle')
                    ->options([
                        'monthly' => 'شهري',
                        'annual' => 'سنوي',
                    ])
                    ->default('monthly')
                    ->label('دورة الفوترة'),
                Forms\Components\Repeater::make('translations')
                    ->relationship('translations')
                    ->schema([
                        Forms\Components\Select::make('lang_code')
                            ->options(fn () => SystemLanguage::on('system')->pluck('name', 'code')->toArray())
                            ->required()
                            ->label('اللغة'),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(191)
                            ->label('الاسم'),
                        Forms\Components\Textarea::make('description')
                            ->rows(2)
                            ->label('الوصف'),
                    ])
                    ->defaultItems(1)
                    ->collapsible()
                    ->label('الترجمات'),
                Forms\Components\Repeater::make('features')
                    ->relationship('features')
                    ->schema([
                        Forms\Components\TextInput::make('feature_key')
                            ->required()
                            ->maxLength(191)
                            ->label('مفتاح الميزة'),
                        Forms\Components\TextInput::make('limit')
                            ->numeric()
                            ->label('الحد'),
                        Forms\Components\TextInput::make('value')
                            ->label('القيمة'),
                        Forms\Components\Toggle::make('active')
                            ->default(true)
                            ->label('نشط'),
                    ])
                    ->defaultItems(1)
                    ->collapsible()
                    ->label('الميزات'),
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->label('نشط'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->on('system')->with('translations'))
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->label('الرمز')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('الاسم'),
                Tables\Columns\TextColumn::make('base_price')
                    ->money(fn ($record) => $record->base_currency ?? 'USD')
                    ->sortable()
                    ->label('السعر'),
                Tables\Columns\TextColumn::make('billing_cycle')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'monthly' => 'info',
                        'annual' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'monthly' => 'شهري',
                        'annual' => 'سنوي',
                        default => $state,
                    })
                    ->label('دورة الفوترة'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable()
                    ->label('نشط'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TextInput::make('code')
                    ->label('الرمز'),
                Tables\Filters\SelectFilter::make('billing_cycle')
                    ->options([
                        'monthly' => 'شهري',
                        'annual' => 'سنوي',
                    ])
                    ->label('دورة الفوترة'),
                Tables\Filters\TernaryFilter::make('active')
                    ->label('نشط'),
            ])
            ->actions([
                Tables\Actions\Action::make('toggle')
                    ->label('تبديل الحالة')
                    ->icon('heroicon-o-power')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Toggle::make('active')
                            ->label('نشط')
                            ->default(fn (Plan $record) => $record->active),
                    ])
                    ->action(function (Plan $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.plans.toggle')),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.plans.update')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.plans.destroy')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.plans.destroy')),
                ]),
            ])
            ->defaultSort('code');
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
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.plans.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.plans.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.plans.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.plans.destroy');
    }
}
