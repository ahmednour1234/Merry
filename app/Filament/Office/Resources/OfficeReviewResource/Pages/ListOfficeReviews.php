<?php

namespace App\Filament\Office\Resources\OfficeReviewResource\Pages;

use App\Filament\Office\Resources\OfficeReviewResource;
use Filament\Resources\Pages\ListRecords;

class ListOfficeReviews extends ListRecords
{
    protected static string $resource = OfficeReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
