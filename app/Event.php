<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['event_image','event_name','description','amount','location','event_date','start_reg','end_reg','isExtended','extended_date','status',];
}
