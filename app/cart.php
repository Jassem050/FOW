<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table ='cart';

    protected $fillable = ['order_id','user_id','item_id','cart_qty','cart_price','sub_total','c_status'];

    protected $primerykey = 'cart_id';
}
