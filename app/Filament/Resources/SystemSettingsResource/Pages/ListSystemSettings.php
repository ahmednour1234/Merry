<?php

namespace App\Filament\Resources\SystemSettingsResource\Pages;

use App\Filament\Resources\SystemSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSystemSettings extends ListRecords
{
    protected static string $resource = SystemSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
