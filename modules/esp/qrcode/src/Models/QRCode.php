<?php

namespace ESP\QRCode\Models;

use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    //
    protected $table = 'qr_codes';
    protected $fillable = ['image', 'link'];
}
