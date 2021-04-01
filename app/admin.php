<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table ='admin';

    protected $fillable = ['user_name','password'];

    protected $primerykey = 'admin_id';
}
