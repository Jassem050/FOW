<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    protected $table ='offers';

    protected $fillable = ['offer_price'];

    protected $primerykey = 'offer_id';
}
