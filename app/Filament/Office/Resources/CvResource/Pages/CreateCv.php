<?php

namespace App\Filament\Office\Resources\CvResource\Pages;

use App\Filament\Office\Resources\CvResource;
use App\Repositories\System\Cv\Contracts\CvRepositoryInterface;
use App\Filament\Resources\Pages\BaseCreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCv extends BaseCreateRecord
{
    protected static string $resource = CvResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $office = Auth::guard('office-panel')->user();
        $data['office_id'] = $office->id;
        $data['status'] = 'pending';

        if (isset($data['file_path']) && is_array($data['file_path'])) {
            $data['file_path'] = $data['file_path'][0] ?? null;
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $office = Auth::guard('office-panel')->user();
        $repo = app(CvRepositoryInterface::class);
        
        return $repo->store($data, $office->id);
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'تم إنشاء السيرة الذاتية بنجاح';
    }

    protected function getCreatedNotificationBody(): ?string
    {
        return 'تم إضافة السيرة الذاتية وسيتم مراجعتها قريباً.';
    }
}
