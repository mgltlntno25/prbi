@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Affiliated
            <small>Stores</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Affiliated Stores</a></li>
            <li class="active">Main</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->


        <!-- Info boxes -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Store Name</th>
                            <th>Store Owner</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Actions </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($affiliatedstores as $affiliatedstore)
                        <tr>
                            <td>{{ $affiliatedstore->id }}</td>
                            <td><img src="{{ url("/img/affiliateddp_thumb/". $affiliatedstore->image)  }} " width="100" height="100"></td>
                            <td>{{$affiliatedstore->store_name}}</td>
                            <td>{{$affiliatedstore->store_owner}}</td>
                            <td>{{$affiliatedstore->email}}</td>
                            <td>{{$affiliatedstore->contact}}</td>
                            <td>{{$affiliatedstore->status}}</td>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#view-modal{{$affiliatedstore->id}}">  <i class="fa fa-eye"></i></button>
                                @if($affiliatedstore->status == 'active')
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#statusModal{{ $affiliatedstore->id }}"><i class="fa fa-close"></i>
                                </button>
                                @elseif($affiliatedstore->status == 'inactive')
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#statusModal{{ $affiliatedstore->id }}"><i class="fa fa-check"></i>
                                </button>
                                @endif
                            </td>

                            <!-- Modal -->
                            <div class="modal fade" id="statusModal{{ $affiliatedstore->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <b>{{ $affiliatedstore->store_name }} {{ $affiliatedstore->email }}</b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <a type="button" href="{{ url('/admin/dochangestatusaffiliatedstore/'. $affiliatedstore->id) }}" class="btn btn-primary">Save changes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </tr>

                        <!-- modal  View-->
                        <div class="modal fade" id="view-modal{{ $affiliatedstore->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Admin Profile</h4>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ url("/img/affiliateddp/". $affiliatedstore->image)  }} ">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Store Name</label>
                                            <input type="text" class="form-control" name="store_name" placeholder="Store Name" value="{{ $affiliatedstore->store_name }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Store Owner</label>
                                            <input type="text" class="form-control" name="store_owner" placeholder="Store Owner" value="{{ $affiliatedstore->store_owner }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $affiliatedstore->email }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Contact</label>
                                            <input type="number" class="form-control" name="contact" placeholder="Contact" value="{{ $affiliatedstore->contact }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address" value="{{ $affiliatedstore->address }}" disabled>
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
                </table>
                <br>
                <p align="right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-modal"> <i class="fa fa-plus"></i> Add Affiliated Store </button></p>
                <div class="modal fade" id="create-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">CREATE AFFILIATED STORE</h4>
                            </div>
                            <div class="modal-body">

                                <form action="/admin/doaddaffiliatedstore" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Store Name</label>
                                        <input type="text" class="form-control" name="store_name" placeholder="Store Name" value="{{ old('store_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Store Owner</label>
                                        <input type="text" class="form-control" name="store_owner" placeholder="Store Owner" value="{{ old('store_owner') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Contact</label>
                                        <input type="number" class="form-control" name="contact" placeholder="Contact" value="{{ old('contact') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Address</label>
                                        <input type="text" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}">
                                    </div>


                                    <p align="right">
                                        <button type="submit" class="btn btn-success mb-2"><i class="fa fa-check"></i> Submit</button>
                                        <button type="button" class="btn btn-primary mb-2" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                    </p>

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
        </div>
        <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>


@include('admin.admin_includes.footer')