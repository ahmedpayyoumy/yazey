<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoasReport extends Model
{
    //
    protected $fillable = [
        'monthly_traffic',
        'user_id',
        'ads_spent',
        'industry_id',
        'user_selected_account_id'
    ];

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }

    public function user_selected_account()
    {
        return $this->belongsTo(UserSelectedAccount::class, 'user_selected_account_id', 'id');
    }

    const PER_PAGE = 25;
}
