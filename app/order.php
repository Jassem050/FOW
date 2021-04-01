<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table ='order';

    protected $fillable = ['order_number','user_id','offer_price','offer_amt','actual_amt','total_amt','order_date','order_time','u_status','paid_status','paid_date','d_date'];

    protected $primerykey = 'order_id';
}
