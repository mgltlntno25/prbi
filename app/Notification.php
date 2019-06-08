<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['prbi_id','user_name','user_email','date','message','role','status'];
}
