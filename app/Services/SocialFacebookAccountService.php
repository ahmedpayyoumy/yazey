<?php
namespace App\Services;
use App\SocialAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::where('social_id', '=', $providerUser->id)
            ->first();
        $userfb = User::where('fb_id', '=', $providerUser->getId())->where('email', '=', $providerUser->email)->first();
        $useremail = User::where('email', '=', $providerUser->email)->first();
        if($useremail){
            $user = $useremail;
        } elseif($userfb){
            $user = $userfb;
        }

        if (!$account) {
            if (!$userfb && !$useremail){
                $user = User::create([
                    "name" => $providerUser->name,
                    "email" => ($providerUser->email) ? $providerUser->email : null,
                    "is_verify" => 1,
                    "fb_id" => $providerUser->getId(),
                    "avatar" => $providerUser->avatar,
                    "is_active" => 1,
                ]);
            }
            $account = SocialAccount::create([
                'name' => $providerUser->name,
                'logo_src' => $providerUser->avatar,
                'social_id' => $providerUser->getId(),
                'access_token' => $providerUser->token,
                'data_source_id' => $providerUser->getId(),
                'user_id' => $user->id,
            ]);
            $data['socialUser'] = $account;
        } else {
            $data['socialUser'] = $account;
        }
        $data['user'] = $user;
        $data['providerUser'] = $providerUser; 
        return $user;
    }
}
