<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;;

class AffiliatedStore extends Authenticatable
{
    //
    protected $fillable = ['image', 'store_name','store_owner',
                            'email','password','contact','address','status','role',];
    protected $hidden = ['password'];                        
}
