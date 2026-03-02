<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class OfficeSubscriptionCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(
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
            'title' => 'تم إنشاء اشتراك جديد',
            'body' => "تم إنشاء اشتراكك في الخطة: {$this->planName} بنجاح",
            'subscription_id' => $this->subscriptionId,
        ];
    }
}
