<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataSource extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    const FACEBOOK_MESSENGER = 1;
    const INSTAGRAM = 2;
    const ZALO = 3;
    const FACEBOOK_ADS = 4;
    const GOOGLE_ADS = 5;
    const GMAIL = 6;
    const MOBILE_APP = 7;
    const GOOGLE_MY_BUSINESS = 8;
    const GOOGLE_ANALYTICS = 9;
    const QR_CODE = 10;
    const SMART_WIFI = 11;
    const CUSTOM_API = 12;
    const WEBSITE = 13;
    const SEGMENT = 14;
}
