<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = ['deposit_image','prbi_id','user_name','user_email','trans_number','bank_date','description',];
}
