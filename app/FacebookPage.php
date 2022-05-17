<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class FacebookPage extends Model
{
    //
    protected $fillable = [
        'user_id',
        'page_id',
        'social_id',
        'name',
        'avatar',
        'website'
    ];

    public function ads_sets()
    {
        return $this->hasMany(FacebookAdsSet::class, 'ad_set_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(USer::class);
    }
}
