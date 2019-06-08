@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            user
            <small>Profile</small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>

        </ol>
    </section>



    <section class="content">

        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif

            <div class="col-md-4">
                <div class="box box-passive">
                    <div class="box-header with-border">
                        <h3 class="box-title">Personal Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">First Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ Auth::guard('user')->user()->first_name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Last Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ Auth::guard('user')->user()->last_name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Contact</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-mobile"></i>
                                    </div>
                                    <input type="number" class="form-control" name="contact" placeholder="Contact" value="{{  Auth::guard('user')->user()->contact }}"disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Address</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-bed"></i>
                                    </div>
                                    <input type="text" class="form-control" name="address" placeholder="Address" value="{{  Auth::guard('user')->user()->address }}"disabled>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                </div>



            </div>

            <div class="col-md-4">

                <div class="box box-passive">
                    <div class="box-header with-border">
                        <h3 class="box-title">Login Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Email</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{  Auth::guard('user')->user()->email }}"disabled>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <div class="box box-passive">
                    <div class="box-header with-border">
                        <h3 class="box-title">Valid ID</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">View Valid ID</label>
                            <div class="input-group">
                                <button type="button" data-toggle="modal" data-target="#view" class="btn btn-primary"> <i class="fa fa-eye"></i> View
                                </button> &nbsp;
                                <button type="button" data-toggle="modal" data-target="#update" class="btn btn-warning"> <i class="fa fa-edit"></i> Edit
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <div class="col-md-4">

                <div class="box box-passive">
                    <div class="box-header with-border">
                        <h3 class="box-title">Other Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Birthday</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control" name="birthday" placeholder="Birthday" value="{{  Auth::guard('user')->user()->birthday }}" disabled>
                            </div>
                        </div>
                        <label> Gender </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="male" checked disabled>
                            <label class="form-check-label" for="exampleRadios1">
                                Male
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="female" disabled>
                            <label class="form-check-label" for="exampleRadios2">
                                Female
                            </label>
                        </div>
                        <br>


                        <div class="form-group">
                            <label for="sel1">Blood Type</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-heartbeat"></i>
                                </div>
                                <select class="form-control" id="sel1" name="bloodtype" value="{{  Auth::guard('user')->user()->blood_type }}" disabled>
                            <option value=" N/A">N/A </option> <option value="AB-">AB-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>

                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <br>
                        <br>

                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-md-8">

                <div class="box box-passive">
                    <div class="box-header with-border">
                        <h3 class="box-title">Emergency Contact Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Emergency Contact Person</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input type="text" class="form-control" name="emergency_name" placeholder="Emergency Contact Person" value="{{  Auth::guard('user')->user()->emergency_name }} "disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Emergency Contact Number</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-mobile"></i>
                                </div>
                                <input type="number" class="form-control" name="emergency_contact" placeholder="Emergency Contact Number" value="{{  Auth::guard('user')->user()->emergency_contact }}"disabled>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Proceed</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <button type="button" onclick="window.location='{{url("user/dosubmitapplication")}}'" class="btn btn-block btn-success btn-lg"> Proceed </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Valid ID</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="formGroupExampleInput"></label>
                    <img src="{{ url("/img/user_validid/". $application_list->valid_id) }}" height="250" width="570">
                </div>
            </div>
            <div class="modal-footer">
                <p align="right">
                    <button type="button" class="btn btn-primary mb-2" data-dismiss="modal"><i class="fa fa-close"></i>
                        Back
                    </button>
                </p>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Valid ID</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="formGroupExampleInput"></label>
                    <img src="{{ url("/img/user_validid/". $application_list->valid_id) }}" height="250" width="570">
                </div>
                <form action="{{url('user/doupdatevalididstep3')}}" method="post" enctype='multipart/form-data'>
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Upload a valid ID</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-image"></i>
                                </div>
                                <input type="file" class="form-control" name="valid_id" placeholder="First Name">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <p align="right">
                            <button type="submit" class="btn btn-success mb-2"><i class="fa fa-upload"></i> Upload ID </button>
                            <button type="button" class="btn btn-primary mb-2" data-dismiss="modal"><i class="fa fa-close"></i>
                                Back
                            </button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>






@include('user.user_includes.footer')