<?php

namespace App\Filament\Resources\OfficeResource\Pages;

use App\Filament\Resources\OfficeResource;
use App\Filament\Resources\Pages\BaseCreateRecord;

class CreateOffice extends BaseCreateRecord
{
    protected static string $resource = OfficeResource::class;

    public function getTitle(): string
    {
        return 'إضافة مكتب';
    }
}
