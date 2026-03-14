<?php

namespace App\Filament\Resources\OfficeResource\Pages;

use App\Filament\Resources\OfficeResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ViewOffice extends ViewRecord
{
    protected static string $resource = OfficeResource::class;

    public function getTitle(): string
    {
        return 'عرض مكتب';
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('بيانات المكتب')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('الصورة')
                            ->circular(),
                        TextEntry::make('id')
                            ->label('ID'),
                        TextEntry::make('name')
                            ->label('الاسم'),
                        TextEntry::make('email')
                            ->label('البريد الإلكتروني'),
                        TextEntry::make('phone')
                            ->label('الهاتف'),
                        TextEntry::make('commercial_reg_no')
                            ->label('رقم السجل التجاري')
                            ->placeholder('—'),
                        TextEntry::make('address')
                            ->label('العنوان')
                            ->placeholder('—')
                            ->columnSpanFull(),
                        IconEntry::make('active')
                            ->label('نشط')
                            ->boolean(),
                        IconEntry::make('blocked')
                            ->label('محظور')
                            ->boolean(),
                        TextEntry::make('last_login_at')
                            ->label('آخر تسجيل دخول')
                            ->dateTime()
                            ->placeholder('—'),
                        TextEntry::make('created_at')
                            ->label('تاريخ الإنشاء')
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
}
