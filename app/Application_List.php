<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application_List extends Model
{
    //
    protected $fillable = ['user_id','user_name','user_email','valid_id','application_description'];
}
