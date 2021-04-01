<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    
    protected $table ='users';

    protected $fillable = ['m_id','uname','ucontact','uemail','user_Aadhar','uaddress','shop_image','upass','udate','u_status'];

    protected $primerykey = 'user_id';
}
