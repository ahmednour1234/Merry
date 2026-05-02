<?php

namespace App\Filament\Resources\OfficeReviewResource\Pages;

use App\Filament\Resources\OfficeReviewResource;
use Filament\Resources\Pages\ListRecords;

class ListOfficeReviews extends ListRecords
{
    protected static string $resource = OfficeReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
