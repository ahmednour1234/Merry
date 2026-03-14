<?php

namespace App\Filament\Resources\NationalityResource\Pages;

use App\Filament\Resources\NationalityResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions;

class EditNationality extends BaseEditRecord
{
    protected static string $resource = NationalityResource::class;
    protected static ?string $title = 'تعديل جنسية';

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
