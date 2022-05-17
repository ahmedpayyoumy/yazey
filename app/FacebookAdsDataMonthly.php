<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookAdsDataMonthly extends Model
{
    
    
    protected $table = 'facebook_ads_data_mothlys';



    protected $fillable = [
        'account_currency',
        'campaign_id',
        'date',
        'user_id',
        'social_id',
        'spend',
        'roas',
        'impressions',
        'reach',
        'clicks',
        'frequency',
        'cost_per_inline_link_click'
    ];
}
