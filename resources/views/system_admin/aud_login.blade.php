@include('system_admin.sysAd_includes.header')
@include('system_admin.sysAd_includes.header_navbar')
@include('system_admin.sysAd_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Login Sessions
        <small>Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i> Login Sessions</a></li>
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
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Activity</th>
                  <th>Date and Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($admin_auds as $admin_aud)
                  <tr>
                    <td>{{$admin_aud->id}}</td>
                    <td>{{$admin_aud->user_id}}</td>
                    <td>{{$admin_aud->user_name}}</td>
                    <td>{{$admin_aud->user_email}}</td>
                    <td>{{$admin_aud->action}}</td>
                    <td>{{$admin_aud->created_at}}</td>
                  </tr>
                @endforeach
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


  
  @include('system_admin.sysAd_includes.footer')