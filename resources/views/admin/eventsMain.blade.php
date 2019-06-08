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


        <!-- Info boxes -->
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Event Name</th>
                            <th>Start of Registrations</th>
                            <th>End of Registration</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>{{$event->id}}</td>
                            <td><img src="{{ url("/img/events_thumb/". $event->event_image) }}" height="50" width="150"></td>
                            <td>{{$event->event_name}}</td>
                            <td>{{$event->start_reg}}</td>
                            <td>{{$event->end_reg}}</td>
                            <td>{{$event->status}}</td>
                            <td>

                                <button type="button" class="btn btn-info"   data-placement="top" title="View Event" data-toggle="modal" data-target="#view-modal{{$event->id}}"><i class="fa fa-eye"></i></button>
                                @if(!App\Event_list::whereNull(1))
                                <button type="button" data-toggle="tooltip" data-placement="top" title="Events List" class="btn btn-info" onclick="window.location='{{url("admin/events/events_lists/" . $event->id)}}'" disabled><i class="fa fa-list"> </i> </button>
                                @else
                                <button type="button" data-toggle="tooltip" data-placement="top" title="Events List" class="btn btn-info" onclick="window.location='{{url("admin/events/events_lists/" . $event->id)}}'"><i class="fa fa-list"> </i> </button>
                                @endif
                                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Update Event" onclick="window.location='{{url("admin/events/" . $event->id)}}'"><i class="fa fa-edit"> </i> </button>
                                @if($event->status == 'active')
                                <button type="button" class="btn btn-danger"  data-placement="top" title="Deactivate Event" data-toggle="modal" data-target="#statusModal{{ $event->id }}"><i class="fa fa-close"></i>
                                </button>
                                @elseif($event->status == 'inactive')
                                <button type="button" class="btn btn-success"  data-placement="top" title="Activate Event" data-toggle="modal" data-target="#statusModal{{ $event->id }}"><i class="fa fa-check"></i>
                                </button>
                                @endif

                                <!-- Modal -->
                                <div class="modal fade" id="statusModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <b>{{ $event->event_name }} </b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                                </button>
                                                <a type="button" href="{{ url('/admin/dochangestatusevent/'. $event->id) }}" class="btn btn-primary">Save changes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </td>
                        </tr>
                        <!-- modal  View-->
                        <div class="modal fade bd-example-modal-lg" id="view-modal{{ $event->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><b>{{$event->event_name}}</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ url("/img/events_banner/". $event->event_image) }}" height="250" width="570">
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Event Name</label>
                                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{$event->event_name}}" disabled>
                                        </div>
                                        @if($event->description != '')
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Description</label> <br>
                                            {!! $event->description !!}
                                        </div>
                                        @endif

                                        @if($event->amount != 0)
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Amount</label>
                                            <input type="text" class="form-control" name="amount" placeholder="amount" value="{{$event->amount}}" disabled>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Location</label>
                                            <input type="text" class="form-control" name="link" placeholder="Link" value="{{$event->location}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Event Date</label>
                                            <input type="date" class="form-control" name="event_date" placeholder="Link" value="{{$event->event_date}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Start of Registration</label>
                                            <input type="date" class="form-control" name="start_reg" placeholder="Link" value="{{$event->start_reg}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">End of Registration</label>
                                            <input type="date" class="form-control" name="end_reg" placeholder="Link" value="{{$event->end_reg}}" disabled>
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
                <p align="right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addevent"> <i class="fa fa-plus"></i> Add Events </button></p>
                <!-- modal  Create-->
                <div class="modal fade" id="addevent">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">CREATE EVENT</h4>
                            </div>
                            <div class="modal-body">

                                <form action='/admin/doaddevent' method='post' enctype='multipart/form-data'>
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Event Image</label>
                                        <input type="file" class="form-control" name="event_image" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Event Name</label>
                                        <input type="text" class="form-control" name="event_name" placeholder="Title" value="{{old('event_name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Location</label>
                                        <input type="addrress" class="form-control" name="location" placeholder="Location" value="{{old('location')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Event Date</label>
                                        <input type="date" class="form-control" name="event_date" placeholder="Link" value="{{old('event_date')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Start of Registration</label>
                                        <input type="date" class="form-control" name="start_reg" placeholder="Link" value="{{old('start_reg')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">End of Registration</label>
                                        <input type="date" class="form-control" name="end_reg" placeholder="Link" value="{{old('end_reg')}}">
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
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.admin_includes.footer')