@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Login Sessions
        <small>Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Login Sessions</a></li>
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
                  <th>PRBI ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Time</th>
                  <th>Date</th>
                  <th>Activity</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>PRBI00001</td>
                  <td>Juan Dela Cruz</td>
                  <td>jdc@gmail.com</td>
                  <td>13:00</td>
                  <td>01/01/19</td>
                  <td>Login win10</td>
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