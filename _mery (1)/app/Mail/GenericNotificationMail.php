<?php

namespace App\Mail;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Notification $notification)
    {
    }

    public function build(): self
    {
        return $this->subject($this->notification->title)
            ->view('emails.notification')
            ->with([
                'title' => $this->notification->title,
                'body' => $this->notification->body,
                'data' => $this->notification->data ?? [],
            ]);
    }
}


