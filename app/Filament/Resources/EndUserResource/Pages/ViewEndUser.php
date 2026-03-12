<?php

namespace App\Filament\Resources\EndUserResource\Pages;

use App\Filament\Resources\EndUserResource;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;

class ViewEndUser extends ViewRecord
{
    protected static string $resource = EndUserResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('المعلومات الأساسية')
                    ->schema([
                        TextEntry::make('id')
                            ->label('ID'),

                        TextEntry::make('name')
                            ->label('الاسم'),

                        TextEntry::make('phone')
                            ->label('الهاتف'),

                        TextEntry::make('national_id')
                            ->label('الهوية الوطنية'),

                        IconEntry::make('active')
                            ->label('نشط')
                            ->boolean(),

                        IconEntry::make('blocked')
                            ->label('محظور')
                            ->boolean(),

                        TextEntry::make('bio')
                            ->label('السيرة الذاتية')
                            ->columnSpanFull(),

                        TextEntry::make('last_login_at')
                            ->label('آخر تسجيل دخول')
                            ->dateTime(),

                        TextEntry::make('created_at')
                            ->label('تاريخ الإنشاء')
                            ->dateTime(),
                    ])
                    ->columns(2),

                Section::make('الإحصائيات')
                    ->schema([
                        TextEntry::make('bookings_count')
                            ->label('عدد الحجوزات')
                            ->state(function ($record): int {
                                return \App\Models\CvBooking::where('end_user_id', $record->id)
                                    ->count();
                            }),

                        TextEntry::make('favourites_count')
                            ->label('عدد CVs المفضلة')
                            ->state(function ($record): int {
                                return \App\Models\Identity\FavouriteCv::where('end_user_id', $record->id)
                                    ->count();
                            }),
                    ])
                    ->columns(2),
            ]);
    }
}
