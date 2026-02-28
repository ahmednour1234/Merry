<?php

namespace App\Listeners;

use App\Events\OfficeRegistered;
use App\Models\Office;
use App\Services\Notifications\NotificationService;

class NotifyAdminsOfNewOfficeRegistration
{
    public function __construct(
        protected NotificationService $notificationService
    ) {
    }

    public function handle(OfficeRegistered $event): void
    {
        $office = Office::on('system')->find($event->officeId);
        
        if (!$office) {
            return;
        }

        $notification = $this->notificationService->createNotification([
            'type' => 'office.registered',
            'title' => 'تسجيل مكتب جديد',
            'body' => "تم تسجيل مكتب جديد: {$office->name}",
            'data' => [
                'office_id' => $office->id,
                'office_name' => $office->name,
                'office_email' => $office->email,
            ],
            'priority' => 'normal',
        ]);

        $this->notificationService->notifyAdmins($notification, ['inapp', 'email']);
    }
}
