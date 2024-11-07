<?php

namespace Jnsdnnls\Comments\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('Your Verification Code')->view('comments::emails.password')->with([
            'code' => $this->code,
        ]);
    }
}
