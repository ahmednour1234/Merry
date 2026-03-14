<?php

namespace App\Filament\Resources\CityResource\Pages;

use App\Filament\Resources\CityResource;
use App\Filament\Resources\Pages\BaseCreateRecord;

class CreateCity extends BaseCreateRecord
{
    protected static string $resource = CityResource::class;
    protected static ?string $title = 'إضافة مدينة';
}
