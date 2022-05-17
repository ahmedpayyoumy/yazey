<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginSecurity extends Model
{
    protected $table = 'login_securities';
    protected $fillable = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
