<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\AdminAuditTrail;
use Validator;
use Illuminate\Support\Facades\Auth;

class SysAdminController extends Controller
{
    //
    public function SysAdLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        //attempt dologin
        if (Auth::guard('sysad')->attempt(['email' => $request->email, 'password' => $request->password,], $request->remember)) {
            return redirect('sysad/dashboard');
        }

        //if fail
        return redirect()->back()->withErrors(['Credentials' => 'Worong credentials or the account is not activated.'])->withInput($request->all());
    }


    public function CreateAdmin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255|alpha',
            'last_name' => 'required|max:255|alpha',
            'email' => 'required|email|unique:admins,email',
            'contact' => 'required|numeric|digits:11',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $admins = new Admin;
        $admins->fname = $request->first_name;
        $admins->lname = $request->last_name;
        $admins->email = $request->email;
        $admins->contact = $request->contact;




        $admins->save();

        return redirect()->back()->with('success', 'Admin successfully added.');
    }

    public function ChangeStatus($id)
    {
        $admins = Admin::find($id);

        if ($admins->status == 'active') {
            $admins->status = 'inactive';
            $admins->save();
            return redirect()->back()->with('success', 'Admin successfully deactivated.');
        }

        if ($admins->status == 'inactive') {
            $admins->status = 'active';
            $admins->save();
            return redirect()->back()->with('success', 'Admin successfully activated.');
        }
    }
}
