<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookAdsCampaign extends Model
{
    //
    protected $fillable = [
        'campaign_id',
        'name',
        'objective',
        'created_time',
        'start_time',
        'stop_time',
        'status',
        'ad_account_id',
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

    const OBJECTIVE_APP_INSTALLS = 'APP_INSTALLS';
    const OBJECTIVE_BRAND_AWARENESS = 'BRAND_AWARENESS';
    const OBJECTIVE_CONVERSIONS = 'CONVERSIONS';
    const OBJECTIVE_EVENT_RESPONSES = 'EVENT_RESPONSES';
    const OBJECTIVE_LEAD_GENERATION = 'LEAD_GENERATION';
    const OBJECTIVE_LINK_CLICKS = 'LINK_CLICKS';
    const OBJECTIVE_LOCAL_AWARENESS = 'LOCAL_AWARENESS';
    const OBJECTIVE_MESSAGES = 'MESSAGES';
    const OBJECTIVE_OFFER_CLAIMS = 'OFFER_CLAIMS';
    const OBJECTIVE_PAGE_LIKES = 'PAGE_LIKES';
    const OBJECTIVE_POST_ENGAGEMENT = 'POST_ENGAGEMENT';
    const OBJECTIVE_PRODUCT_CATALOG_SALES = 'PRODUCT_CATALOG_SALES';
    const OBJECTIVE_REACH = 'REACH';
    const OBJECTIVE_STORE_VISITS = 'STORE_VISITS';
    const OBJECTIVE_VIDEO_VIEWS = 'VIDEO_VIEWS';

    const OBJECTIVES = [
        self::OBJECTIVE_APP_INSTALLS,
        self::OBJECTIVE_BRAND_AWARENESS,
        self::OBJECTIVE_CONVERSIONS,
        self::OBJECTIVE_EVENT_RESPONSES,
        self::OBJECTIVE_LEAD_GENERATION,
        self::OBJECTIVE_LINK_CLICKS,
        self::OBJECTIVE_LOCAL_AWARENESS,
        self::OBJECTIVE_MESSAGES,
        self::OBJECTIVE_OFFER_CLAIMS,
        self::OBJECTIVE_PAGE_LIKES,
        self::OBJECTIVE_POST_ENGAGEMENT,
        self::OBJECTIVE_PRODUCT_CATALOG_SALES,
        self::OBJECTIVE_REACH,
        self::OBJECTIVE_STORE_VISITS,
        self::OBJECTIVE_VIDEO_VIEWS
    ];

    public function ad_account()
    {
        return $this->belongsTo(FacebookAdsSocialAccount::class, 'ad_account_id', 'id');
    }

    public function social_account()
    {
        return $this->belongsTo(SocialAccount::class, 'social_id', 'id');
    }

    public function ad_sets()
    {
        return $this->hasMany(FacebookAdsSet::class, 'campaign_id', 'id');
    }
}
