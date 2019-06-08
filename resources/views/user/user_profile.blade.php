@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            My
            <small>Profile</small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>

        </ol>
    </section>


    <section class="content container-fluid">
        <div class="box">
            <div class="box-header">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h3 class="box-title"> </h3>

                <div class="container">
                    <p align="right">
                        @if(!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->exists())
                        <button type="button" data-toggle="modal" data-target="#upgrade" class="btn btn-success mb-2"><i class="fa fa-user-plus"></i> Upgrade Profile </button>
                        @endif
                        @if(App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->where('application_status', '=','rejected')->first())
                        <button type="button" data-toggle="modal" data-target="#upgrade" class="btn btn-success mb-2"><i class="fa fa-user-plus"></i> Upgrade Profile </button>
                        @endif

                        @if(App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)->where('application_status', '=','submitted')->first())
                        <button type="button"  onclick="window.location='{{url("user/myapplication")}}'" class="btn btn-primary mb-2"><i class="fa fa-user-eye"></i> View Application </button>
                        @endif

                       
                        


                        <button type="button" data-toggle="modal" data-target="#profile_image" class="btn btn-warning mb-2"><i class="fa fa-edit"></i> Change Profile Image </button>
                        <button type="button" onclick="window.location='{{url("user/profile/" . Auth::guard('user')->user()->id)}}'" class="btn btn-warning mb-2"><i class="fa fa-edit"></i> Update Profile</button>
                        <button type="button" data-toggle="modal" data-target="#password" class="btn btn-warning mb-2"><i class="fa fa-edit"></i> Update Password</button>

                    </p>
                    <div class="row">
                        <div class="panel-body">
                            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                                <img alt="User Pic" src="{{asset("/img/userdp/". Auth::guard('user')->user()->profile_image)}}" id="profile-image1" class="img-circle img-responsive">
                                <br>
                                <br>
                                @if(Auth::guard('user')->user()->isPremium == 1 && Auth::guard('user')->user()->isInsured == 0)
                                <a href="{{url('user/p_card')}}" target="_blank" type="button" class="btn btn-primary mb-2"><i class="fa fa-user" target="_blank"> </i> View Membership Card</a>
                                @endif
                                @if(Auth::guard('user')->user()->isPremium == 1 && Auth::guard('user')->user()->isInsured == 1)
                                <a href="{{url('user/i_card')}}" target="_blank" type="button" class="btn btn-warning mb-2"><i class="fa fa-user" target="_blank"> </i> View Membership Card</a>
                                @endif

                            </div>
                            <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                                <div class="container">
                                    <h2>{{Auth::guard('user')->user()->first_name}} {{Auth::guard('user')->user()->last_name}}</h2>
                                    <p>an <b> {{Str::upper(Auth::guard('user')->user()->role)}}</b></p>
                                </div>
                                <hr>
                                <ul class="container details">
                                    <li>
                                        <p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{Auth::guard('user')->user()->email}}</p>
                                    </li>
                                    <li>
                                        <p><span class="glyphicon glyphicon-phone one" style="width:50px;"></span>{{Auth::guard('user')->user()->contact}}</p>
                                    </li>
                                    @if(Auth::guard('user')->user()->address != '')
                                    <li>
                                        <p><span class="glyphicon glyphicon-home one" style="width:50px;"></span>{{Auth::guard('user')->user()->address}}</p>
                                    </li>
                                    @endif
                                    @if(Auth::guard('user')->user()->gender != '')
                                    <li>
                                        <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>{{Auth::guard('user')->user()->gender}}</p>
                                    </li>
                                    @endif
                                    @if(Auth::guard('user')->user()->birthday != '')
                                    <li>
                                        <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>{{Auth::guard('user')->user()->birthday}}</p>
                                    </li>
                                    @endif
                                    <li>
                                        <p><span class="glyphicon glyphicon-check one" style="width:50px;"></span>{{Auth::guard('user')->user()->status}}</p>
                                    </li>
                                </ul>
                                <hr>
                                <div class="col-sm-5 col-xs-6 tital ">Date Of Joining: {{Auth::guard('user')->user()->created_at->format('m/d/Y')}}</div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </section>
    <!-- Modal -->
    <div class="modal fade" id="profile_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{ url('user/doupdateprofileimage/'. Auth::guard('user')->user()->id ) }}" method='post' enctype='multipart/form-data'>
            {{csrf_field()}}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Profile Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" value="{{Auth::guard('user')->user()->id}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Profile Image</label>
                            <input type="file" class="form-control" name="profile_image">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update
                        </button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{ url('user/doupdatepassword/'. Auth::guard('user')->user()->id ) }}" method='post' enctype='multipart/form-data'>
            {{csrf_field()}}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" value="{{Auth::guard('user')->user()->id}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">New Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput">Re-Type New Password</label>
                            <input type="password" class="form-control" name="password1">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update
                        </button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="upgrade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upgrade Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <form action="{{url('user/doupgrade/step1')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-check">
                            <div class="col-md-6">
                                <p>
                                    <h2><input class="form-check-input" type="radio" name="application_description" id="exampleRadios1" value="premium" checked> Upgrade Premium! </h2>
                                    Enjoy 10% discounts on all of our affiliated stores.
                                    <br><b>Amount: </b> 220.00 PHP


                                </p>
                            </div>
                            <div class="col-md-6">
                                <p align=" right">
                                    <img src="{{asset("/img/prbi_card/sample1.png")}}" height="160" width="250">
                                </p>
                            </div>

                        </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="form-check">

                        <div class="col-md-6">
                            <p>
                                <h2> <input class="form-check-input" type="radio" name="application_description" id="exampleRadios2" value="insured">
                                    Be Insured! </h2>
                                <ul>
                                    <li>
                                        60,000 pesos for accidental death dismemberment</li>
                                    <li>12,500 reimbursements for hospitalization expenses</li>
                                    <li>5000 pesos for burial assistance.</li>
                                    <li>Enjoy 10% discount on all of our affiliated store!</li>
                                </ul>

                                <b>Amount: </b> 500.00 PHP
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p align=" right">
                                <img src="{{asset("homepage/images/membership2.png")}}" height="160" width="250">
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Upgrade!
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close
                </button>

            </div>
        </div>
    </div>
    </form>
</div>


@include('user.user_includes.footer')