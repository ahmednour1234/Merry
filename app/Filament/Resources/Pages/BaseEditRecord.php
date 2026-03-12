<?php

namespace App\Filament\Resources\Pages;

use Filament\Resources\Pages\EditRecord as FilamentEditRecord;

abstract class BaseEditRecord extends FilamentEditRecord
{
    protected function getSaveFormAction(): \Filament\Actions\Action
    {
        return parent::getSaveFormAction()->label('حفظ');
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()->label('إلغاء');
    }
}
