<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookAdCreative extends Model
{
    //
    protected $fillable = [
        'creative_id',
        'name',
        'object_story_spec',
        'social_id',
        'ad_account_id',
        'company_id'
    ];

    protected $casts = [
        'object_story_spec' => 'array'
    ];

    const ACTION_BOOK_TRAVEL = 'BOOK_TRAVEL';
    const ACTION_CONTACT_US = 'CONTACT_US';
    const ACTION_GET_QUOTE = 'GET_QUOTE';
    const ACTION_LEARN_MORE = 'LEARN_MORE';
    const ACTION_MESSAGE_PAGE = 'MESSAGE_PAGE';
    const ACTION_SHOP_NOW = 'SHOP_NOW';
    const ACTION_SUBSCRIBE = 'SUBSCRIBE';
    const ACTION_SIGN_UP = 'SIGN_UP';
    const ACTION_APPLY_NOW = 'APPLY_NOW';

    const CALL_TO_ACTIONS = [
        self::ACTION_BOOK_TRAVEL => 'Book Now',
        self::ACTION_CONTACT_US => 'Contact Us',
        self::ACTION_GET_QUOTE => 'Get Quote',
        self::ACTION_LEARN_MORE => 'Learn More',
        self::ACTION_MESSAGE_PAGE => 'Send Message',
        self::ACTION_SHOP_NOW => 'Shop Now',
        self::ACTION_SUBSCRIBE => 'Subscribe',
        self::ACTION_SIGN_UP => 'Sign Up',
        self::ACTION_APPLY_NOW => 'Apply Now',
    ];


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        //static::addGlobalScope(new CompanyScope);
    }

    public function ad_account()
    {
        return $this->belongsTo(FacebookAdsSocialAccount::class, 'ad_account_id', 'id');
    }

    public function social_account()
    {
        return $this->belongsTo(SocialAccount::class, 'social_id', 'id');
    }

    public function ad()
    {
        return $this->belongsToMany(FacebookAd::class, 'i_facebook_ads_ad_creatives', 'creative_id', 'ad_id');
    }
}
