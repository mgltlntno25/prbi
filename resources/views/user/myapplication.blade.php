@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Application List
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Application List</a></li>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>PRBI ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>My ID</th>
                            <th>Payment Status</th>
                            <th>Application Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($application_lists as $application_list)
                        <tr>
                            <td>{{$application_list->user_id}}</td>
                            <td>{{$application_list->user_name}}</td>
                            <td>{{$application_list->user_email}}</td>
                            <td> <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#id"><i class="fa fa-eye"></i></button>
                                @if($application_list->application_status == 'verified' && $application_list->payment_status == 'inactive')
                            <td> <button type="button" class="btn btn-primary mb-2" onclick="window.location='{{url('user/application_paymentmethod')}}'"> PAY NOW!</button>
                            </td>
                            @elseif($application_list->payment_status == 'rejected' && $application_list->application_status == 'verified')
                            <td> <button type="button" class="btn btn-primary mb-2" onclick="window.location='{{url('user/application_paymentmethod')}}'"> PAY NOW!</button>
                            </td>
                            @else
                            <td>{{$application_list->payment_status}}</td>
                            @endif

                            <td>{{$application_list->application_status}}</td>
                        </tr>
                        <div class="modal fade" id="id">
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
                                @endforeach

                    </tbody>

                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



@include('user.user_includes.footer')