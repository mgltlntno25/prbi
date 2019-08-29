<?php
use Psy\Command\ListCommand\FunctionEnumerator;
use App\Http\Controllers\SysAdminController;
use App\Http\Controllers\AdminController;
use App\FAQ;
use App\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/timer/{id}', function ($id) {
    $data['events'] = \App\Event::find($id);
    return view('timer', $data);
});

Route::get('member/{id}', function ($id) {

    $data['user'] = \App\User::find($id);

    return view('search_user', $data);
});

Route::get('logout', function () {
    auth('admin')->logout();
    auth('user')->logout();
    auth('sysad')->logout();
    auth('affiliatedstore')->logout();

    return redirect('/');
})->name('logout');



//sysad group
Route::group(
    ['middleware' => ['auth:sysad']],
    function () {

        Route::get('sysad/dashboard', function () {

            function random_color_part1()
            {
                return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
            }

            function random_color1()
            {
                return random_color_part1() . random_color_part1() . random_color_part1();
            }


            $events = [];
            $data = App\Event::all();
            if ($data->count()) {
                foreach ($data as $key => $value) {
                    $events[] = Calendar::event(
                        $value->event_name,
                        true,
                        new \DateTime($value->start_reg),
                        new \DateTime($value->event_date . ' +1 day'),
                        null,
                        // Add color and link on event
                        [
                            'color' => "#" . random_color1(),

                        ]
                    );
                }
            }
            $data['calendar'] = Calendar::addEvents($events);



            $data['total_payment'] = App\Payment::where('status', 'verified')->sum('payment_amount');
            // $data['total_donations'] = App\Payment::where('status','verified')->sum('payment_amount');
            $now = Carbon::now();

            $data['active_users'] = App\User::where('status', 'active')->count();
            $data['active_events'] = App\Event::where('status', 'active')->count();
            $data['total_donations'] = App\Donation::where('status', 'verified')->sum('amount');

            $data['d_regular'] = App\User::where('status', 'active')
                ->where('isPremium', 0)
                ->count();

            $data['d_premium'] = App\User::where('status', 'active')
                ->where('isPremium', 1)->where('isInsured', 0)
                ->count();

            $data['d_insured'] = App\User::where('status', 'active')
                ->where('isPremium', 1)->where('isInsured', 1)
                ->count();
            $data['admin'] = App\Admin::where('status', 'active')
                ->count();

            return view('system_admin/sysad_dashboard', $data);
        });

        Route::get('sysad/adminaccMain', function () {
            $data['admins'] = \App\Admin::all();
            $data['total_admins'] = Admin::all()->count();
            $data['active_admins'] = Admin::where('status', 'active')->count();
            return view('system_admin/admin_accountsMain', $data);
        });
        //sys admin functions
        Route::post('sysad/doaddadmin', 'SysAdminController@CreateAdmin');
        Route::get('sysad/dochangestatus/{id}', 'SysAdminController@ChangeStatus');

        Route::get('sysad/audLogin', function () {
            $data['admin_auds'] = \App\AdminLoginSession::all();
            return view('system_admin/aud_login', $data);
        });
        Route::get('sysad/audAct', function () {
            $data['admin_auds'] = \App\AdminAuditTrail::all();
            return view('system_admin/aud_activities', $data);
        });
    }
);



//admin group
Route::group(
    ['middleware' => ['auth:admin']],
    function () {


        Route::get('/error', function () {
            return view('admin/admin_error');
        });


        Route::get('/adminsss', function () {
            return Auth::guard('admin')->user()->email;
        });
        //admin routes
        Route::get('admin/profile', function () {
            return view('admin/admin_profile');
        });

        Route::get('admin/profile/{id}', function () {
            $data['admins'] = \App\Admin::find(Auth::guard('admin')->user()->id);
            return view('admin/updateProfile', $data);
        });
        Route::post('admin/doupdateprofile/{id}', 'AdminController@UpdateProfile');
        Route::post('admin/doupdateprofileimage/{id}', 'AdminController@UpdateProfileImage');
        Route::post('admin/doupdatepassword/{id}', 'AdminController@UpdatePassword');

        Route::get('admin/pass/{id}', function () {
            return view('admin/updatePass');
        });


        Route::get('admin/dashboard', function () {




            function random_color_part()
            {
                return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
            }

            function random_color()
            {
                return random_color_part() . random_color_part() . random_color_part();
            }


            $events = [];
            $data = App\Event::all();
            if ($data->count()) {
                foreach ($data as $key => $value) {
                    $events[] = Calendar::event(
                        $value->event_name,
                        true,
                        new \DateTime($value->start_reg),
                        new \DateTime($value->event_date . ' +1 day'),
                        null,
                        // Add color and link on event
                        [
                            'color' => "#" . random_color(),

                        ]
                    );
                }
            }
            $data['calendar'] = Calendar::addEvents($events);


            $data['total_payment'] = App\Payment::where('status', 'verified')->sum('payment_amount');
            // $data['total_donations'] = App\Payment::where('status','verified')->sum('payment_amount');
            $now = Carbon::now();

            $data['active_users'] = App\User::where('status', 'active')->count();
            $data['active_events'] = App\Event::where('status', 'active')->count();
            $data['total_donations'] = App\Donation::where('status', 'verified')->sum('amount');


            $data['d_regular'] = App\User::where('status', 'active')
                ->where('isPremium', 0)
                ->count();

            $data['d_premium'] = App\User::where('status', 'active')
                ->where('isPremium', 1)->where('isInsured', 0)
                ->count();

            $data['d_insured'] = App\User::where('status', 'active')
                ->where('isPremium', 1)->where('isInsured', 1)
                ->count();


            return view('admin/admin_dashboard', $data);
        });




        //banners
        Route::get('admin/banners', function () {
            $data['banners'] = \App\Banner::all();
            return view('admin/bannersMain', $data);
        });
        Route::post('admin/doaddbanner', 'AdminController@AddBanner');
        Route::get('admin/dochangestatusbanner/{id}', 'AdminController@ChangeStatusBanner');
        Route::get('admin/banners/{id}', function ($id) {
            $data['banners'] = \App\Banner::find($id);

            if (!\App\Banner::where('id', '=', $id)->exists()) {
                return view('admin/admin_error');
            }
            return view('admin/bannersUpdate', $data);
        });
        Route::post('admin/doupdatebanner/{id}', 'AdminController@UpdateBanner');
        Route::post('admin/doupdatebannerimage/{id}', 'AdminController@UpdateBannerImage');

        //announcements
        Route::get('admin/announcements', function () {
            $data['announcements'] = \App\Announcement::all();
            return view('admin/announcementsMain', $data);
        });
        Route::post('admin/doaddannouncements', 'AdminController@AddAnnouncements');
        Route::get('admin/dochangestatusannouncement/{id}', 'AdminController@ChangeStatusAnnouncements');

        Route::get('admin/announcements/{id}', function ($id) {
            $data['announcements'] = \App\Announcement::find($id);
            if (!App\Announcement::where('id', '=', $id)->exists()) {

                return view('admin/admin_error');
            }
            return view('admin/announcementsUpdate', $data);
        });

        Route::post('admin/doupdateannouncements/{id}', 'AdminController@UpdateAnnouncements');


        //events
        Route::get('admin/events', function () {
            $event = \App\Event::select(
                'events.event_name',
                'event_lists.event_name as list_name'
            )->join('event_lists', 'events.id', 'event_lists.id')->get();


            $data['events'] = \App\Event::all();
            $data['events_list'] = \App\Event_list::all();
            return view('admin/eventsMain', $data);
        });

        Route::get('admin/view_event/{id}', function ($id) {

            $data['events'] = App\Event::find($id);
            return view('admin/event_view', $data);
        });

        Route::post('admin/doaddevent', 'AdminController@AddEvents');
        Route::get('admin/dochangestatusevent/{id}', 'AdminController@ChangeStatusEvents');
        Route::post('admin/doupdateeventsimage/{id}', 'AdminController@UpdateEventsImage');
        Route::get('admin/events/{id}', function ($id) {
            $data['events'] = \App\Event::find($id);

            if (!App\Event::where('id', '=', $id)->exists()) {
                return view('admin/admin_error');
            }
            return view('admin/eventsUpdate', $data);
        });
        Route::post('admin/doupdateevents/{id}', 'AdminController@UpdateEvent');

        //registered_event_list
        Route::get('admin/events/events_lists/{id}', function ($id) {
            $data['events'] = \App\Event_list::where('event_id', '=', $id)->get();
            $data['ev_count'] = \App\Event_list::where('event_id', '=', $id)->count();
            $data['pay_count'] = \App\Event_list::where('event_id', '=', $id)
                ->where('payment_status', 'verified')->count();
            $data['ver_reg'] = \App\Event_list::where('event_id', '=', $id)
                ->where('reg_status', 'verified')->count();
            $data['total'] = \App\Payment::where('payment_description', '=', $id)
                ->where('status', 'verified')->sum('payment_amount');

            if (!\App\Event_list::where('event_id', '=', $id)->exists()) {
                return view('admin/admin_error');
            }



            return view('admin/event_list', $data);
        });
        Route::get('admin/doverifyeventregistration/{id}', 'AdminController@VerifyEventRegister');

        //startlist
        Route::get('admin/start_list/{id}', function ($id) {
            $data['events'] = \App\Event::find($id);

            $data['events_list'] = \App\Event_list::where('event_id', $id)
                ->where('reg_status', 'verified')->get();

            return view('admin/start_list', $data);
        });



        //Regular Members
        Route::get('admin/regular_members', function () {
            $data['members'] = \App\User::where('isPremium', '=', '0')->get();
            return view('admin/r_membersMain', $data);
        });
        Route::get('admin/dochangestatusmember/{id}', 'AdminController@ChangeStatusMember');


        Route::get('admin/application_list', function () {

            $data['application_lists'] = \App\Application_List::all();

            return view('admin/application_list', $data);
        });

        Route::get('admin/doverifyapplication/{id}', 'AdminController@VerifyApplication');
        Route::get('admin/dorejectapplication/{id}', 'AdminController@RejectApplication');

        //Premium Members
        Route::get('admin/premium_members', function () {
            $data['members'] = \App\User::where('isPremium', '=', '1')->where('isInsured', '=', '0')->get();


            return view('admin/p_membersMain', $data);
        });
        Route::get('admin/premium_members/{id}', function ($id) {
            $data['member'] = \App\User::find($id);

            if (!App\User::where('id', '=', $id)->exists()) {
                return view('admin/admin_error');
            }

            return view('admin/p_membersView', $data);
        });
        Route::get('admin/p_card/{id}', function ($id) {
            $data['member'] = \App\User::find($id);


            if (!App\User::where('id', '=', $id)->exists()) {
                return view('admin/admin_error');
            }
            return view('admin/p_card', $data);
        });


        //insured Members
        Route::get('admin/insured_members', function () {
            $data['members'] = \App\User::where('isPremium', '=', '1')->where('isInsured', '=', '1')->get();
            return view('admin/i_membersMain', $data);
        });
        Route::get('admin/insured_members/{id}', function ($id) {
            $data['member'] = \App\User::find($id);

            if (!App\User::where('id', '=', $id)->exists()) {
                return view('admin/admin_error');
            }

            return view('admin/i_membersView', $data);
        });
        Route::get('admin/i_card/{id}', function ($id) {
            $data['member'] = \App\User::find($id);

            if (!App\User::where('id', '=', $id)->exists()) {
                return view('admin/admin_error');
            }

            return view('admin/i_card', $data);
        });




        //payments
        Route::get('admin/payments', function () {
            $data['payments'] = \App\Payment::all();
            return view('admin/paymentsMain', $data);
        });
        Route::get('admin/doverifypayment/{id}', 'AdminController@VerifyPayments');
        Route::get('admin/dorejectpayment/{id}', 'AdminController@RejectPayments');
        Route::get('admin/doverifyapplicationpayment/{id}', 'AdminController@VerifyApplicationPayments');
        Route::get('admin/dorejectapplicationpayment/{id}', 'AdminController@RejectApplicationPayments');


        //donation
        Route::get('admin/donations', function () {
            $data['donations'] = \App\Donation::all();
            return view('admin/donationMain', $data);
        });
        Route::get('admin/doverifydonation/{id}', 'AdminController@VerifyDonations');
        Route::get('admin/dorejectdonation/{id}', 'AdminController@RejectDonations');


        //incidentreports
        Route::get('admin/incidents', function () {
            $data['ireports'] = \App\IncidentReport::all();
            return view('admin/incidentsMain', $data);
        });

        Route::get('admin/incidents/dochangestatusreport/{id}', 'AdminController@ChangeStatusIncidentReport');

        Route::get('admin/report/{id}', function ($id) {

            $data['ireports'] = \App\IncidentReport::find($id);
            if (!App\IncidentReport::where('id', '=', $id)->exists()) {
                return view('admin/admin_error');
            }else
            return view('admin/incidentsView', $data);
        });

        Route::get('admin/report/doreject/{id}', 'AdminController@RejectReport');
        Route::get('admin/report/doverify/{id}', 'AdminController@VerifyReport');
    


        //affiliated store
        Route::get('admin/affiliatedstore', function () {
            $data['affiliatedstores'] = \App\AffiliatedStore::all();
            return view('admin/affiliatedMain', $data);
        });
        Route::post('admin/doaddaffiliatedstore', 'AdminController@CreateAffiliatedStore');
        Route::get('admin/dochangestatusaffiliatedstore/{id}', 'AdminController@ChangeStatusAffiliatedStore');

        Route::get('admin/faqs', function () {
            $data['faqs'] = App\FAQ::all();
            return view('admin/faqs_main', $data);
        });
        Route::post('admin/doaddfaq', 'AdminController@CreateFAQs');
        Route::get('admin/dochangestatusfaq/{id}', 'AdminController@ChangeStatusFAQ');

        Route::get('admin/faqs/{id}', function ($id) {
            $data['faqs'] = App\FAQ::find($id);
            if (!App\FAQ::where('id', '=', $id)->exists()) {
                return view('admin/admin_error');
            }
            return view('admin/faqs_update', $data);
        });
        Route::post('admin/doupdatefaq/{id}', 'AdminController@UpdateFAQs');


        Route::get('admin/user_audit', function () {
            $data['admin_auds'] = App\User_AuditTrail::all();
            return view('admin/user_aud', $data);
        });

        Route::get('admin/user_login', function () {
            $data['admin_auds'] = App\UserLoginSession::all();
            return view('admin/user_log', $data);
        });

        Route::get('admin/sponsors', function () {

            $data['sponsors'] = App\Sponsor::all();
            return view('admin/sponsor', $data);
        });

        route::post('admin/doaddsponsor', 'AdminController@AddSponsor');
        Route::get('admin/sponsors/{id}', function ($id) {
            $data['sponsors'] = App\Sponsor::find($id);
            return view('admin/update_sponsor', $data);
        });

        Route::get('admin/dochangestatussponsor/{id}', 'AdminController@ChangeStatusSponsor');
        Route::post('admin/doupdatesponsorimage/{id}', 'AdminController@UpdateSponsorImage');
        Route::post('admin/doupdatesponsor/{id}', 'AdminController@UpdateSponsor');


        
    }
);


//user group
Route::group(
    ['middleware' => ['auth:user']],
    function () {

        Route::get('/usersss', function () {

            $data['auth'] = Auth::guard('user')->user();

            return $data;
        });



        Route::get('user/profile', function () {
            $data['application_list'] = App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->first();

            if (!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->exists()) {

                return view('user/user_profile');
            }
            return view('user/user_profile', $data);
        });


        Route::post('user/doupgrade/step1', 'UserController@upgrade_1');

        Route::get('user/upgrade/step2', function () {
            $data['application_list'] = App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->first();
            return view('user/valid_id', $data);
        });
        Route::post('user/doupgrade/step2', 'UserController@upgrade_2');

        Route::get('user/upgrade/step3', function () {
            $data['application_list'] = App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->first();
            return view('user/verifyupgrade', $data);
        });
        Route::post('user/doupdatevalididstep3', 'UserController@updateValidIdstep3');
        Route::get('user/dosubmitapplication', 'UserController@SubmitApplication');


        Route::get('user/myapplication', function () {
            $data['application_lists'] = \App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->get();
            return view('user/myapplication', $data);
        });

        Route::get('user/application_paymentmethod', function () {
            return view('user/modepayment_application');
        });

        Route::get('user/application_bank', function () {
            return view('user/bank_application');
        });

        Route::post('user/doapplicationbank', 'UserController@ApplicationBank');




        Route::get('user/profile/{id}', function () {
            $data['user'] = \App\Admin::find(Auth::guard('user')->user()->id);
            return view('user/update_profile', $data);
        });
        Route::post('user/doupdateprofile/{id}', 'UserController@UpdateProfile');
        Route::post('user/doupdateprofileimage/{id}', 'UserController@UpdateProfileImage');
        Route::post('user/doupdatepassword/{id}', 'UserController@UpdatePassword');



        Route::post('user/dobankdeposit/{id}', 'UserController@BankDeposit');

        Route::get('user/events', function () {
            $data['events'] = \App\Event::all();
            $data['past_events'] = \App\Event::where('status', '=', 'done')->get();
            return view('user/user_events', $data);
        });

        //user register to event
        Route::get('user/event/registration', 'UserController@registerEvent');


        Route::get('user/events/viewevent/{id}', function ($id) {

            $data['events'] = \App\Event::find($id);
            return view('user/user_viewevents', $data);
        });

        //doregistration
        Route::post('user/doeventregistration/{id}', 'UserController@EventRegistration');

        //myeventlist
        Route::get('user/myevents', function () {
            $data['event_lists'] = \App\Event_list::where('prbi_id', '=', Auth::guard('user')->user()->prbi_id)->get();
            return view('user/user_myevents', $data);
        });


        Route::get('user/i_card/', function () {
            return view('user/i_card');
        });
        Route::get('user/p_card/', function () {
            return view('user/p_card');
        });



        Route::get('user/modepayment/{id}', function ($id) {
            $data['events'] = \App\Event::find($id);
            return view('user/user_modepayment', $data);
        });

        Route::get('user/paypal/{id}', function ($id) {
            $data['events'] = \App\Event::find($id);
            return view('user/user_paypalpayment', $data);
        });

        Route::get('user/dopaypal/{id}', 'UserController@Paypal');
        Route::get('user/dopaypal', 'UserController@PayPal_application');




        Route::get('user/bankdeposit/{id}', function ($id) {
            $data['events'] = \App\Event::find($id);
            return view('user/bank_deposit', $data);
        });

        Route::post('user/dobankdeposit/{id}', 'UserController@BankDeposit');

        Route::get('user/application_paypal/', function () {
            if (!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
                ->where('application_status', '=', 'submitted')->where('application_description', 'insured')->first()) { }
            return view('user/modepayment_paypal');
        });



        //announcements:

        Route::get('user/announcements', function () {
            $data['announcements'] = \App\Announcement::all();
            return view('user/user_announcements', $data);
        });





        //donation routes
        Route::get('user/donations', function () {
            $data['donations'] = \App\Donation::where('prbi_id', '=',  Auth::guard('user')->user()->prbi_id)->get();
            return view('user/user_mydonations', $data);
        });
        Route::post('user/doadddonation', 'UserController@UploadDonation');

        //Payment routes
        // Route::get('/payment', 'Payments@payWithpaypal')->name('payment');
        // Route::get('/status/upgrade/{key}', 'Payments@getPaymentStatusUpgrade');
        // Route::get('/status/event/{key}', 'Payments@getPaymentStatusEvent');
    }

);



//affiliatedstoregroup
Route::group(
    ['middleware' => ['auth:affiliatedstore']],
    function () {


        Route::any('affiliatedstore/search', function (Request $request) {
            $q = $request->q;
            $user = App\User::where('prbi_id', '=', $q)->get();
            if (count($user) > 0)
                return view('affiliated_store/search')->withDetails($user)->withQuery($q);
            else
                return view('affiliated_store/search')->withMessage('No Details found. Try to search again !');
        });
        //affiliated store route
        Route::get('affiliatedstore', function () {
            return view('affiliated_store/search');
        });
        Route::get('affiliatedstore/search/{id}', function ($id) {
            $data['users'] = \App\User::find($id);
            return view('affiliated_store/findmember', $data);
        });

        Route::get('affiliatedstore/profile', function () {

            return view('affiliated_store/profile');
        });

        Route::post('affiliatedstore/doupdateprofile/', 'AffiliatedStoreController@UpdateProfile');
        Route::post('affiliatedstore/doupdateprofileimage/', 'AffiliatedStoreController@UpdateProfileImage');
        Route::post('affiliatedstore/doupdatepassword/', 'AffiliatedStoreController@UpdatePassword');
    }
);




Route::group(
    ['middleware' => ['guest']],
    function () {
        Route::get('/', function () {
            $data['admins'] = \App\Admin::where('status', '=', 'active')->where('email', '!=', 'test@gmail.com')->get();
            $data['users_count'] = \App\User::where('status', '=', 'active')->count();
            $data['events_count'] = \App\Event::where('status', '=', 'active')->count();
            $data['afs_count'] = \App\AffiliatedStore::where('status', '=', 'active')->count();
            $data['faqs'] = \App\FAQ::where('status', '=', 'active')->get();
            $data['sponsors'] = \App\Sponsor::where('status', '=', 'active')->get();
            $data['events'] = \App\Event::all();
            return view('welcome', $data);
        });

        Route::get('admin/login', function () {
            return view('admin_login');
        });

        Route::get('user/login', function () {
            return view('member_login');
        })->name('login');

        Route::get('sysad/login', function () {
            return view('sysad_login');
        });
        Route::get('affiliatedstore/login', function () {
            return view('affiliated_login');
        });

        //user
        Route::get('/registration', function () {
            return view('user_registration');
        });
        Route::post('user/doregister', 'UserController@AccountRegistration');
        Route::post('admin/dologin', 'AdminController@AdminLogin');
        Route::post('user/dologin', 'UserController@UserLogin');
        Route::post('sysad/dologin', 'SysAdminController@SysAdLogin');
        Route::post('affiliatedstore/dologin', 'AffiliatedStoreController@ASlogin');

        Route::post('user/emailVerify','UserController@AccountVerifiy');

    }
);

Route::get('/map',function(){
    return view('admin/map');
});

// mobile routes

//user

Route::prefix('api')->group(
    function () {
        route::post('/login', 'APIController@login');

        route::post('/profile', 'APIController@profile');

        route::post('/update/profile', 'APIController@update');

        Route::get('/events', function () {
            $data['events'] = \App\Event::where('status','active')->get();
            return response()->json($data);
        });

        Route::get('/reports', function () {
            $data['reports'] = \App\IncidentReport::where('status','verified')->get();
            return response()->json($data);
        });

        route::post('/reports/doreport','APIController@report_incident');
        route::post('/donation/dodonate','APIController@doDonate');
        route::post('/events/register','APIController@doRegisterEvent');
        route::post('/events/myevents','APIController@myEvents');
        route::post('/donation/mydonations', 'APIController@myDonations');
        
        Route::post("events/myevents/id", 'APIController@eventFind');
        


        Route::get('/paypal/{id}', function ($id) {
            $data['events'] = \App\Event::find($id);
            return view('user/mobile_paypal', $data);
        });

        // Route::get('user/dopaypal/{id}', 'UserController@Paypal');

        Route::post("/payments/dobank/{id}", 'APIController@payment_bank');


        
            
    }
    
);
