<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class AffiliatedStoreController extends Controller
{
    //


    public function ASLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        //attempt dologin
        if (Auth::guard('affiliatedstore')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $request->remember)) {
            return redirect('/affiliatedstore');
        }

        //if fail
        return redirect()->back()->withErrors(['Credentials' => 'Worong credentials or the account is not activated.'])->withInput($request->all());
    }

    public function FunctionName(Reques $request)
    {
        
    }
}

