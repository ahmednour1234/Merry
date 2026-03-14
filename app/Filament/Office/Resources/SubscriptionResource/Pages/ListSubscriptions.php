<?php

namespace App\Filament\Office\Resources\SubscriptionResource\Pages;

use App\Filament\Office\Resources\SubscriptionResource;
use Filament\Resources\Pages\ListRecords;

class ListSubscriptions extends ListRecords
{
    protected static string $resource = SubscriptionResource::class;

    public function getTitle(): string
    {
        return 'الاشتراكات';
    }
}
