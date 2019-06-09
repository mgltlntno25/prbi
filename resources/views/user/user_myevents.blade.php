@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Donations
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Donations</a></li>
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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Category</th>
                            <th>Payment Status</th>
                            <th>Registration Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event_lists as $el)
                        <tr>
                            <td>{{$el->prbi_id}}</td>
                            <td>{{$el->user_name}}</td>
                            <td>{{$el->event_name}}</td>
                            <td>{{$el->category}}</td>
                            @if($el->payment_status == 'inactive' || $el->payment_status == 'rejected')
                            <td> <button type="button" class="btn btn-primary mb-2" onclick="window.location='{{url("user/modepayment/" . $el->event_id)}}'"> PAY NOW!</button>
                            </td>
                            @elseif($el->payment_status == 'submitted')
                            <td>{{$el->payment_status}}</td>
                            @elseif($el->payment_status == 'verified')
                            <td>{{$el->payment_status}}</td>
                            @endif
                            <td>{{$el->reg_status}}</td>
                        </tr>
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