<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Image;

class AffiliatedStoreController extends Controller
{
    //


    public function ASLogin(Request $request)
    {
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

    public function UpdateProfile(Request $request)
    {
        $affiliatedstores = \App\AffiliatedStore::find(Auth::guard('affiliatedstore')->user()->id);
        $validator = Validator::make($request->all(), [
            'store_name' => 'required|max:255|regex:/^[\pL\s\s-]+$/u',
            'store_owner' => 'required|max:255|regex:/^[\pL\s\s-]+$/u',
            'address' => 'required|max:255',
            'contact' => 'required|numeric|digits:11',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $affiliatedstores->store_name = $request->store_name;
        $affiliatedstores->store_owner = $request->store_owner;
        $affiliatedstores->address = $request->address;
        $affiliatedstores->contact = $request->contact;
        $affiliatedstores->save();

        $aaudit = new \App\User_AuditTrail;
        $aaudit->user_id = Auth::guard('affiliatedstore')->user()->id;
        $aaudit->user_name = Auth::guard('affiliatedstore')->user()->store_name;
        $aaudit->user_email = Auth::guard('affiliatedstore')->user()->email;
        $aaudit->action =  Auth::guard('affiliatedstore')->user()->store_name . " Updated Profile. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Profile successfully updated.');
    }
    public function UpdateProfileImage(Request $request)
    {

        $af = \App\AffiliatedStore::find(Auth::guard('affiliatedstore')->user()->id);

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/affiliateddp/' . $filename);
            //$thumbnail = public_path('img/admindp_thumb/' . $filename);
            Image::make($image)->save($location);
            //Image::make($image)->resize(150, 50)->save($thumbnail);
        }

        $af->image = $filename;
        $af->save();
        
        $aaudit = new \App\User_AuditTrail;
        $aaudit->user_id = Auth::guard('affiliatedstore')->user()->id;
        $aaudit->user_name = Auth::guard('affiliatedstore')->user()->store_name;
        $aaudit->user_email = Auth::guard('affiliatedstore')->user()->email;
        $aaudit->action =  Auth::guard('affiliatedstore')->user()->store_name . " Updated Profile Image. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Profile Image successfully updated.');
    }

    public function UpdatePassword(Request $request)
    {

        $admins = \App\AffiliatedStore::find(Auth::guard('affiliatedstore')->user()->id);

        $validator = Validator::make($request->all(), [
            'password' => 'required|max:255',
            'confirm_password' => 'required|max:255|same:password',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $admins->password = Bcrypt($request->password);
        $admins->save();
        
        $aaudit = new \App\User_AuditTrail;
        $aaudit->user_id = Auth::guard('affiliatedstore')->user()->id;
        $aaudit->user_name = Auth::guard('affiliatedstore')->user()->store_name;
        $aaudit->user_email = Auth::guard('affiliatedstore')->user()->email;
        $aaudit->action =  Auth::guard('affiliatedstore')->user()->store_name . " Updated Password. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Password successfully updated.');
    }
}
