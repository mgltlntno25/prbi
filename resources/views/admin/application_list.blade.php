@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Application
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Application</a></li>
            <li class="active">Main</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->
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

                            <th>ID</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Valid ID</th>
                            <th>Description</th>
                            <th>Payment Status</th>
                            <th>Application Status </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($application_lists as $application_list)
                        <tr>
                            <td>{{$application_list->id}}</td>
                            <td>{{$application_list->user_id}}</td>
                            <td>{{$application_list->user_name}}</td>
                            <td>{{$application_list->user_email}}</td>
                            <td><button type="button" class="btn btn-primary"  data-placement="top" title="View Valid ID" data-toggle="modal" data-target="#view-modal{{ $application_list->id }}"><i class="fa fa-eye"></i>
                                </button></td>
                            <td>{{$application_list->application_description}}</td>
                            <td>{{$application_list->payment_status}}</td>
                            <td>{{$application_list->application_status}}</td>
                            <td>
                                @if($application_list->application_status == 'submitted')
                                <button type="button" class="btn btn-success" data-placement="top" title="Verfify Application" data-toggle="modal" data-target="#verify{{ $application_list->id }}"><i class="fa fa-check"></i>
                                </button>
                                <button type="button" class="btn btn-warning"  data-placement="top" title="Reject Application" data-toggle="modal" data-target="#reject{{ $application_list->id }}"><i class="fa fa-close"></i>
                                </button>
                                @endif
                                @if($application_list->application_status == 'verified' || $application_list->application_status == 'rejected')
                                <button type="button" class="btn btn-danger" disabled><i class="fa fa-close"></i>
                                </button>
                                @endif

                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="verify{{ $application_list->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Verify Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you really want to verify the upgrade application of
                                        <b>{{ $application_list->user_name }} </b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <a type="button" href="{{ url('/admin/doverifyapplication/'. $application_list->id) }}" class="btn btn-primary">Save changes</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="reject{{ $application_list->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reject Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you really want to reject the upgrade application of
                                        <b>{{ $application_list->user_name }} </b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <a type="button" href="{{ url('/admin/dorejectapplication/'. $application_list->id) }}" class="btn btn-primary">Save changes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="view-modal{{ $application_list->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">{{$application_list->id}}</h4>
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
                                @endforeach
                    </tbody>
                </table>
                <br>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.admin_includes.footer')