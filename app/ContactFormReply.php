<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactFormReply extends Model
{
    //

    protected $fillable = ['form_id', 'user_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
