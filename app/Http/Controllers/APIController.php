<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use Illuminate\Support\Facades\Hash;

class APIController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'email' => 'required|string',
        ]);

        if ($validator->fails()) {
            $data['error'] = true;
            $data['message'] = 'Invalid Email or Password';
            return response()->json($data);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $data['error'] = true;
            $data['message'] = 'Invalid Email or Password';
            return response()->json($data);
        }
        if (!(!$user)) {
            if (Hash::check($request->password, $user->password)) {
                $data['error'] = false;
                $data['message'] = 'Login Successful';
                $data['data']['id'] = $user->id;
                return response()->json($data);

                $aaudit = new \App\UserLoginSession;
                $aaudit->user_id = $user->prbi_id;
                $aaudit->user_name = $user->first_name . ' ' . $user->last_name;
                $aaudit->user_email = $user->email;
                $aaudit->action = " Member " . $user->prbi_id . " Logged in. ";
                $aaudit->save();
                
            }
            if (!(Hash::check($request->password, $user->password))) {
                $data['error'] = true;
                $data['message'] = 'Invalid Email or Password';
                return response()->json($data);
            }
        }
    }

    public function profile(Request $request)
    { 
        $data['data'] = User::find($request->user_id);
        return response()->json($data);
    }

    public function update(Request $request)
    { 
        User::where('id', $request->user_id)->update(['first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'contact' => $request->contact]);


    }

    
}
