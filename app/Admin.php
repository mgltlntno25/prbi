<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //
    protected $fillable = ['fname', 'lname','email','contact','password','profile_image','address','gender','birthday','age'];
    protected $hidden = ['password'];
}
