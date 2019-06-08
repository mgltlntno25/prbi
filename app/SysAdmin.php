<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class SysAdmin extends Authenticatable
{
    protected $fillable = ['profile_image','email', 'password','role'];
    protected $hidden = ['password'];
    
}
