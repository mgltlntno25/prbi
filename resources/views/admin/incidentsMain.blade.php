@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Incidents Reports
      <small>Dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Incidents Reports</a></li>
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
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>User ID </th>
              <th>User Name</th>
              <th>User Email</th>
              <th>User Contact No.</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              @foreach($ireports as $ireport)
              <td>{{$ireport->id}}</td>
              <td>{{$ireport->user_id}}</td>
              <td>{{$ireport->user_name}}</td>
              <td>{{$ireport->user_email}}</td>
              <td>{{$ireport->user_contact}}</td>
              <td>{{$ireport->created_at}}</td>
              <td>{{$ireport->status}}</td>
              <td>
                <button type="button" class="btn btn-info" data-placement="top" data-toggle="tootltip" title="View Incident Report" onclick="window.location='{{url("admin/report/" . $ireport->id)}}'"><i class="fa fa-eye"></i></button>
                @if($ireport->status == 'active')
                <button type="button" class="btn btn-danger" data-placement="top" title="Deactivate Event" data-toggle="modal" data-target="#statusModal{{ $ireport->id }}"><i class="fa fa-close"></i>
                </button>
                @elseif($ireport->status == 'inactive')
                <button type="button" class="btn btn-success" data-placement="top" title="Activate Event" data-toggle="modal" data-target="#statusModal{{ $ireport->id }}"><i class="fa fa-check"></i>
                </button>
                @endif

              </td>

            </tr>
          </tbody>
          <tfoot>
          </tfoot>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="statusModal{{ $ireport->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Do you really want to change the status of Incident Report No.
                <b>{{ $ireport->id }} </b>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                </button>
                <a type="button" href="{{ url('/admin/incidents/dochangestatusreport/'. $ireport->id) }}" class="btn btn-primary">Save changes</a>
              </div>
            </div>
          </div>
        </div>
        @endforeach

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