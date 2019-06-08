@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Events
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Events</a></li>
            <li class="active">Main</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Registered</span>
                        <span class="info-box-number">{{$ev_count}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-check-square"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">No. Payments</span>
                        <span class="info-box-number">{{$pay_count}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-check-square-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">No. Registration</span>
                        <span class="info-box-number">{{$ver_reg}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Money</span>
                        <span class="info-box-number">{{$total}} PHP</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->




        <!-- Info boxes -->
        <div class="box">

            <div class="box-header">
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

                            <th>Event ID</th>
                            <th>Event Name</th>
                            <th>PRBI ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Category</th>
                            <th>Payment Status </th>
                            <th> Registration Status </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>{{$event->event_id}}</td>
                            <td>{{$event->event_name}}</td>
                            <td>{{$event->prbi_id}}</td>
                            <td>{{$event->user_name}}</td>
                            <td>{{$event->user_email}}</td>
                            <td>{{$event->user_age}}</td>
                            <td>{{$event->category}}</td>
                            <td>{{$event->payment_status}}</td>
                            <td>{{$event->reg_status}}</td>
                            <td>
                                @if($event->payment_status == 'inactive' && $event->reg_status =='inactive')
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#statusModal{{ $event->id }}" disabled><i class="fa fa-check"></i>
                                </button>
                                @elseif($event->payment_status == 'submitted' && $event->reg_status =='inactive' )
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#statusModal{{ $event->id }}" disabled><i class="fa fa-check"></i>
                                </button>
                                @elseif($event->payment_status == 'verified' && $event->reg_status =='inactive')
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#statusModal{{ $event->id }}"><i class="fa fa-check"></i>
                                </button>
                                @elseif($event->reg_status == 'verified')
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#statusModal{{ $event->id }} " disabled><i class="fa fa-close"></i>
                                </button>
                                @endif

                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal" id="statusModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you really want to verify the event registration of
                                        <b>{{ $event->user_name }} </b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <a type="button" href="{{ url('/admin/doverifyeventregistration/'. $event->id) }}" class="btn btn-primary">Save changes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <p align="right"> <a href="{{url("admin/start_list/" . $event->event_id )}}" type="button" target="_blank" class="btn btn-primary"><i class="fa fa-list"></i> View Start List</button></p></a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.admin_includes.footer')