<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    protected $table ='images';
    protected $fillable =['image_name','img_url'];
    protected $primerykey ='im_id';
}
