<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookAdsSocialAccount extends Model
{
    //
    protected $fillable = [
        'account_id',
        'social_account_id',
        'spend'
    ];

    public function social_account()
    {
        return $this->belongsTo(SocialAccount::class, 'social_account_id', 'id');
    }

    public function campaigns()
    {
        return $this->hasMany(FacebookAdsCampaign::class, 'ad_account_id', 'id');
    }
}
