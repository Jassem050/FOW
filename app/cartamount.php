<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cartamount extends Model
{
    protected $table ='cartminamount';

    protected $fillable = ['minimum_amount'];

    protected $primerykey = 'cart_min_id';
}
