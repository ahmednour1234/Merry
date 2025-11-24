<?php

namespace App\Observers;

use App\Models\Office;
use App\Services\Notifications\NotificationService;

class OfficeObserver
{
    public function __construct(private NotificationService $service)
    {
    }

    public function updated(Office $office): void
    {
        $changed = $office->getChanges();
        if (array_key_exists('active', $changed) || array_key_exists('blocked', $changed)) {
            $statusText = $office->blocked ? 'محظور' : ($office->active ? 'مفعل' : 'غير مفعل');

            $notification = $this->service->createNotification([
                'type' => 'office_status_changed',
                'title' => 'حالة الحساب تم تحديثها',
                'body' => 'تم تحديث حالة حساب مكتبك إلى: '.$statusText,
                'data' => [
                    'active' => (bool) $office->active,
                    'blocked' => (bool) $office->blocked,
                ],
            ]);

            // Send to the office (in-app + email)
            $this->service->notifyOffices($notification, [$office->id], ['inapp','email']);
        }
    }
}



