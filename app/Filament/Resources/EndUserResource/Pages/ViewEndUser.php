<?php

namespace App\Filament\Resources\EndUserResource\Pages;

use App\Filament\Resources\EndUserResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewEndUser extends ViewRecord
{
    protected static string $resource = EndUserResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('المعلومات الأساسية')
                    ->schema([
                        Infolists\Components\ImageEntry::make('avatar_path')
                            ->label('الصورة')
                            ->circular()
                            ->defaultImageUrl(url('/images/default-avatar.png')),

                        Infolists\Components\TextEntry::make('id')
                            ->label('ID'),

                        Infolists\Components\TextEntry::make('name')
                            ->label('الاسم'),

                        Infolists\Components\TextEntry::make('phone')
                            ->label('الهاتف'),

                        Infolists\Components\TextEntry::make('national_id')
                            ->label('الهوية الوطنية'),

                        Infolists\Components\IconEntry::make('active')
                            ->boolean()
                            ->label('نشط'),

                        Infolists\Components\IconEntry::make('blocked')
                            ->boolean()
                            ->label('محظور'),

                        Infolists\Components\TextEntry::make('bio')
                            ->label('السيرة الذاتية')
                            ->columnSpanFull(),

                        Infolists\Components\TextEntry::make('last_login_at')
                            ->dateTime()
                            ->label('آخر تسجيل دخول'),

                        Infolists\Components\TextEntry::make('created_at')
                            ->dateTime()
                            ->label('تاريخ الإنشاء'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('الإحصائيات')
                    ->schema([
                        Infolists\Components\TextEntry::make('bookings_count')
                            ->label('عدد الحجوزات')
                            ->getStateUsing(function ($record): int {
                                return \App\Models\CvBooking::on('system')
                                    ->where('end_user_id', $record->id)
                                    ->count();
                            }),

                        Infolists\Components\TextEntry::make('favourites_count')
                            ->label('عدد CVs المفضلة')
                            ->getStateUsing(function ($record): int {
                                return \App\Models\Identity\FavouriteCv::on('identity')
                                    ->where('end_user_id', $record->id)
                                    ->count();
                            }),
                    ])
                    ->columns(2),
            ]);
    }
}
