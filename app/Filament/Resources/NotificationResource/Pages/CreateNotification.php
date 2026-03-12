<?php

namespace App\Filament\Resources\NotificationResource\Pages;

use App\Filament\Resources\NotificationResource;
use App\Filament\Resources\Pages\BaseCreateRecord;
use App\Models\Office;
use App\Services\Notifications\NotificationService;

class CreateNotification extends BaseCreateRecord
{
    protected static string $resource = NotificationResource::class;

    protected ?string $targetAudience = null;

    public function getTitle(): string
    {
        return 'إرسال إشعار';
    }

    public function getBreadcrumbs(): array
    {
        $crumbs = parent::getBreadcrumbs();
        $keys = array_keys($crumbs);
        $last = end($keys);
        if ($last !== false && isset($crumbs[$last])) {
            $crumbs['إرسال إشعار'] = $crumbs[$last];
            unset($crumbs[$last]);
        }
        return $crumbs;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->targetAudience = $data['target_audience'] ?? 'all';
        unset($data['target_audience']);
        $data['created_by'] = auth()->id();
        return $data;
    }

    protected function afterCreate(): void
    {
        $service = app(NotificationService::class);
        $target = $this->targetAudience ?? 'all';

        if ($target === 'end_users' || $target === 'all') {
            $service->notifyEndUsers($this->record, null, ['inapp']);
        }

        if ($target === 'offices' || $target === 'all') {
            $officeIds = Office::where('active', true)->pluck('id')->toArray();
            if (!empty($officeIds)) {
                $service->notifyOffices($this->record, $officeIds, ['inapp', 'email']);
            }
        }
    }
}
