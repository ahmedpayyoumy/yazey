<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function user_selected_accounts()
    {
        return $this->hasMany(UserSelectedAccount::class, 'industry_id', 'id');
    }
}
