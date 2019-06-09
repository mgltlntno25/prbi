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
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{asset("/css/skins/skin-black.css")}}">
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

<body class="hold-transition skin-black layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <font color="white">
                        <h3>USER INFORMATION </h3>
                    </font>
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <div class="content-wrapper">



            <section class="content">

                <div class="col-md-12">
                    <div class="box box-passive">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{$user->prbi_id}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                            <div class="row">
                                <div class="panel-body">
                                    <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                                        <img alt="User Pic" src="{{asset("/img/userdp/". $user->profile_image)}}" id="profile-image1" class="img-circle img-responsive">
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                                        <div class="container">
                                            <h2>{{$user->first_name}} {{$user->last_name}}</h2>

                                            @if($user->isPremium == 0 )

                                            <p>a <b>
                                                    REGULAR MEMBER

                                                    @elseif($user->isPremium == 1 && $user->isInsured == 0)
                                                    <p>a <b>
                                                            PREMIUM MEMBER

                                                            @elseif($user->isPremium == 1 && $user->isInsured == 1)
                                                            <p>an <b>
                                                                    INSURED MEMBER

                                                                    @endif

                                                                </b></p>
                                        </div>
                                        <hr>
                                        <ul class="container details">
                                            <li>
                                                <p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{$user->email}}</p>
                                            </li>
                                            <li>
                                                <p><span class="glyphicon glyphicon-phone one" style="width:50px;"></span>{{$user->contact}}</p>
                                            </li>
                                            @if($user->address != '')
                                            <li>
                                                <p><span class="glyphicon glyphicon-home one" style="width:50px;"></span>{{$user->address}}</p>
                                            </li>
                                            @endif
                                            @if($user->gender != '')
                                            <li>
                                                <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>{{$user->gender}}</p>
                                            </li>
                                            @endif
                                            @if($user->birthday != '')
                                            <li>
                                                <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>{{$user->birthday}}</p>
                                            </li>
                                            @endif
                                            <li>
                                                <p><span class="glyphicon glyphicon-check one" style="width:50px;"></span>{{$user->status}}</p>
                                            </li>
                                        </ul>
                                        <hr>
                                        <div class="col-sm-5 col-xs-6 tital ">Date Of Joining: {{$user->created_at->format('m/d/Y')}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <br>
                        <br>

                    </div>
                </div>



            </section>

        </div>








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


        <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>








</html>