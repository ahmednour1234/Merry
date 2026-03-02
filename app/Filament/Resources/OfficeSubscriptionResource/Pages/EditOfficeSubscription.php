<?php

namespace App\Filament\Resources\OfficeSubscriptionResource\Pages;

use App\Filament\Resources\OfficeSubscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOfficeSubscription extends EditRecord
{
    protected static string $resource = OfficeSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
