<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Models\Notification;
use BackedEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bell-alert';

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    protected static ?string $navigationLabel = 'الإشعارات';

    protected static ?string $modelLabel = 'إشعار';

    protected static ?string $pluralModelLabel = 'الإشعارات';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::on('system')->count();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('type')
                    ->maxLength(191)
                    ->label('النوع'),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('العنوان'),
                Forms\Components\Textarea::make('body')
                    ->rows(3)
                    ->label('المحتوى'),
                Forms\Components\Select::make('priority')
                    ->options([
                        'low' => 'منخفض',
                        'normal' => 'عادي',
                        'high' => 'عالي',
                    ])
                    ->default('normal')
                    ->label('الأولوية'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),
                Tables\Columns\TextColumn::make('type')
                    ->label('النوع')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('body')
                    ->label('المحتوى')
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\TextColumn::make('priority')
                    ->label('الأولوية')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'low' => 'منخفض',
                        'normal' => 'عادي',
                        'high' => 'عالي',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'low' => 'gray',
                        'normal' => 'info',
                        'high' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('recipients_count')
                    ->counts('recipients')
                    ->label('عدد المستلمين')
                    ->sortable(),
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('أنشأ بواسطة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('تاريخ الإنشاء')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('النوع'),
                Tables\Filters\SelectFilter::make('priority')
                    ->options([
                        'low' => 'منخفض',
                        'normal' => 'عادي',
                        'high' => 'عالي',
                    ])
                    ->label('الأولوية'),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListNotifications::route('/'),
            'view' => Pages\ViewNotification::route('/{record}'),
        ];
    }
}
