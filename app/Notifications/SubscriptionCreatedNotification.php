<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class SubscriptionCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $officeName,
        public string $planName,
        public int $subscriptionId
    ) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'title' => 'اشتراك جديد',
            'body' => "تم إنشاء اشتراك جديد للمكتب: {$this->officeName} - الخطة: {$this->planName}",
            'subscription_id' => $this->subscriptionId,
        ];
    }
}
