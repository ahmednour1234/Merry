<?php

namespace App\Filament\Resources\NotificationResource\Pages;

use App\Filament\Resources\NotificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNotification extends ViewRecord
{
    protected static string $resource = NotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('حذف')
                ->modalHeading('تأكيد الحذف')
                ->modalDescription('هل أنت متأكد من حذف هذا الإشعار؟')
                ->modalSubmitActionLabel('نعم، احذف'),
        ];
    }
}
