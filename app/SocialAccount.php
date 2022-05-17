<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class SocialAccount extends Model
{
    //
    protected $fillable = [
        'name',
        'logo_src',
        'social_id',
        'access_token',
        'note',
        'data_source_id',
        'user_id'
    ];

    public function data_source()
    {
        return $this->belongsTo(DataSource::class, 'data_source_id', 'id');
    }

    public function facebook_ads_social_account()
    {
        return $this->hasOne(FacebookAdsSocialAccount::class, 'social_account_id', 'id');
    }

    public function social_account()
    {
        return $this->belongsTo(SocialAccount::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
