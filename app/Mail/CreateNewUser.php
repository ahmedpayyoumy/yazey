<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class CreateNewUser extends Mailable
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

    private function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (
            isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
        ) {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        $urlCreateNewUser = $protocol . $_SERVER['HTTP_HOST'] . '/login';
        $userNewPassword = substr(md5($this->user->email . time()), 0, 10);
        $userNewPassword = $this->generateRandomString();
        $this->user->password = bcrypt($userNewPassword);
        $this->user->save();
        return $this->view('mail.create-new-user')
            ->with([
                'email' => $this->user->email,
                'userNewPassword' => $userNewPassword,
                'urlCreateNewUser' => $urlCreateNewUser
            ])
            ->subject('Your account has been created!');
    }
}
