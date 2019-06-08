<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset("/img/islaw.png")}}" />
  <title>Pinoy Road Biker Inc.</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset("bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset("bower_components/font-awesome/css/font-awesome.min.css")}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset("bower_components/Ionicons/css/ionicons.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("/css/AdminLTE.min.css")}}">
  <link rel="stylesheet" href="{{asset("/css/cardstyle.css")}}">

  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{asset("/css/skins/skin-yellow.min.css")}}">
  <link rel="stylesheet" href="{{asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">

  <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
  <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-yellow sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>P</b>RBi</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b></b></span>
      </a>
      @include('admin.admin_includes.header_navbar')
      @include('admin.admin_includes.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update Announcements
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('admin/announcements')}}"><i class="fa fa-image>"></i> Announcements</a></li>
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

              @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
              @endif
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ url('admin/doupdateannouncements/'. $announcements->id) }}" method="post">
                {{ csrf_field() }}
                <br>
                <div class="form-group">
                  <label for="formGroupExampleInput">Name</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Name" name="title" value="{{$announcements->title}}">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Description</label>
                  <textarea class="form-control summernote" name="description">{{$announcements->description}}</textarea>
                </div>

                <p align="right">
                  <button type="button" data-toggle="modal" data-target="#updateModal" class="btn btn-warning mb-2"><i class="fa fa-edit"></i> Update </button>
                  <button type="button" class="btn btn-primary mb-2" onclick="window.location='{{url("admin/announcements/")}}'"><i class="fa fa-close"></i>
                    Back
                  </button>
                </p>
                <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Announcement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Do you really want to update this Announcement?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</a>
                      </div>
                    </div>
                  </div>
              </form>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- /.col -->



        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">

        </div>
        <!-- Default to the left -->
        <center><strong>Copyright &copy; 2019 <a href="#">LUCKY ACES</a>.</strong> All rights reserved.</center>
      </footer>

      <!-- Control Sidebar -->

      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->


  <!-- jQuery 3 -->
  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset("bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
  <script src="{{asset("bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
  <script src="{{asset("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset("bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
  <!-- FastClick -->
  <script src="{{asset("bower_components/fastclick/lib/fastclick.js")}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset("/js/adminlte.min.js")}}"></script>



  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">

  <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


  <script>
    $(function() {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
      })
    })
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 450,
      });
    });
  </script>
  <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>