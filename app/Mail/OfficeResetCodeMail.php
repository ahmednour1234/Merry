<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfficeResetCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $code;

    /**
     * @param string $code Six-digit code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('Your Password Reset Code')
            ->view('emails.office_reset_code')
            ->with([
                'code' => $this->code,
                'expiresMinutes' => 15,
            ]);
    }
}
