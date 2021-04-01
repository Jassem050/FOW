<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    protected $table ='items';

    protected $fillable = ['category_id','iname','item_image','item_qty','i_status'];

    protected $primerykey = 'item_id';
}
