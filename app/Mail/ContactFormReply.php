<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\ContactFormReply;

class ContactFormReplyEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $content = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        //
        $this->content = $content;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('mail.contact-form-reply')
            ->with([
                'content' => $this->content,
            ])
            ->subject('Has new reply');
    }
}
