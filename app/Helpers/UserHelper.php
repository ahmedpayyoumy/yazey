<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function getAvatar()
    {
        if (Auth()) {
            $user = Auth::user();
            if ($user->avatar) {
                return $user->avatar;
            } else {
                return asset('/images/logo.png');
            }
        }
        return asset('media/default/default_user.jpeg');
    }
}
