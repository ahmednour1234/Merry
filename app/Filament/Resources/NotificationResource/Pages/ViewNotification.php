<?php

namespace App\Filament\Resources\NotificationResource\Pages;

use App\Filament\Resources\NotificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNotification extends ViewRecord
{
    protected static string $resource = NotificationResource::class;

    public function getTitle(): string
    {
        return 'رؤية إشعار';
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (!empty($data['type'])) {
            $data['type'] = NotificationResource::typeLabel($data['type']);
        }
        if (!empty($data['title'])) {
            $data['title'] = NotificationResource::titleLabel($data['title']);
        }
        if (!empty($data['body'])) {
            $data['body'] = NotificationResource::bodyLabel($data['body']);
        }
        return $data;
    }

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
