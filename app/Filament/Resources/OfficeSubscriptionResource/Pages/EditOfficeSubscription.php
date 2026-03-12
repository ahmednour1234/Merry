<?php

namespace App\Filament\Resources\OfficeSubscriptionResource\Pages;

use App\Filament\Resources\OfficeSubscriptionResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions;

class EditOfficeSubscription extends BaseEditRecord
{
    protected static string $resource = OfficeSubscriptionResource::class;

    protected function afterSave(): void
    {
        $record = $this->record;
        $changes = $record->getChanges();
        if (isset($changes['auto_renew'])) {
            \App\Models\OfficeSubscriptionLog::log($record->id, 'auto_renew_toggled', ['auto_renew' => $record->auto_renew]);
        } elseif (count(array_diff_key($changes, ['updated_at' => 1])) > 0) {
            \App\Models\OfficeSubscriptionLog::log($record->id, 'updated', ['changes' => $changes]);
        }
    }

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
