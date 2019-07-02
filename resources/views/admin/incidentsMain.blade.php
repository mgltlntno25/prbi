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
                </td>
                @endforeach
              </tr>
            </tbody>
            <tfoot>
            </tfoot>
          </table>
          <!-- Modal -->
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