<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Facades\App;

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


                $aaudit = new \App\UserLoginSession;
                $aaudit->user_id = $user->prbi_id;
                $aaudit->user_name = $user->first_name . ' ' . $user->last_name;
                $aaudit->user_email = $user->email;
                $aaudit->action = " Member " . $user->prbi_id . " Logged in using Mobile App. ";
                $aaudit->save();

                return response()->json($data);
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
        User::where('id', $request->user_id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact' => $request->contact
        ]);
    }


    public function report_incident(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'report_image' => 'required',
            'report_detail' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        if ($validator->fails()) {
            $data['error'] = true;
            $data['message'] = 'Fill all required fields';
            return response()->json($data);
        }

        $encode_string = $request->report_image;
        $decode_string = base64_decode($encode_string);

        if (!empty($decode_string)) {
            $image = $decode_string;
            $filename = time() . '.' . "png";
            $location = public_path('img/incident_report/' . $filename);
            Image::make($image)->save($location);

            $filename;
        }


        $ir = new \App\IncidentReport;
        $ir->user_id = $request->user_id;
        $ir->user_name = $request->user_name;
        $ir->user_email = $request->user_email;
        $ir->user_contact = $request->user_contact;
        $ir->report_image = $filename;
        $ir->report_detail = $request->report_detail;
        $ir->latitude = $request->latitude;
        $ir->longitude = $request->longitude;
        $ir->status = "inactive";


        $aaudit = new \App\User_AuditTrail();
        $aaudit->user_id ='PRBI-'.$request->user_id;
        $aaudit->user_name = $request->user_name;
        $aaudit->user_email = $request->user_email;
        $aaudit->action = " Member " . 'PRBI-'.$request->user_id . " Reported an Incident/Accident using Mobile App. ";
        $aaudit->save();


        $data['error'] = false;
        $data['message'] = 'Report Submitted!';
        return response()->json($data);

    }

}
