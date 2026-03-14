<?php

namespace App\Filament\Resources\OfficeResource\Pages;

use App\Filament\Resources\OfficeResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions;

class EditOffice extends BaseEditRecord
{
    protected static string $resource = OfficeResource::class;

    public function getTitle(): string
    {
        return 'تعديل مكتب';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('حذف مكتب')
                ->modalHeading('تأكيد الحذف')
                ->modalDescription('هل أنت متأكد من حذف هذا المكتب؟')
                ->modalSubmitActionLabel('نعم، احذف')
                ->modalCancelActionLabel('إلغاء'),
        ];
    }
}
