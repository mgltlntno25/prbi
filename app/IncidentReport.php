<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{
    //
    protected $fillable = ['user_id','user_email','user_contact',
    'report_image','report_details','logitude','latitude'];
}
