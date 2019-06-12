@include('system_admin.sysAd_includes.header')
@include('system_admin.sysAd_includes.header_navbar')
@include('system_admin.sysAd_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admin
            <small>Accounts</small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="{{url('sysad/adminaccMain')}}"><i class="fa fa-users"></i> Admin Accounts</a></li>
            <li class="active">Here</li>
        </ol>

    </section>



    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->


        <!-- Info boxes -->

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Admins</span>
                        <span class="info-box-number">{{$total_admins}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Active Admins</span>
                        <span class="info-box-number">{{$active_admins}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
        </div>

        <div class="box">

            <div class="box-header">
                <h3 class="box-title"></h3>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td><img src="{{ url("/img/admindp/". $admin->profile_image) }}" width="80" height="80"></td>
                            <td>{{ $admin->fname }}</td>
                            <td>{{ $admin->lname }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->contact }}</td>
                            <td>{{ $admin->status }}</td>
                            <td>
                                <button type="button" class="btn btn-info" data-placement="top" title="View Admin" data-toggle="modal" data-target="#view-modal{{$admin->id}}"><i class="fa fa-eye"></i></button>
                                @if($admin->status == 'active')
                                <button type="button" class="btn btn-danger" data-placement="top" title="Deactivate Admin" data-toggle="modal" data-target="#statusModal{{ $admin->id }}"><i class="fa fa-close"></i>
                                </button>
                                @elseif($admin->status == 'inactive')
                                <button type="button" class="btn btn-success" data-toggle="modal" data-toggle="tooltip" data-placement="top" title="Activate Admin" data-target="#statusModal{{ $admin->id }}"><i class="fa fa-check"></i>
                                </button>
                                @endif
                            </td>

                            <!-- Modal -->
                            <div class="modal" id="statusModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Do you really want to change the status of
                                            <b>{{ $admin->name }} {{ $admin->email }}</b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <a type="button" href="{{ url('/sysad/dochangestatus/'. $admin->id) }}" class="btn btn-primary">Save changes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </tr>
                        <!-- modal  View-->
                        <div class="modal fade" id="view-modal{{ $admin->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Admin Profile</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="{{ url("/img/admindp/". $admin->profile_image)}}" height="200" width="200"></td>

                                                </div>
                                                <br>
                                                <div class="col-md-4">
                                                    <label for="formGroupExampleInput">ID :</label>
                                                    {{ $admin->id }}<br>

                                                    <label for="formGroupExampleInput">First Name :</label>
                                                    {{ $admin->fname }}<br>

                                                    <label for="formGroupExampleInput">Last Name :</label>
                                                    {{$admin->lname }} <br>

                                                    <label for="formGroupExampleInput">Email :</label>
                                                    {{ $admin->email }} <br>

                                                    <label for="formGroupExampleInput">Contact :</label>
                                                    {{ $admin->contact }} <br>

                                                    <label for="formGroupExampleInput">Status :</label>
                                                    @if($admin->status == 'active')
                                                    <font color="green">{{ $admin->status }}</font><br>
                                                    @elseif($admin->status == 'inactive')
                                                    <font color="red">{{ $admin->status }}</font><br>
                                                    @endif

                                                    <label for="formGroupExampleInput">Created At :</label>
                                                    {{ $admin->created_at }} <br>

                                                    <label for="formGroupExampleInput">Updated At :</label>
                                                    {{ $admin->updated_at }}

                                                </div>
                                                <div class="col-md-6">
                                                </div>
                                            </div>
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
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        @endforeach

                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
                <br>
                <p align="right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i>
                        Create Admin
                    </button>
                </p>

                <!-- modal  Create-->
                <div class="modal fade" id="create-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">CREATE ADMIN</h4>
                            </div>
                            <div class="modal-body">
                                <form action="/sysad/doaddadmin" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">First Name</label>
                                        <input type="text" class="form-control" name="first_name" placeholder="First name" value="{{ old('first_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="Last name" value="{{ old('last_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="E.g. islaw@prbi.com" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Contact</label>
                                        <input type="number" class="form-control" name="contact" placeholder="E.g. 09192832711" value="{{ old('contact') }}">
                                    </div>





                            </div>
                            <div class="modal-footer">
                                <p align="right">
                                    <button type="submit" class="btn btn-success mb-2"><i class="fa fa-check"></i> Submit</button>
                                    <button type="button" class="btn btn-primary mb-2" data-dismiss="modal"><i class="fa fa-close"></i>
                                        Back
                                    </button>
                                </p>
                            </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>

            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>
@include('system_admin.sysAd_includes.footer')