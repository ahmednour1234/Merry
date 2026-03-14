<?php

namespace App\Filament\Resources\OfficeSubscriptionResource\Pages;

use App\Filament\Resources\OfficeSubscriptionResource;
use App\Filament\Resources\Pages\BaseCreateRecord;

class CreateOfficeSubscription extends BaseCreateRecord
{
    protected static string $resource = OfficeSubscriptionResource::class;
    protected static ?string $title = 'إضافة اشتراك مكتب';

    protected function afterCreate(): void
    {
        \App\Models\OfficeSubscriptionLog::log($this->record->id, 'created');
    }
}
