@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update
            <small>Profile</small>
        </h1>
        <ol class="breadcrumb">

            <li><a href="{{url('/admin/profile')}}"><i class="fa fa-user"></i> Profile</a></li>
            <li class="active">Update</li>


        </ol>
    </section>




    <section class="content container-fluid">
        <div class="box">
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
            <div class="box-header">
                <h3 class="box-title"> </h3>

                <div class="container">

                    <div class="row">
                        <div class="panel-body">
                            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                                <img alt="User Pic" src="{{asset("/img/admindp/". Auth::guard('admin')->user()->profile_image)}}" id="profile-image1" class="img-circle img-responsive">
                                <form action="{{url('admin/doupdateprofile/'. $admins->id)}}" method='post'>
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="id" value="{{$admins->id}}" disabled>
                                    </div>
                                    <br>



                            </div>
                            <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                                <div class="container">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">First Name</label>
                                            <input type="text" class="form-control" name="fname" placeholder="Title" value="{{$admins->fname}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Last Name</label>
                                            <input type="text" class="form-control" name="lname" placeholder="Title" value="{{$admins->lname}}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <ul class="container details">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Contact</label>
                                            <input type="number" class="form-control" name="contact" placeholder="Title" value="{{$admins->contact}}">
                                        </div>
                                    </div>
                                    @if($admins->address == null)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address" value="{{old('address')}}">
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address" value="{{$admins->address}}">
                                        </div>
                                    </div>
                                    @endif

                                    @if($admins->birthday == null)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Birthday</label>
                                            <input type="date" class="form-control" name="birthday" placeholder="Title" value="{{old('birthday')}}">
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Birthday</label>
                                            <input type="date" class="form-control" name="birthday" placeholder="Title" value="{{$admins->birthday}}">
                                        </div>
                                    </div>

                                    @endif
                                    <div class="col-md-12">
                                        @if($admins->gender == 'male')
                                        <label> Gender </label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="male" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                                Male
                                            </label>
                                        </div>
                                        @else
                                        <label> Gender </label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="male">
                                            <label class="form-check-label" for="exampleRadios1">
                                                Male
                                            </label>
                                        </div>
                                        @endif

                                        @if($admins->gender != 'female')
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="female">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Female
                                            </label>
                                        </div>
                                        @else
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="female" checked>
                                            <label class="form-check-label" for="exampleRadios2">
                                                Female
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                </ul>
                                <hr>
                            </div>
                            <p align="right"> <button type="submit" class="btn btn-warning mb-2"><i class="fa fa-edit"></i> Update </button>
                                <a href="{{url('admin/profile')}}" type="button" class="btn btn-primary mb-2"><i class="fa fa-close"></i> Back </a>
                            </p>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </section>
</div>




@include('admin.admin_includes.footer')