<?php

namespace App\Filament\Resources\OfficeSubscriptionLogResource\Pages;

use App\Filament\Resources\OfficeSubscriptionLogResource;
use Filament\Resources\Pages\ListRecords;

class ListOfficeSubscriptionLogs extends ListRecords
{
    protected static string $resource = OfficeSubscriptionLogResource::class;

    protected static ?string $title = 'سجلات الاشتراكات';
}
