<?php

namespace App\Filament\Resources\EndUserResource\RelationManagers;

use App\Models\CvBooking;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'bookings';

    protected static ?string $title = 'الحجوزات';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->disabled()
                    ->label('ID'),
            ]);
    }

    protected function getTableQuery(): Builder
    {
        $ownerRecord = $this->getOwnerRecord();
        return CvBooking::on('system')
            ->where('end_user_id', $ownerRecord->id);
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
                    ->label('CV ID'),

                Tables\Columns\TextColumn::make('office_id')
                    ->sortable()
                    ->label('المكتب'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'pending'   => 'warning',
                        'accepted'  => 'success',
                        'rejected'  => 'danger',
                        'cancelled' => 'gray',
                        default     => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'pending'   => 'قيد الانتظار',
                        'accepted'  => 'مقبول',
                        'rejected'  => 'مرفوض',
                        'cancelled' => 'ملغي',
                        default     => $state ?? 'غير معروف',
                    })
                    ->label('الحالة'),

                Tables\Columns\TextColumn::make('note')
                    ->label('ملاحظة')
                    ->limit(50)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending'   => 'قيد الانتظار',
                        'accepted'  => 'مقبول',
                        'rejected'  => 'مرفوض',
                        'cancelled' => 'ملغي',
                    ])
                    ->label('الحالة'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
