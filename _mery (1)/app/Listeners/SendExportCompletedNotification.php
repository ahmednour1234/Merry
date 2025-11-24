<?php

namespace App\Listeners;

use App\Events\ExportCompleted;
use App\Models\User;
use App\Services\Notifications\NotificationService;

class SendExportCompletedNotification
{
    public function __construct(private NotificationService $service)
    {
    }

    public function handle(ExportCompleted $event): void
    {
        $notification = $this->service->createNotification([
            'type' => 'export_completed',
            'title' => 'Export ready',
            'body' => 'Your export is ready to download.',
            'data' => [
                'file' => $event->fileName,
                'link' => $event->downloadLink,
                'expires_at' => $event->expiresAt,
            ],
            'created_by' => $event->userId,
        ]);

        $user = User::find($event->userId);
        if ($user) {
            $this->service->deliverToUsers($notification, collect([$user]), ['inapp','email']);
        }
    }
}


