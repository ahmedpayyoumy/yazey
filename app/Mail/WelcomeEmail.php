<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Carbon\Carbon;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $user = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $url = route('authenticate.login', [
            'email' => $user->email,
            'token' => $user->token
        ]);
        return $this->view('mail.welcome')
            ->with([
                'email' => $user->email,
                'dateCreated' => $user->created_at->format('Y-m-d H:i:s'),
                'name' => $user->name,
                'url' => $url
            ])
            //     ->subject('Chào mừng bạn đến với Aiosale!');
            ->subject('Welcome to Yazey');
    }
}
