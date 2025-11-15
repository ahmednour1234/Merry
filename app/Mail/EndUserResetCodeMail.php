<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EndUserResetCodeMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('Your Password Reset Code')
            ->view('emails.enduser_reset_code')
            ->with([
                'code' => $this->code,
                'expiresMinutes' => 15,
            ]);
    }
}


