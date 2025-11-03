<?php

namespace App\Services\Notifications\Channels;

use App\Models\Notification;
use App\Models\NotificationRecipient;

class InAppChannel
{
    public function sendToUser(Notification $notification, int $userId, string $recipientType = 'user', $recipientId = null): void
    {
        NotificationRecipient::create([
            'notification_id' => $notification->id,
            'recipient_type' => $recipientType,
            'recipient_id' => $recipientId,
            'resolved_user_id' => $userId,
            'channel' => 'inapp',
            'status' => 'sent',
        ]);
    }

    public function sendToOffice(Notification $notification, int $officeId): void
    {
        NotificationRecipient::create([
            'notification_id' => $notification->id,
            'recipient_type' => 'office',
            'recipient_id' => $officeId,
            'resolved_user_id' => null,
            'channel' => 'inapp',
            'status' => 'sent',
        ]);
    }
}


