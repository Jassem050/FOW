<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemDetails extends Model
{
    protected $table ='items_details';

    protected $fillable = ['item_id','item_detail_id','netWeight','item_weight','item_price','qty_min','i_Detailstatus'];

    protected $primerykey = 'item_detail_id';
}
