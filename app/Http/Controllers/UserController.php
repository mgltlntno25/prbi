<?php

namespace App\Http\Controllers;

use App\Event;
use App\Payment;
use App\Donation;
use App\Notification;
use App\Application_List;
use App\User;
use App\Event_list;
use Validator;
use Image;
use Illuminate\Http\Request;
use QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\UserLoginSession;
use App\User_AuditTrail;
use App\Rules\Captcha;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerfication;
use App\Mail\EventRegMail;
use App\Mail\DonationMail;
use App\Mail\PaymentMail;

class UserController extends Controller
{

    public function registerEvent()
    {
        $reg['type'] = 'EventName registration';
        $reg['price'] = '300';
        $reg['description'] = 'Registration fee to EventName';
        $reg['redirect'] = url('/status/event/' . 'asdfasdfasdfas');
        return redirect()->route('payment', $reg);
    }

    public function UserLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        //attempt dologin
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $request->remember)) {
            $aaudit = new UserLoginSession;
            $aaudit->user_id = Auth::guard('user')->user()->prbi_id;
            $aaudit->user_name = Auth::guard('user')->user()->first_name . ' ' . Auth::guard('user')->user()->last_name;
            $aaudit->user_email = Auth::guard('user')->user()->email;
            $aaudit->action = " Member " . Auth::guard('user')->user()->prbi_id . " Logged in. ";
            $aaudit->save();
            return redirect('user/events');
        }

        //if fail
        return redirect()->back()->withErrors(['Credentials' => 'Worong credentials or the account is not activated.'])->withInput($request->all());
    }

    public function AccountRegistration(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255|regex:/^[\pL\s\s-]+$/u',
            'last_name' => 'required|max:255|regex:/^[\pL\s\s-]+$/u',
            'email' => 'required|email|unique:users,email|unique:admins,email|unique:affiliated_stores,email',
            'contact' => 'required|numeric|digits:11',
            'password' => 'required|min:8',
            'password_confimation' => 'required|min:8|same:password',
            'emergency_name' => 'required|max:255',
            'emergency_contact' => 'required|numeric|digits:11',
            'birthday' => 'required|date|before:15 years ago',
            'gender' => 'required',
            // 'g-recaptcha-response' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $filename = 'qr' . time() . '.png';
        $user = new User;
        $user->prbi_id = "PRBI-";
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->address = $request->address;
        $user->password = Bcrypt($request->password);
        $user->emergency_name = $request->emergency_name;
        $user->emergency_contact = $request->emergency_contact;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        if($request->gender == "male"){
            $user->profile_image = 'avatar.png';
        }else{
            $user->profile_image = 'avatar2.png';
        }
        $user->blood_type = $request->bloodtype;
        $user->qrcode = $filename;
        $user->status = 'inactive';
        $token = $request->input('g-recaptcha-response');
        $user->isVerified_email = '0';
        
        $user->save();

        
        $data  = array(

            'email' => $request->email,
            'id' => $user->id

        );

        Mail::to($request->email)->send(new EmailVerfication($data));

        User::where('id', $user->id)
            ->update(['prbi_id' => 'PRBI-' . $user->id]);

        QrCode::size(720)
            ->format('png')
            ->generate(url('/member/' . $user->id), public_path('img/qrcode/' . $filename));


            


        return redirect(url('user/events'))->with('success', 'Registration successfull! .');



        


    }


    public function AccountVerifiy(Request $request,$id){

        $user = \App\User::find($id);

        if ($user->isVerified_email == '0' ){

            User::where('email', $request->email)
            ->update(['status' => 'active',
            'isVerified_email' => '1']);

            return redirect(url('user/events'))->with('success', 'Verification successfull! .');

        }else{

            return redirect(url('emailError'))->with('success', 'Verification Faild .');

        }

        



    }

    public function UpdateProfile(Request $request, $id)
    {

        $user = \App\User::find($id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255|regex:/^[\pL\s\s-]+$/u',
            'last_name' => 'required|max:255|regex:/^[\pL\s\s-]+$/u',
            'contact' => 'required|numeric|digits:11',
            'emergency_name' => 'required|max:255',
            'emergency_contact' => 'required|numeric|digits:11',
            'birthday' => 'required|date',
            'gender' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->address = $request->address;
        $user->emergency_name = $request->emergency_name;
        $user->emergency_contact = $request->emergency_contact;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->blood_type = $request->bloodtype;
        $user->save();
        $aaudit = new User_AuditTrail;
        $aaudit->user_id = Auth::guard('user')->user()->prbi_id;
        $aaudit->user_name = Auth::guard('user')->user()->first_name . ' ' . Auth::guard('user')->user()->last_name;
        $aaudit->user_email = Auth::guard('user')->user()->email;
        $aaudit->action = " Member " . Auth::guard('user')->user()->prbi_id . " Updated Profile. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Update successfully .');
    }




    public function UpdateProfileImage(Request $request, $id)
    {

        $users = \App\User::find($id);

        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/userdp/' . $filename);
            //$thumbnail = public_path('img/admindp_thumb/' . $filename);
            Image::make($image)->resize(708, 693)->save($location);
            //Image::make($image)->resize(150, 50)->save($thumbnail);
        }

        $users->profile_image = $filename;
        $users->save();
        $aaudit = new User_AuditTrail;
        $aaudit->user_id = Auth::guard('user')->user()->prbi_id;
        $aaudit->user_name = Auth::guard('user')->user()->first_name . ' ' . Auth::guard('user')->user()->last_name;
        $aaudit->user_email = Auth::guard('user')->user()->email;
        $aaudit->action = " Member " . Auth::guard('user')->user()->prbi_id . " Updated Profile Image. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Update successfully .');
    }

    public function UpdatePassword(Request $request, $id)
    {

        $users = \App\User::find($id);

        $validator = Validator::make($request->all(), [
            'password' => 'required|max:255',
            'password1' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $users->password = Bcrypt($request->password);
        $users->save();
        $aaudit = new User_AuditTrail;
        $aaudit->user_id = Auth::guard('user')->user()->prbi_id;
        $aaudit->user_name = Auth::guard('user')->user()->first_name . ' ' . Auth::guard('user')->user()->last_name;
        $aaudit->user_email = Auth::guard('user')->user()->email;
        $aaudit->action = " Member " . Auth::guard('user')->user()->prbi_id . " Updated Password. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Update successfully .');
    }


    public function upgrade_1(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'application_description' => 'required|max:255',


        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->exists()) {

            $application_list = Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->first();
            $application_list->user_id = Auth::guard('user')->user()->prbi_id;
            $application_list->user_name = Auth::guard('user')->user()->first_name . " " . Auth::guard('user')->user()->last_name;
            $application_list->user_email = Auth::guard('user')->user()->email;
            $application_list->valid_id = ' ';
            $application_list->application_description = $request->application_description;
            $application_list->save();
            return redirect('user/upgrade/step2')->with('success', 'step1 complete .');
        } else

            $application_list = new Application_List;
        $application_list->user_id = Auth::guard('user')->user()->prbi_id;
        $application_list->user_name = Auth::guard('user')->user()->first_name . " " . Auth::guard('user')->user()->last_name;
        $application_list->user_email = Auth::guard('user')->user()->email;
        $application_list->valid_id = ' ';
        $application_list->application_description = $request->application_description;
        $application_list->save();

        return redirect('user/upgrade/step2')->with('success', 'step1 complete .');
    }

    public function upgrade_2(Request $request)
    {

        $application_list = Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->first();
        $validator = Validator::make($request->all(), [
            'valid_id' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('valid_id')) {
            $image = $request->file('valid_id');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/user_validid/' . $filename);
            //$thumbnail = public_path('img/admindp_thumb/' . $filename);
            Image::make($image)->save($location);
            //Image::make($image)->resize(150, 50)->save($thumbnail);
        }

        $application_list->valid_id = $filename;
        $application_list->save();

        return redirect('user/upgrade/step3')->with('success', 'step2 complete .');
    }

    public function updateValidIdstep3(Request $request)
    {

        $application_list = Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->first();
        $validator = Validator::make($request->all(), [
            'valid_id' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('valid_id')) {
            $image = $request->file('valid_id');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/user_validid/' . $filename);
            //$thumbnail = public_path('img/admindp_thumb/' . $filename);
            Image::make($image)->save($location);
            //Image::make($image)->resize(150, 50)->save($thumbnail);
        }

        $application_list->valid_id = $filename;
        $application_list->save();

        return redirect()->back()->with('success', 'Valid Id updated .');
    }

    public function SubmitApplication()
    {
        $application_list = Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->first();
        $application_list->application_status = "submitted";
        $application_list->save();
        $aaudit = new User_AuditTrail;
        $aaudit->user_id = Auth::guard('user')->user()->prbi_id;
        $aaudit->user_name = Auth::guard('user')->user()->first_name . ' ' . Auth::guard('user')->user()->last_name;
        $aaudit->user_email = Auth::guard('user')->user()->email;
        $aaudit->action = " Member " . Auth::guard('user')->user()->prbi_id . " Submitted Upgrade Application. ";
        $aaudit->save();


        return redirect('user/profile')->with('success', 'Upgrade Application Submitted.');
    }


    public function ApplicationBank(Request $request)
    {

        $al = Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->first();

        $ev_l = \App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
            ->where('application_description', '=', $al->application_description)
            ->update(['payment_status' => 'submitted']);


        $validator = Validator::make($request->all(), [
            'deposit_image' => 'required|max:3000',
            'trans_number' => 'required|max:255',
            'bank_date' => 'required|date',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $payments = new Payment;

        if ($request->hasFile('deposit_image')) {
            $image = $request->file('deposit_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/payments/' . $filename);
            Image::make($image)->save($location);

            $payments->deposit_image = $filename;
        }

        $payments->user_id = Auth::guard('user')->user()->prbi_id;
        $payments->user_name = Auth::guard('user')->user()->first_name . " " . Auth::guard('user')->user()->last_name;
        $payments->user_email = Auth::guard('user')->user()->email;
        $payments->payment_description = $al->application_description;
        if (Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
            ->where('application_status', '=', 'verified')->where('application_description', 'premium')->first()
        ) {
            $payments->payment_amount = 220;
        } else
            $payments->payment_amount = 500;

        $payments->trans_number = $request->trans_number;
        $payments->bank_date = $request->bank_date;
        $payments->status = 'submitted';
        $aaudit = new User_AuditTrail;
        $aaudit->user_id = Auth::guard('user')->user()->prbi_id;
        $aaudit->user_name = Auth::guard('user')->user()->first_name . ' ' . Auth::guard('user')->user()->last_name;
        $aaudit->user_email = Auth::guard('user')->user()->email;
        $aaudit->action = " Member " . Auth::guard('user')->user()->prbi_id . "  Submitted Upgrade Application Payment. ";
        $aaudit->save();
        $payments->save();
        return redirect('user/myapplication')->with('success', 'Payment successfully submitted.');
    }






    public function UploadDonation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deposit_image' => 'required|image|mimes:jpeg,bmp,png,jpg',
            'trans_number' => 'required|max:255',
            'bank_date' => 'required|date',
            'amount' => 'required|numeric',
        ]);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $donations = new \App\Donation;

        if ($request->hasFile('deposit_image')) {
            $image = $request->file('deposit_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/donation/' . $filename);
            Image::make($image)->save($location);

            $donations->deposit_image = $filename;
        }

        $donations->prbi_id =  Auth::guard('user')->user()->prbi_id;
        $donations->user_name =  Auth::guard('user')->user()->first_name . " " .  Auth::guard('user')->user()->last_name;
        $donations->user_email =  Auth::guard('user')->user()->email;
        $donations->trans_number = $request->trans_number;
        $donations->bank_date = $request->bank_date;
        $donations->amount = $request->amount;
        $donations->status = "submitted";
        $donations->save();
        $aaudit = new User_AuditTrail;
        $aaudit->user_id = Auth::guard('user')->user()->prbi_id;
        $aaudit->user_name = Auth::guard('user')->user()->first_name . ' ' . Auth::guard('user')->user()->last_name;
        $aaudit->user_email = Auth::guard('user')->user()->email;
        $aaudit->action = " Member " . Auth::guard('user')->user()->prbi_id . "  Donated. ";
        $aaudit->save();

        $data = array(
            'amount' => $request->amount
        );

        Mail::to(Auth::guard('user')->user()->email)->send(new DonationMail($data));

        return redirect()->back()->with('success', 'Donation Added successfully added.');
    }





    public function EventRegistration(Request $request, $id)
    {

        $events = Event::find($id);

        $event_list = new Event_list;
        $event_list->event_id = $events->id;
        $event_list->event_name = $events->event_name;
        $event_list->event_date = $events->event_date;
        $event_list->prbi_id = Auth::guard('user')->user()->prbi_id;
        $event_list->user_name = Auth::guard('user')->user()->first_name . " " . Auth::guard('user')->user()->last_name;
        $event_list->user_email = Auth::guard('user')->user()->email;
        $age = Carbon::parse(Auth::guard('user')->user()->birthday)->age;
        $event_list->user_age = $age;
        $event_list->category = $request->category;


        $event_list->save();
        $aaudit = new User_AuditTrail;
        $aaudit->user_id = Auth::guard('user')->user()->prbi_id;
        $aaudit->user_name = Auth::guard('user')->user()->first_name . ' ' . Auth::guard('user')->user()->last_name;
        $aaudit->user_email = Auth::guard('user')->user()->email;
        $aaudit->action = " Member " . Auth::guard('user')->user()->prbi_id . " Registered Event. ";
        $aaudit->save();

        $data = array(
            'event_name' => $events->event_name
        );

        Mail::to(Auth::guard('user')->user()->email)->send(new EventRegMail($data));

        return redirect('user/events')->with('success', 'Event successfully registered.');
    }

    public function Paypal($id)
    {
        $events = \App\Event::find($id);
        $ev_l = \App\Event_list::where('prbi_id', '=', Auth::guard('user')->user()->prbi_id)
            ->where('event_id', '=', $id)
            ->update(['payment_status' => 'submitted']);

        $payments = new Payment;

        $payments->user_id = Auth::guard('user')->user()->prbi_id;
        $payments->user_name = Auth::guard('user')->user()->first_name . " " . Auth::guard('user')->user()->last_name;
        $payments->user_email = Auth::guard('user')->user()->email;
        $payments->payment_description = $events->id;
        $payments->payment_amount = $events->amount;
        $payments->trans_number = "VIA PAYPAL";
        $payments->deposit_image = "paypal";
        $payments->status = 'submitted';
        $payments->bank_date = Carbon::now()->format('Y-m-d');
        $payments->save();
        $aaudit = new User_AuditTrail;
        $aaudit->user_id = Auth::guard('user')->user()->prbi_id;
        $aaudit->user_name = Auth::guard('user')->user()->first_name . ' ' . Auth::guard('user')->user()->last_name;
        $aaudit->user_email = Auth::guard('user')->user()->email;
        $aaudit->action = " Member " . Auth::guard('user')->user()->prbi_id . "  Paid via PayPal. ";
        $aaudit->save();

        return redirect('user/myevents')->with('success', 'Event successfully registered.');
    }

    public function PayPal_application()
    {
        $al = Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->first();

        $ev_l = \App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
            ->where('application_description', '=', $al->application_description)
            ->update(['payment_status' => 'submitted']);
        $payments = new Payment;

        $payments->user_id = Auth::guard('user')->user()->prbi_id;
        $payments->user_name = Auth::guard('user')->user()->first_name . " " . Auth::guard('user')->user()->last_name;
        $payments->user_email = Auth::guard('user')->user()->email;
        $payments->payment_description = $al->application_description;
        if (Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
            ->where('application_status', '=', 'verified')->where('application_description', 'premium')->first()
        ) {
            $payments->payment_amount = 220;
        } else
            $payments->payment_amount = 500;

        $payments->trans_number = "VIA PAYPAL";
        $payments->deposit_image = "paypal";
        $payments->status = 'submitted';
        $payments->bank_date = Carbon::now()->format('Y-m-d');
        $payments->save();



        $aaudit = new User_AuditTrail;
        $aaudit->user_id = Auth::guard('user')->user()->prbi_id;
        $aaudit->user_name = Auth::guard('user')->user()->first_name . ' ' . Auth::guard('user')->user()->last_name;
        $aaudit->user_email = Auth::guard('user')->user()->email;
        $aaudit->action = " Member " . Auth::guard('user')->user()->prbi_id . "  Paid via PayPal. ";
        $aaudit->save();

        return redirect('user/events')->with('success', 'Profile successfully upgraded.');

    }

    public function BankDeposit(Request $request, $id)
    {


        $events = \App\Event::find($id);

        $ev_l = \App\Event_list::where('prbi_id', '=', Auth::guard('user')->user()->prbi_id)
            ->where('event_id', '=', $id)
            ->update(['payment_status' => 'submitted']);


        $validator = Validator::make($request->all(), [
            'deposit_image' => 'required|max:255',
            'trans_number' => 'required|max:255',
            'bank_date' => 'required|date',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $payments = new Payment;




        if ($request->hasFile('deposit_image')) {
            $image = $request->file('deposit_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/payments/' . $filename);
            Image::make($image)->save($location);

            $payments->deposit_image = $filename;
        }


        $payments->user_id = Auth::guard('user')->user()->prbi_id;
        $payments->user_name = Auth::guard('user')->user()->first_name . " " . Auth::guard('user')->user()->last_name;
        $payments->user_email = Auth::guard('user')->user()->email;
        $payments->payment_description = $events->id;
        $payments->payment_amount = $events->amount;
        $payments->trans_number = $request->trans_number;
        $payments->bank_date = $request->bank_date;
        $payments->status = 'submitted';

        $aaudit = new User_AuditTrail;
        $aaudit->user_id = Auth::guard('user')->user()->prbi_id;
        $aaudit->user_name = Auth::guard('user')->user()->first_name . ' ' . Auth::guard('user')->user()->last_name;
        $aaudit->user_email = Auth::guard('user')->user()->email;
        $aaudit->action = " Member " . Auth::guard('user')->user()->prbi_id . "  Submitted Payment for Event. ";
        $aaudit->save();




        $payments->save();

        $data = array(
            'amount' => $events->amount
        );

        Mail::to(Auth::guard('user')->user()->email)->send(new PaymentMail($data));



        return redirect('user/myevents')->with('success', 'Event successfully registered.');
    }


    //mobile 

    public function m_login(Request $request){

        $data['user'] = \App\User::where('email',$request->email)
        ->where('password',Bcrypt($request->password))
        ->where('status','active')
        ->get();

        return response()->json($data);
        
    }

}
