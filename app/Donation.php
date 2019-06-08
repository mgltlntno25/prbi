<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    //
    protected $fillable = ['deposit_image','prbi_id','amount','user_name','user_email','trans_number','bank_date',];
}
