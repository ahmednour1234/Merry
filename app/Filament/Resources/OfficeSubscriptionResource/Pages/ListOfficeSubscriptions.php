<?php

namespace App\Filament\Resources\OfficeSubscriptionResource\Pages;

use App\Filament\Resources\OfficeSubscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOfficeSubscriptions extends ListRecords
{
    protected static string $resource = OfficeSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
