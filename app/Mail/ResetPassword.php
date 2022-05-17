<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
// use Faker;
use Carbon\Carbon;

class ResetPassword extends Mailable
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
        $user = $this->user;
        // $faker = Faker\Factory::create();

        $user->token = $this->generateRandomString();
        $user->expired_token_date = Carbon::now()->addMinutes(User::REGISTER_EXPIRED_TIME);
        $user->save();

        $url = route('authenticate.reset', [
            'email' => $user->email,
            'token' => $user->token
        ]);

        return $this->view('mail.reset-password')
            ->with([
                'email' => $user->email,
                'url' => $url,
                'timeCreated' => date('H:i:s'),
                'dateCreated' => date('d/m/Y')
            ])
            ->subject('You have requested a password reset!');
        // ->subject('Bạn đã yêu cầu khôi phục mật khẩu!');
    }
}
