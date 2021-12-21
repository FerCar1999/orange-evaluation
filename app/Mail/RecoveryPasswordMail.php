<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoveryPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recovery;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recovery)
    {
        $this->recovery = $recovery;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Recuperación de Contraseña')->view('mails.recovery');
    }
}
