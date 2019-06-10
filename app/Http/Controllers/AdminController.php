<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Banner;
use App\Announcement;
use App\Event;
use App\Payment;
use App\Donation;
use App\AffiliatedStore;
use App\User;
use Image;
use Validator;
use App\Notification;
use App\AdminAuditTrail;
use Illuminate\Support\Facades\Auth;
use App\Event_list;
use App\AdminLoginSession;
use App\FAQ;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Calendar;
use App\Sponsor;

// use PayPal\Api\Notification;

class AdminController extends Controller
{
    //
    


    public function AdminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        //attempt dologin
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $request->remember)) {

            $aaudit = new AdminLoginSession;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Logged in. ";
            $aaudit->save();
            return redirect('admin/dashboard');
        }

        //if fail
        return redirect()->back()->withErrors(['Credentials' => 'Worong credentials or the account is not activated.'])->withInput($request->all());
    }



    public function UpdateProfile(Request $request, $id)
    {

        $admins = \App\Admin::find($id);

        $validator = Validator::make($request->all(), [
            'fname' => 'required|max:255|regex:/^[\pL\s\s-]+$/u',
            'lname' => 'required|max:255|regex:/^[\pL\s\s-]+$/u',
            'contact' => 'required|numeric|digits:11',
            'gender' => 'required|max:255',
            'address' => 'required|max:255',
            'birthday' => 'required|date|before:18 years ago',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $admins->fname = $request->fname;
        $admins->lname = $request->lname;
        $admins->contact = $request->contact;
        $admins->gender = $request->gender;
        $admins->address = $request->address;
        $admins->birthday = $request->birthday;
        $admins->save();

        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Updated Profile. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Update successfully .');
    }

    public function UpdateProfileImage(Request $request, $id)
    {

        $admins = \App\Admin::find($id);

        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpeg,bmp,png,jpg',
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
            $location = public_path('img/admindp/' . $filename);
            //$thumbnail = public_path('img/admindp_thumb/' . $filename);
            Image::make($image)->resize(708, 693)->save($location);
            //Image::make($image)->resize(150, 50)->save($thumbnail);
        }

        $admins->profile_image = $filename;
        $admins->save();
        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Changed Profile Picture. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Update successfully .');
    }

    public function UpdatePassword(Request $request, $id)
    {

        $admins = \App\Admin::find($id);

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
        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Updated Password. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Update successfully .');
    }



    public function AddBanner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banner_image' => 'required|image|mimes:jpeg,bmp,png,jpg',
            'title' => 'required|max:255',
            'description' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/banners/' . $filename);
            $thumbnail = public_path('img/banners_thumb/' . $filename);
            Image::make($image)->save($location);
            Image::make($image)->resize(150, 50)->save($thumbnail);
        }

        $banners = new Banner;
        $banners->title = $request->title;
        $banners->description = $request->description;
        $banners->banner_image = $filename;
        $banners->save();

        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Added Banner. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Banner successfully added.');
    }

    public function ChangeStatusBanner($id)
    {
        $banners = Banner::find($id);

        if ($banners->status == 'active') {
            $banners->status = 'inactive';
            $banners->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Deactivated Banner. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Banner successfully deactivated.');
        }

        if ($banners->status == 'inactive') {
            $banners->status = 'active';
            $banners->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Activated Banner. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Banner successfully activated.');
        }
    }

    public function UpdateBanner(Request $request, $id)
    {
        $banners = Banner::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $banners->title = $request->title;
        $banners->description = $request->description;
        $banners->save();
        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Updated Banner. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Banner successfully updated.');
    }

    public function UpdateBannerImage(Request $request, $id)
    {

        $banners = Banner::find($id);

        $validator = Validator::make($request->all(), [
            'banner_image' => 'required|image|mimes:jpeg,bmp,png,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/banners/' . $filename);
            $thumbnail = public_path('img/banners_thumb/' . $filename);
            Image::make($image)->save($location);
            Image::make($image)->resize(150, 50)->save($thumbnail);
        }

        $banners->banner_image = $filename;
        $banners->save();
        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Updated Banner Image. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Banner Image successfully updated.');
    }


    public function AddSponsor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sponsor_image' => 'required|image|mimes:jpeg,bmp,png,jpg',
            'name' => 'required|max:255',
           

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('sponsor_image')) {
            $image = $request->file('sponsor_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/sponsor/' . $filename);
            // $thumbnail = public_path('img/banners_thumb/' . $filename);
            Image::make($image)->save($location);
            // Image::make($image)->resize(150, 50)->save($thumbnail);
        }

        $sponsor = new Sponsor;
        $sponsor->sponsor_name = $request->name;
        $sponsor->sponsor_image = $filename;
        $sponsor->status = 'inactive';
        $sponsor->save();

        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Added Sponsor. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Banner successfully added.');
    }

    public function ChangeStatusSponsor($id)
    {
        $banners = Banner::find($id);

        if ($banners->status == 'active') {
            $banners->status = 'inactive';
            $banners->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Deactivated Banner. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Banner successfully deactivated.');
        }

        if ($banners->status == 'inactive') {
            $banners->status = 'active';
            $banners->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Activated Banner. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Banner successfully activated.');
        }
    }

    public function UpdateSponsor(Request $request, $id)
    {
        $banners = Banner::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $banners->title = $request->title;
        $banners->description = $request->description;
        $banners->save();
        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Updated Banner. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Banner successfully updated.');
    }

    public function AddAnnouncements(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $announcements = new Announcement;
        $announcements->title = $request->title;
        $announcements->description = $request->description;

        $announcements->save();

        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Added Announcement. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Announcement successfully added.');
    }

    public function UpdateAnnouncements(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $summernote = \App\Announcement::find($id);

        $dom = new \DomDocument();
        $dom->loadHtml($request->description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $k => $img) {
            if (substr($img->getattribute('src'), 0, 4) != 'http') {
                $data = $img->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name =  time() . $k . '.png';
                $path = public_path('img/announcements/' . $image_name);
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $detail = $dom->saveHTML();
        $summernote->title = $request->title;
        $summernote->description = $request->description;
        $summernote->save();

        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Updated Announcement. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Announcements Updated successfully added.');
    }
    public function ChangeStatusAnnouncements($id)
    {
        $announcements = Announcement::find($id);

        if ($announcements->status == 'active') {
            $announcements->status = 'inactive';
            $announcements->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Deactived Announcement. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Announcement successfully deactivated.');
        }

        if ($announcements->status == 'inactive') {
            $announcements->status = 'active';
            $announcements->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Activated Announcement. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Announcement successfully activated.');
        }
    }


    public function AddEvents(Request $request)
    {
        $month =  Carbon::now()->addMonths(1)->format('m-d-Y');
        $validator = Validator::make($request->all(), [
            'event_image' => 'required|image|mimes:jpeg,bmp,png,jpg',
            'event_name' => 'required|max:255',
            'location' => 'required|max:255',
            'event_date' => 'required|date|after:' . $month . ',',
            'start_reg' => 'required|date|before:event_date|after:tomorrow',
            'end_reg' => 'required|date|after_or_equal:start_reg|before:event_date',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $events = new Event;


        if ($request->hasFile('event_image')) {
            $image = $request->file('event_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/events_banner/' . $filename);
            $thumbnail = public_path('img/events_thumb/' . $filename);
            Image::make($image)->save($location);
            Image::make($image)->resize(315, 200)->save($thumbnail);
        }
        $events->event_name = $request->event_name;
        $events->location = $request->location;
        $events->event_date = $request->event_date;
        $events->start_reg = $request->start_reg;
        $events->event_image = $filename;
        $events->end_reg = $request->end_reg;

        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Added Event. ";
        $aaudit->save();

        $events->save();

        return redirect()->back()->with('success', 'Event successfully added.');
    }

    public function UpdateEvent(Request $request, $id)
    {
        $events = \App\Event::find($id);

        $validator = Validator::make($request->all(), [
            'event_image' => 'required|image|mimes:jpeg,bmp,png,jpg',
            'event_name' => 'required|max:255',
            'location' => 'required|max:255',
            'event_date' => 'required|date',
            'start_reg' => 'required|date|before:event_date',
            'end_reg' => 'required|date|after_or_equal:start_reg|before:event_date',
            'description' => 'required',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }



        if ($request->hasFile('event_image')) {
            $image = $request->file('event_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/events_banner/' . $filename);
            $thumbnail = public_path('img/events_thumb/' . $filename);
            Image::make($image)->save($location);
            Image::make($image)->resize(315, 200)->save($thumbnail);
        }

        $dom = new \DomDocument();
        $dom->loadHtml($request->description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $k => $img) {
            if (substr($img->getattribute('src'), 0, 4) != 'http') {
                $data = $img->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name =  time() . $k . '.png';
                $path = public_path('img/announcements/' . $image_name);
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $detail = $dom->saveHTML();

        $events->event_name = $request->event_name;
        $events->location = $request->location;
        $events->event_date = $request->event_date;
        $events->start_reg = $request->start_reg;
        $events->event_image = $filename;
        $events->end_reg = $request->end_reg;
        $events->description = $request->description;
        $events->amount = $request->amount;
        $events->save();
        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Updated Event. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Event successfully added.');
    }


    public function ChangeStatusEvents($id)
    {
        $events = Event::find($id);

        if ($events->status == 'active') {
            $events->status = 'inactive';
            $events->save();


            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Deactivated Event. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Event successfully deactivated.');
        }

        if ($events->status == 'inactive') {
            $events->status = 'active';
            $events->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Activated Event. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Events successfully activated.');
        }
    }

    public function ExpireDateEvent()
    {
        $events = Event::all();

        foreach ($events as $event) {
            if ($event->end_reg < Carbon::today()) {
                Event::where('id', $event->id)->update(['status' => 'end of registation']);
            }
        }
    }


    public function ChangeStatusMember($id)
    {
        $members = User::find($id);

        if ($members->status == 'active') {
            $members->status = 'inactive';
            $members->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Deactivated Member. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Member successfully deactivated.');
        }

        if ($members->status == 'inactive') {
            $members->status = 'active';
            $members->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Activated Member. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Member successfully activated.');
        }
    }



    public function VerifyPayments($id)
    {
        $payments = Payment::find($id);
        $event = Event::find($payments->payment_description);
        if ($payments->status == 'submitted') {

            \App\Event_list::where('prbi_id', $payments->user_id)
                ->where('event_id', $payments->payment_description)
                ->update(['payment_status' => 'verified']);

            $payments->status = 'verified';
            $payments->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Verified Payment. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Payments successfully verified.');
        }
    }

    public function RejectPayments($id)
    {
        $payments = Payment::find($id);
        $event = Event::find($payments->payment_description);

        if ($payments->status == 'submitted') {

            \App\Event_list::where('prbi_id', $payments->user_id)
                ->where('event_id', $payments->payment_description)
                ->update(['payment_status' => 'rejected']);

            $payments->status = 'rejected';
            $payments->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Rejected Payment. ";
            $aaudit->save();

            return redirect()->back()->with('success', 'Payments successfully rejected.');
        }
    }

    public function VerifyApplication($id)
    {
        $application_list = \App\Application_List::find($id);
        $application_list->application_status = 'verified';
        $application_list->save();
        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Verified Application. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Application successfully verified.');
    }

    public function RejectApplication($id)
    {
        $application_list = \App\Application_List::find($id);
        $application_list->application_status = 'rejected';
        $application_list->save();
        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Rejected Application. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'Application successfully rejected.');
    }

    public function VerifyApplicationPayments($id)
    {
        $payments = Payment::find($id);
        if ($payments->status == 'submitted') {

            \App\Application_List::where('user_id', $payments->user_id)
                ->where('application_description', $payments->payment_description)
                ->update(['payment_status' => 'verified']);

            if ($payments->payment_description == 'premium') {

                \App\User::where('prbi_id', $payments->user_id)
                    ->update(['isPremium' => 1]);
            }

            if ($payments->payment_description == 'insured') {

                \App\User::where('prbi_id', $payments->user_id)
                    ->update(['isInsured' => 1, 'isPremium' => 1]);
            }


            $payments->status = 'verified';
            $payments->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Verified Application Payment. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Payments successfully verified.');
        }
    }

    public function RejectApplicationPayments($id)
    {
        $payments = Payment::find($id);

        if ($payments->status == 'submitted') {

            \App\Application_List::where('user_id', $payments->user_id)
                ->where('application_description', $payments->payment_description)
                ->update(['payment_status' => 'rejected']);

            $payments->status = 'rejected';
            $payments->save();

            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Reject Application Payment. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Payments successfully rejected.');
        }
    }

    public function VerifyEventRegister($id)
    {
        $event_list = Event_list::find($id);
        if ($event_list->reg_status == 'inactive') {
            $event_list->reg_status = 'verified';
            $event_list->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Verified Event Registration. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Registered successfully verified.');
        }
    }

    public function VerifyDonations($id)
    {
        $donations = Donation::find($id);
        if ($donations->status == 'inactive') {
            $donations->status = 'active';

            $donations->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Verified Donation. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Donation successfully verified.');
        }
    }
    public function RejectDonations($id)
    {
        $donations = Donation::find($id);

        if ($donations->status == 'inactive') {
            $donations->status = 'rejected';

            $donations->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Rejected Donation. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Donation successfully rejected.');
        }
    }

    public function CreateAffiliatedStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'store_name' => 'required|max:255|regex:/^[\pL\s\s-]+$/u',
            'store_owner' => 'required|max:255|regex:/^[\pL\s\s-]+$/u',
            'address' => 'required|max:255',
            'email' => 'required|email|unique:affiliated_stores,email',
            'contact' => 'required|numeric|digits:11',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $affiliatedstores = new AffiliatedStore;
        $affiliatedstores->store_name = $request->store_name;
        $affiliatedstores->store_owner = $request->store_owner;
        $affiliatedstores->address = $request->address;
        $affiliatedstores->email = $request->email;
        $affiliatedstores->contact = $request->contact;
        $affiliatedstores->password = Bcrypt('prbi123');
        $affiliatedstores->save();

        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Created Affiliated Store. ";
        $aaudit->save();
        return redirect()->back()->with('success', 'Affiliated Store successfully added.');
    }

    public function ChangeStatusAffiliatedStore($id)
    {
        $affiliatedstores = AffiliatedStore::find($id);

        if ($affiliatedstores->status == 'active') {
            $affiliatedstores->status = 'inactive';
            $affiliatedstores->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Deactivated Affiliated Store. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Admin successfully deactivated.');
        }

        if ($affiliatedstores->status == 'inactive') {
            $affiliatedstores->status = 'active';
            $affiliatedstores->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Activated Affiliated Store. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'Admin successfully activated.');
        }
    }


    public function CreateFAQs(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $faq = new FAQ;
        $faq->title = $request->title;
        $faq->description = $request->description;

        $faq->save();

        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Added FAQ. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'FAQ successfully added.');
    }

    public function ChangeStatusFAQ($id)
    {
        $faq = FAQ::find($id);

        if ($faq->status == 'active') {
            $faq->status = 'inactive';
            $faq->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Deactived FAQ. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'FAQ successfully deactivated.');
        }

        if ($faq->status == 'inactive') {
            $faq->status = 'active';
            $faq->save();
            $aaudit = new AdminAuditTrail;
            $aaudit->user_id = Auth::guard('admin')->user()->id;
            $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
            $aaudit->user_email = Auth::guard('admin')->user()->email;
            $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Activated FAQ. ";
            $aaudit->save();
            return redirect()->back()->with('success', 'FAQ successfully activated.');
        }
    }

    public function UpdateFAQs(Request $request, $id)
    {

        $faq = \App\FAQ::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dom = new \DomDocument();
        $dom->loadHtml($request->description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $k => $img) {
            if (substr($img->getattribute('src'), 0, 4) != 'http') {
                $data = $img->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name =  time() . $k . '.png';
                $path = public_path('img/faqs/' . $image_name);
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $detail = $dom->saveHTML();

        $faq->title = $request->title;
        $faq->description = $request->description;

        $faq->save();

        $aaudit = new AdminAuditTrail;
        $aaudit->user_id = Auth::guard('admin')->user()->id;
        $aaudit->user_name = Auth::guard('admin')->user()->fname . ' ' . Auth::guard('admin')->user()->lname;
        $aaudit->user_email = Auth::guard('admin')->user()->email;
        $aaudit->action = " Admin " . Auth::guard('admin')->user()->fname . " Updated FAQ. ";
        $aaudit->save();

        return redirect()->back()->with('success', 'FAQ successfully updated.');
    }

    // if($request->hasFile('image')){
    //     $image = $request->file('image');
    //     $filename = time() . '.' . $image->getClientOriginalExtension();
    //     $location = public_path('img/affiliateddp/' . $filename);
    //     $thumbnail = public_path('img/affiliateddp_thumb/' . $filename);
    //     Image::make($image)->save($location);
    //     Image::make($image)->resize(100,100)->save($thumbnail);

    //     $affiliatedstores->image = $filename;
    // }







}
