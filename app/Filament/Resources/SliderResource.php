<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
use App\Models\SliderTranslation;
use App\Models\SystemLanguage;
use App\Services\PermissionService;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function getNavigationGroup(): ?string
    {
        return 'المحتوى';
    }

    protected static ?string $navigationLabel = 'الشرائح';

    protected static ?string $modelLabel = 'شريحة';

    protected static ?string $pluralModelLabel = 'الشرائح';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required()
                    ->directory('sliders')
                    ->label('الصورة'),
                Forms\Components\TextInput::make('link_url')
                    ->url()
                    ->maxLength(255)
                    ->label('رابط'),
                Forms\Components\TextInput::make('position')
                    ->numeric()
                    ->default(0)
                    ->label('الترتيب'),
                Forms\Components\Repeater::make('translations')
                    ->relationship('translations')
                    ->schema([
                        Forms\Components\Select::make('lang_code')
                            ->options(fn () => SystemLanguage::on('system')->pluck('name', 'code')->toArray())
                            ->required()
                            ->label('اللغة'),
                        Forms\Components\TextInput::make('title')
                            ->maxLength(191)
                            ->label('العنوان'),
                        Forms\Components\Textarea::make('text')
                            ->rows(2)
                            ->label('النص'),
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
            ->modifyQueryUsing(fn (Builder $query) => $query->on('system')->with('translations'))
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('الصورة')
                    ->circular(),
                Tables\Columns\TextColumn::make('translations.title')
                    ->label('العنوان')
                    ->formatStateUsing(fn ($record) => $record->translations->where('lang_code', 'ar')->first()?->title ?? $record->translations->first()?->title ?? '-'),
                Tables\Columns\TextColumn::make('link_url')
                    ->url(fn ($record) => $record->link_url)
                    ->openUrlInNewTab()
                    ->label('رابط')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('position')
                    ->sortable()
                    ->label('الترتيب'),
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
                            ->default(fn (Slider $record) => $record->active),
                    ])
                    ->action(function (Slider $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.sliders.toggle')),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.sliders.update')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.sliders.destroy')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.sliders.destroy')),
                ]),
            ])
            ->defaultSort('position');
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.sliders.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.sliders.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.sliders.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.sliders.destroy');
    }
}
