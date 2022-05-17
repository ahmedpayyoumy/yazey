<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class ResetPasswordInvalid extends Mailable
{
    use Queueable, SerializesModels;
    private $email = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        //
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $now = Carbon::now();
        return $this->view('mail.reset-password-invalid')
                    ->with([
                        'email' => $this->email,
                        'timeCreated' => $now->format('H:i a'),
                        'dateCreated' => $now->format('d/m/Y')
                    ])
                ->subject('You have requested a password reset!');
    }
}
