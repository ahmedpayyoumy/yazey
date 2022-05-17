<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSelectedAccount extends Model
{
    //
    protected $fillable = [
        'user_id',
        'view_id',
        'google_analytics_account_id',
        'facebook_ads_account_id',
        'industry_id',
        'page_id'
    ];

    public function google_analytics_account()
    {
        return $this->belongsTo(SocialAccount::class, 'google_analytics_account_id', 'id')
            ->where(['data_source_id' => DataSource::GOOGLE_ANALYTICS]);
    }

    public function facebook_ads_account()
    {
        return $this->belongsTo(SocialAccount::class, 'facebook_ads_account_id', 'id')
            ->where(['data_source_id' => DataSource::FACEBOOK_ADS]);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }
}
