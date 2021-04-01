<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class manager extends Model
{
    protected $table ='manager';

    protected $fillable =['mname','mcontact','memail','mpass','mdate','mstatus'];

    protected $primerykey = 'mid';
}
