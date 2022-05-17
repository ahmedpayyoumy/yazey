<?php

namespace App;

use App\SocialAccount;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'fb_id', 'name', 'phone_number', 'token', 'is_active', 'industry_id', 'has_agency', 'agency_info','user_role','marketing_type','google_id','is_verify','permission','is_new'
    ];

    const REGISTER_EXPIRED_TIME = 24 * 60; //minutes
    const RESET_PASS_EXPIRED_TIME = 15; //minutes

    const HAS_AGENCY = 1;
    const HAS_NOT_AGENCY = 2;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }

    public function loginSecurity()
    {
        return $this->hasOne(LoginSecurity::class);
    }

    public function social_user()
    {
        return $this->hasOne(SocialAccount::class);
    }

    public function facebook_page()
    {
        return $this->hasMany(FacebookPage::class);
    }
}
