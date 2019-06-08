@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        INCIDENTS
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Banners</a></li>
        <li class="active">Add</li>
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
                <form>
                    
                    <br>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Send Email</label>
                        <input type="email" class="form-control" id="formGroupExampleInput" placeholder="" value="mikecarlos.22@gmail.com" disabled>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Sender Contact Number</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" value="09251839483" disabled>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Incident image</label>
                        <br>
                        <img src = "/img/incident_report/ac1.jpg" height = "300" width = "50%" >
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Date</label>
                        <input type="date" class="form-control" id="formGroupExampleInput2" placeholder="" value="2019-10-01" disabled>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Details</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" value="Bike Crash, rider is not okay!" disabled>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Location</label>
                        <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=FEU%20institute%20of%20technology&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><style>.mapouter{position:relative;text-align:right;height:500px;width:1050px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:1050px;}</style></div>
                    </div>

                    
                    
                   <p align="right"> <button type="submit" class="btn btn-success mb-2"><i class="fa fa-check"></i> Verify</button>
                   <button type="button" class="btn btn-primary mb-2" onclick="window.location='{{url("admin/incidentsMain")}}'"><i class="fa fa-close"></i> Back</button></p>
                   </p>
                </form>

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