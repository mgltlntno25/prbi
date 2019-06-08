<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_AuditTrail extends Model
{
    //
    protected $fillable = ['user_name','user_email','action'];
}
