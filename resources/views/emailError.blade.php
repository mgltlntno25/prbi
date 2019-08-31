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


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>


<body>



    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
        </ol>
    </section>

    <section class="content container-fluid">

        <div class="container">
            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">
                        <p align="center">
                            <img src="{{asset('img/error_img.gif')}}">
                            <br>
                        </p>
                        <section class="content">
                            <div class="error-page">
                                <div class="error-content">
                                    <h4><i class="fa fa-warning text-yellow"></i> Oops! Account Cannot be verified.</h4>
                                    <p>
                                        Please Contact the administration at islaw.prbi@gmail.com <br>
                                        Thank You!

                                        



                                    </p>
                                </div>
                            </div>
                        </section>
                        <br>
                        <br>
                    </div>
                </div>

            </div>

        </div>
    </section>










    <script src="{{asset("bower_components/jquery/dist/jquery.min.js")}}"></script>
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

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>