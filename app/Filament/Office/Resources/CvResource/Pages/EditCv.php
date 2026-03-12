<?php

namespace App\Filament\Office\Resources\CvResource\Pages;

use App\Filament\Office\Resources\CvResource;
use App\Repositories\System\Cv\Contracts\CvRepositoryInterface;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditCv extends EditRecord
{
    protected static string $resource = CvResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotificationTitle('تم حذف السيرة الذاتية بنجاح')
                ->modalHeading('تأكيد الحذف')
                ->modalDescription('هل أنت متأكد من حذف هذه السيرة الذاتية؟')
                ->modalSubmitActionLabel('نعم، احذف'),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['file_path'])) {
            $data['file_path'] = [$data['file_path']];
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $office = Auth::guard('office-panel')->user();
        
        if ($this->record->office_id !== $office->id) {
            abort(403, 'غير مصرح لك بتعديل هذه السيرة الذاتية');
        }

        if (!in_array($this->record->status, ['pending', 'rejected', 'deactivated_by_office'], true)) {
            abort(422, 'لا يمكن تعديل السيرة الذاتية في هذه الحالة');
        }

        if (isset($data['file_path']) && is_array($data['file_path'])) {
            $data['file_path'] = $data['file_path'][0] ?? $this->record->file_path;
        }

        return $data;
    }

    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        $repo = app(CvRepositoryInterface::class);
        return $repo->update($record->id, $data) ?? $record;
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'تم حفظ التعديلات بنجاح';
    }

    protected function getSavedNotificationBody(): ?string
    {
        return 'تم تحديث بيانات السيرة الذاتية.';
    }
}
