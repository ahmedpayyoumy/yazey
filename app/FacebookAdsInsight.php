<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookAdsInsight extends Model
{
    //
    protected $fillable = [
        'date',
        'spend',
        'ad_account_id',
        'impressions',
        'impressions',
        'reach',
        'clicks',
        'frequency',
        'cost_per_inline_link_click'
    ];
}
