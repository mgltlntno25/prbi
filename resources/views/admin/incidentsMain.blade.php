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
                  <th>Name</th>
                  <th>Sender Email</th>
                  <th>Contact No.</th>
                  <th>Incident Details</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>Juan Dela Cruz</td>
                  <td>jdc@gmail.com
                  </td>
                  <td>09274028293</td>
                  <td>Bike Crash CRITICAL</td>
                  <td>2/14/19</td>
                  <td>Waiting</td>
                  <td> 
                    <button type="button" class="btn btn-info" onclick="window.location='{{url("admin/incidentsView")}}'"><i class="fa fa-eye"></i> View </button>
                    <button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Cancel </button>

                  </td>
                </tr>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              <br>
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