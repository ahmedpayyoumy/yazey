<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookAd extends Model
{
    //
    protected $fillable = [
        'ad_id',
        'name',
        'status',
        'created_time',
        'ad_set_id',
        'social_id',
        'user_id'
    ];

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_PAUSED = 'PAUSED';
    const STATUS_DELETED = 'DELETED';
    const STATUS_ARCHIVED = 'ARCHIVED';

    const STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_PAUSED,
        self::STATUS_DELETED,
        self::STATUS_ARCHIVED
    ];

    public function ad_set()
    {
        return $this->belongsTo(FacebookAdsSet::class, 'ad_set_id', 'id');
    }

    public function social_account()
    {
        return $this->belongsTo(SocialAccount::class, 'social_id', 'id');
    }

    public function creatives()
    {
        return $this->belongsToMany(FacebookAdCreative::class, 'i_facebook_ads_ad_creatives', 'ad_id', 'creative_id')
            ->orderBy('id', 'DESC');
    }
}
