@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      APK Files
      <small>Dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa <fa-image></fa-image>"></i> APK Files</a></li>
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
              <th>Description</th>
              <th>Version</th>
              <th>File</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>PRBi mobile app</td>
              <td>Minor Bug updates</td>
              <td>v2</td>
              <td>prbi.zip</td>
              <td>

                <button type="button" class="btn btn-info"><i class="fa fa-eye"></i> View </button>
                <button type="button" class="btn btn-warning"><i class="fa fa-edit"></i> Edit </button>


              </td>
            </tr>
          </tbody>
          <tfoot>

          </tfoot>
        </table>
        <br>
        <p align="right"><button type="button" class="btn btn-success"> <i class="fa fa-upload"></i> Upload APK File </button></p>
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