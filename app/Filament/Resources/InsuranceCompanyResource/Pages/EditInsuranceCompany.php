<?php

namespace App\Filament\Resources\InsuranceCompanyResource\Pages;

use App\Filament\Resources\InsuranceCompanyResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions;

class EditInsuranceCompany extends BaseEditRecord
{
    protected static string $resource = InsuranceCompanyResource::class;

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
