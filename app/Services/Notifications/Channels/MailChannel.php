<?php

namespace App\Services\Notifications\Channels;

use App\Mail\GenericNotificationMail;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;

class MailChannel
{
    public function sendToEmail(Notification $notification, string $email): void
    {
        Mail::to($email)->queue(new GenericNotificationMail($notification));
    }
}


