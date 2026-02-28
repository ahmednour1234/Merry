<?php

namespace App\Filament\Resources\EndUserResource\Pages;

use App\Filament\Resources\EndUserResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Forms;

class ViewEndUser extends ViewRecord
{
    protected static string $resource = EndUserResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Section::make('المعلومات الأساسية')
                    ->schema([
                        Forms\Components\TextInput::make('id')
                            ->disabled()
                            ->label('ID'),

                        Forms\Components\TextInput::make('name')
                            ->disabled()
                            ->label('الاسم'),

                        Forms\Components\TextInput::make('phone')
                            ->disabled()
                            ->label('الهاتف'),

                        Forms\Components\TextInput::make('national_id')
                            ->disabled()
                            ->label('الهوية الوطنية'),

                        Forms\Components\Toggle::make('active')
                            ->disabled()
                            ->label('نشط'),

                        Forms\Components\Toggle::make('blocked')
                            ->disabled()
                            ->label('محظور'),

                        Forms\Components\Textarea::make('bio')
                            ->disabled()
                            ->label('السيرة الذاتية')
                            ->columnSpanFull(),

                        Forms\Components\DateTimePicker::make('last_login_at')
                            ->disabled()
                            ->label('آخر تسجيل دخول'),

                        Forms\Components\DateTimePicker::make('created_at')
                            ->disabled()
                            ->label('تاريخ الإنشاء'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('الإحصائيات')
                    ->schema([
                        Forms\Components\TextInput::make('bookings_count')
                            ->disabled()
                            ->label('عدد الحجوزات')
                            ->default(function ($record): int {
                                return \App\Models\CvBooking::on('system')
                                    ->where('end_user_id', $record->id)
                                    ->count();
                            }),

                        Forms\Components\TextInput::make('favourites_count')
                            ->disabled()
                            ->label('عدد CVs المفضلة')
                            ->default(function ($record): int {
                                return \App\Models\Identity\FavouriteCv::on('identity')
                                    ->where('end_user_id', $record->id)
                                    ->count();
                            }),
                    ])
                    ->columns(2),
            ]);
    }
}
