<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\SystemLanguage;
use App\Services\PermissionService;
use BackedEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    public static function getNavigationGroup(): ?string
    {
        return 'المحتوى';
    }

    protected static ?string $navigationLabel = 'الفئات';

    protected static ?string $modelLabel = 'فئة';

    protected static ?string $pluralModelLabel = 'الفئات';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('parent_id')
                    ->options(fn () => Category::on('system')->with('translations')->where('active', true)->get()->mapWithKeys(function ($cat) {
                        $name = $cat->translations->where('lang_code', 'ar')->first()?->name ?? $cat->translations->first()?->name ?? $cat->name ?? $cat->slug;
                        return [$cat->id => $name];
                    })->toArray())
                    ->searchable()
                    ->label('الفئة الرئيسية')
                    ->helperText('اتركه فارغاً للفئات الرئيسية'),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: true)
                    ->label('المعرف')
                    ->helperText('مثل: construction, cleaning'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191)
                    ->label('الاسم الافتراضي'),
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
                    ])
                    ->defaultItems(1)
                    ->collapsible()
                    ->label('الترجمات'),
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->label('نشط'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->on('system')->with(['translations', 'parent']))
            ->columns([
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->label('المعرف'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('الاسم الافتراضي'),
                Tables\Columns\TextColumn::make('translations.name')
                    ->label('الاسم المترجم')
                    ->formatStateUsing(fn ($record) => $record->translations->where('lang_code', 'ar')->first()?->name ?? $record->translations->first()?->name ?? '-'),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label('الفئة الرئيسية')
                    ->toggleable(),
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
                Tables\Filters\Filter::make('slug')
                    ->form([
                        Forms\Components\TextInput::make('slug')
                            ->label('المعرف'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['slug'] ?? null,
                            fn ($query, $slug) => $query->where('slug', 'like', "%{$slug}%")
                        );
                    }),
                Tables\Filters\Filter::make('name')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('الاسم'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['name'] ?? null,
                            fn ($query, $name) => $query->where('name', 'like', "%{$name}%")
                        );
                    }),
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
                            ->default(fn (Category $record) => $record->active),
                    ])
                    ->action(function (Category $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.categories.toggle')),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.categories.update')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.categories.destroy')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.categories.destroy')),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.categories.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.categories.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.categories.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.categories.destroy');
    }
}
