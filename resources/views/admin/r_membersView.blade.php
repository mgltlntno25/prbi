@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Members
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-image>"></i> Announcements</a></li>
        <li class="active">Update</li>
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
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="#" height="250" width="250">
                            <br>
                            <h3> &nbsp;&nbsp; <font color="green"> ACTIVE </font> </h3>
                        </div>
                        <div class="col-md-9">
                            <p align="left"> <h4>
                                PRBI No.: PRBI0001 <br><br>
                                Name: Juan Dela Cruz <br><br>
                                Email: jdc@gmail.com <br><br>
                                Contact No.: 09274028293 <br><br>
                                Gender: Male <br><br>
                                Address: #187 Gen Luna St. Malabon City <br><br>
                                Blood Type: AB Normal <br><br>
                                Created At: 02-30-2019 <br><br>
                                Updated At: 09-29-2020 <br><br>
                            
                                <hr>

                                </h4>
                                <label>
                                    Contact for Emergency
                                </label>

                                Name: Juan Dela Cruz <br><br>
                                Contact No.: 09274028293 <br><br>
                                Releationship: Father


                            </P>
                        </div>
                        <div class="col-md-0">
                        <!-- Content -->
                        

                        </div>
                        <p align="right"><button type="button" class="btn btn-primary mb-2" onclick="window.location='{{url("admin/r_membersMain")}}'"><i class="fa fa-close"></i> Back</button></p>

                    </div>
                </div>
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