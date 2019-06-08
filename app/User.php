<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    protected $fillable = ['prbi_id','first_name','last_name','email','contact',
                            'address','password','emergency_name','emergency_contact',
                            'birthday','gender','blood_type','valid_id','qrcode','isVerified_email',
                            'isVerified_contact','isPremium','isInsured',];
                            
    protected $hidden = ['password'];
    
}
