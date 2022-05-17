<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    //
    protected $fillable = ['contact_id', 'subject', 'content', 'is_reply'];

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(ContactFormReply::class, 'form_id', 'id');
    }
}
