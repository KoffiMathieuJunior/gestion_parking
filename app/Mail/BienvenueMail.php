<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $accessToken;

    /**
     * Create a new message instance.
     *
     * @param  string  $accessToken
     * @return void
     */
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bienvenue sur notre application')
                    ->view('emails.welcome')
                    ->with([
                        'accessToken' => $this->accessToken,
                    ]);
    }
}