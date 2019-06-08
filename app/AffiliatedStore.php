<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliatedStore extends Model
{
    //
    protected $fillable = ['image', 'store_name','store_owner',
                            'email','password','contact','address','status','role',];
    protected $hidden = ['password'];                        
}
