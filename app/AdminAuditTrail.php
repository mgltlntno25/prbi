<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminAuditTrail extends Model
{
    //

    protected $fillable = ['user_id','user_name','user_email','action'];
}
