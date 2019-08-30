<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerfication;
use App\Mail\EventRegMail;
use App\Mail\DonationMail;
use App\Mail\PaymentMail;
use App\Mail\VerifyDonation_Email;
use App\Mail\VerifyEventRegistration_Email;
use Illuminate\Http\Request;
use Validator;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Carbon;
use App\Event_list;

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
            'report_details' => 'required',
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
        $ir->report_details = $request->report_details;
        $ir->latitude = $request->latitude;
        $ir->longitude = $request->longitude;
        $ir->status = "inactive";
        $ir->save();


        $aaudit = new \App\User_AuditTrail;
        $aaudit->user_id ='PRBI-'.$request->user_id;
        $aaudit->user_name = $request->user_name;
        $aaudit->user_email = $request->user_email;
        $aaudit->action = " Member " . 'PRBI-'.$request->user_id . " Reported an Incident/Accident using Mobile App. ";
        $aaudit->save();


        $data['error'] = false;
        $data['message'] = 'Report Submitted!';
        return response()->json($data);

    }



    public function doDonate(Request $request){

        $validator = Validator::make($request->all(), [
            'deposit_image' => 'required',
            'trans_number' => 'required|max:255',
            'bank_date' => 'required|date',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $data['error'] = true;
            $data['message'] = 'Fill all required fields';
            return response()->json($data);
        }

        $encode_string = $request->deposit_image;
        $decode_string = base64_decode($encode_string);

        if (!empty($decode_string)) {
            $image = $decode_string;
            $filename = time() . '.' . "png";
            $location = public_path('img/donation/' . $filename);
            Image::make($image)->save($location);

            $filename;
        }

        $donations = new \App\Donation;
        $donations->deposit_image = $filename;
        $donations->prbi_id =  'PRBI-'.$request->user_id;
        $donations->user_name =  $request->user_name;
        $donations->user_email =  $request->user_email;
        $donations->trans_number = $request->trans_number;
        $donations->bank_date = $request->bank_date;
        $donations->amount = $request->amount;
        $donations->status = "submitted";
        $donations->save();



        $aaudit = new \App\User_AuditTrail;
        $aaudit->user_id ='PRBI-'.$request->user_id;
        $aaudit->user_name = $request->user_name;
        $aaudit->user_email = $request->user_email;
        $aaudit->action = " Member " . 'PRBI-'.$request->user_id . " Donated using Mobile App. ";
        $aaudit->save();

        $data = array(
            'id' => "1"
            

        );
        Mail::to($request->user_email)->send(new DonationMail($data));


        $data['error'] = false;
        $data['message'] = 'Donation Submitted!';
        return response()->json($data);
    }


    public function doRegisterEvent(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'event_name' => 'required',
            'event_date' => 'required',
            'user_id' => 'required',
            'user_name'=>'required',
            'birthday'=>'required',
            'user_email' => 'required',
        ]);

        if ($validator->fails()) {
            $data['error'] = true;
            $data['message'] = 'Something went wrong!';
            return response()->json($data);
        }


        $event_list = new \App\Event_list;
        $event_list->event_id = $request->id;
        $event_list->event_name = $request->event_name;
        $event_list->event_date = $request->event_date;
        $event_list->prbi_id = 'PRBI-'.$request->user_id;
        $event_list->user_name = $request->user_name;
        $event_list->user_email = $request->user_email;
        //$age = Carbon::parse($request->birthday)->age;
        $event_list->user_age = "18";
        $event_list->category = "Ammateur";
        $event_list->save();


        $aaudit = new \App\User_AuditTrail;
        $aaudit->user_id ='PRBI-'.$request->user_id;
        $aaudit->user_name = $request->user_name;
        $aaudit->user_email = $request->user_email;
        $aaudit->action = " Member " . 'PRBI-'.$request->user_id . " Register in an Event using Mobile App. ";
        $aaudit->save();

        $data = array(
            'event_name' => $request->event_name
        );
        Mail::to($request->user_email)->send(new EventRegMail($data));

        $data['error'] = false;
        $data['message'] = 'Event Registered Succesfully!';
        return response()->json($data);


        // $data['error'] = true;
        // $data['message'] = 'Something went wrong!';
        // return response()->json($data);
    }


    public function myEvents(Request $request)
    {
        $prbi_id = $request->user_id;

        $data['myEvents'] = \App\Event_list::where('prbi_id', '=', $prbi_id)->get();
        return response()->json($data);
    }


    public function myDonations(Request $request)
    {
        $prbi_id = $request->user_id;
        $data['myDonations'] = \App\Donation::where('prbi_id', '=', $prbi_id)->get();
        return response()->json($data);
    }

    //event if registered
    // if(!\App\Event_list::where('prbi_id','=',Auth::guard('user')->user()->prbi_id)
    //             ->where('event_id','=', $events->id)
    //             ->exists())

    public function eventFind(Request $request)
    {
        $data['events'] = \App\Event::where("id",$request->event_id)->get();
        return response()->json($data);
    }

    

    public function payment_paypal(Request $request){
        $data['events'] = \App\Event::find($request->event_id);
        return view('user/mobile_paypal', $data);
    }

    public function payment_bank (Request $request, $id){

        $events = \App\Event::find($id);

        

        



        $validator = Validator::make($request->all(), [
            'deposit_image' => 'required',
            'trans_number' => 'required',
            'bank_date' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            $data['error'] = true;
            $data['message'] = 'Fill all required fields';
            return response()->json($data);
        }
        

        $encode_string = $request->deposit_image;
        $decode_string = base64_decode($encode_string);

       
        

        if (!empty($decode_string)) {
            $image = $decode_string;
            $filename = time() . '.' . "png";
            $location = public_path('img/payments/' . $filename);
            Image::make($image)->save($location);

            $filename;
        }

        

        $payment = new \App\Payment;
        $ev_l = \App\Event_list::where('prbi_id', '=', 'PRBI-'.$request->user_id)
        ->where('event_id', '=', $id)
        ->update(['payment_status' => 'submitted']);
        $payment->deposit_image = $filename;
        $payment->prbi_id =  'PRBI-'.$request->user_id;
        $payment->user_name =  $request->user_name;
        $payment->user_email =  $request->user_email;
        $payment->payment_description = $events->id;
        $payment->trans_number = $request->trans_number;
        $payment->bank_date = $request->bank_date;
        $payment->amount = $request->amount;
        $payment->status = "submitted";
        $payment->save();

        

        $aaudit = new \App\User_AuditTrail;
        $aaudit->user_id ='PRBI-'.$request->user_id;
        $aaudit->user_name = $request->user_name;
        $aaudit->user_email = $request->user_email;
        $aaudit->action = " Member " . 'PRBI-'.$request->user_id . "  Submitted Payment for Event. ";
        $aaudit->save();

        


        $data = array(
            'id' => "1"
        );

        Mail::to($request->user_email)->send(new PaymentMail($data));

        $data['error'] = false;
        $data['message'] = 'Payment Submitted!';
        return response()->json($data);

    }
}
