<?php

namespace App\Filament\Resources\CityResource\Pages;

use App\Filament\Resources\CityResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions;

class EditCity extends BaseEditRecord
{
    protected static string $resource = CityResource::class;
    protected static ?string $title = 'تعديل مدينة';

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
