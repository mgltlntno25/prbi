@include('affiliated_store.affstore_includes.header')
@include('affiliated_store.affstore_includes.header_navbar')
@include('affiliated_store.affstore_includes.sidebar')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Affiliated Store
            <small>Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>

        </ol>
    </section>


    <section class="content container-fluid">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                </h3>

                @if ($errors->any())
                <div class="alert alert-danger">
                    ERROR!
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

                <div class="container">
                    <p align="right"> <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#profile"><i class="fa fa-edit"></i> Update Profile </button>
                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#profile_image"><i class="fa fa-image"></i> Update Profile Image </button>
                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#password"><i class="fa fa-edit"></i> Update Password </button>

                    </p>
                    <div class="row">
                        <div class="panel-body">
                            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                                <img alt="User Pic" src="{{asset("/img/affiliateddp/". Auth::guard('affiliatedstore')->user()->image)}}" id="profile-image1" class="img-circle img-responsive">
                            </div>
                            <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                                <div class="container">
                                    <h2>{{Auth::guard('affiliatedstore')->user()->store_name}}</h2>
                                    <p>an <b> {{Str::upper(Auth::guard('affiliatedstore')->user()->role)}}</b></p>
                                </div>
                                <hr>
                                <ul class="container details">
                                    <li>
                                        <p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{Auth::guard('affiliatedstore')->user()->email}}</p>
                                    </li>
                                    <li>
                                        <p><span class="glyphicon glyphicon-phone one" style="width:50px;"></span>{{Auth::guard('affiliatedstore')->user()->contact}}</p>
                                    </li>

                                    <li>
                                        <p><span class="glyphicon glyphicon-home one" style="width:50px;"></span>{{Auth::guard('affiliatedstore')->user()->address}}</p>
                                    </li>

                                    <li>
                                        <p><span class="glyphicon glyphicon-check one" style="width:50px;"></span>{{Auth::guard('affiliatedstore')->user()->status}}</p>
                                    </li>
                                </ul>
                                <hr>
                                <div class="col-sm-5 col-xs-6 tital ">Date Of Joining: {{Auth::guard('affiliatedstore')->user()->created_at->format('m/d/Y')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</div>


<div class="modal fade" id="profile_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ url('affiliatedstore/doupdateprofileimage/') }}" method='post' enctype='multipart/form-data'>
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
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Profile Image</label>
                        <input type="file" class="form-control" name="image">
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
    <form action="{{ url('affiliatedstore/doupdatepassword')}}" method='post' enctype='multipart/form-data'>
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
                        <input type="hidden" class="form-control" name="id" value="{{Auth::guard('affiliatedstore')->user()->id}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">New Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Re-Type New Password</label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Re-type Password">
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

<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ url('affiliatedstore/doupdateprofile') }}" method='post' enctype='multipart/form-data'>
        {{csrf_field()}}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id" value="{{Auth::guard('affiliatedstore')->user()->id}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Store Name</label>
                        <input type="text" class="form-control" name="store_name" value="{{Auth::guard('affiliatedstore')->user()->store_name}}">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Store Owner</label>
                        <input type="text" class="form-control" name="store_owner" value="{{Auth::guard('affiliatedstore')->user()->store_owner}}">
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Address</label>
                        <input type="text" class="form-control" name="address" value="{{Auth::guard('affiliatedstore')->user()->address}}">
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Contact</label>
                        <input type="text" class="form-control" name="contact" value="{{Auth::guard('affiliatedstore')->user()->contact}}">
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
@include('affiliated_store.affstore_includes.footer')