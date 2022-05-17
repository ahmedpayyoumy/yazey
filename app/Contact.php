<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = ['name', 'email', 'phone_number', 'address'];

    public function contactForm()
    {
        return $this->hasMany(ContactForm::class, 'contact_id', 'id');
    }
}
