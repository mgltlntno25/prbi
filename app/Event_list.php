<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_list extends Model
{
    //
    protected $fillable = ['event_id','event_name','prbi_id','user_name','user_email','user_age','category','payment_status','reg_status'];
}
