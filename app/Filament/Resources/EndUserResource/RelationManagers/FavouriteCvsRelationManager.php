<?php

namespace App\Filament\Resources\EndUserResource\RelationManagers;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FavouriteCvsRelationManager extends RelationManager
{
    protected static string $relationship = 'favouriteCvs';

    protected static ?string $title = 'CVs المفضلة';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->disabled()
                    ->label('ID'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),

                Tables\Columns\TextColumn::make('cv_id')
                    ->sortable()
                    ->label('CV ID')
                    ->url(fn ($record) => \App\Filament\Resources\CvResource::getUrl('edit', ['record' => $record->cv_id]))
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإضافة'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
