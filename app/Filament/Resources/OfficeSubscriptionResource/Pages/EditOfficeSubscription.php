<?php

namespace App\Filament\Resources\OfficeSubscriptionResource\Pages;

use App\Filament\Resources\OfficeSubscriptionResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions;

class EditOfficeSubscription extends BaseEditRecord
{
    protected static string $resource = OfficeSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('حذف')
                ->modalHeading('تأكيد الحذف')
                ->modalDescription('هل أنت متأكد من الحذف؟')
                ->modalSubmitActionLabel('نعم، احذف'),
        ];
    }
}
