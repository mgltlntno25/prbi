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
                        <h3>REGISTRATION FORM </h3>
                    </font>
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <div class="content-wrapper">


            <section class="content">

                <div class="row">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="col-md-4">
                        <div class="box box-passive">
                            <div class="box-header with-border">
                                <h3 class="box-title">Personal Information</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form action="/user/doregister" method="post">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">First Name</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Last Name</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Contact</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-mobile"></i>
                                            </div>
                                            <input type="number" class="form-control" name="contact" placeholder="Contact" value="{{ old('contact') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Address</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <input type="text" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                        </div>



                    </div>

                    <div class="col-md-4">

                        <div class="box box-passive">
                            <div class="box-header with-border">
                                <h3 class="box-title">Login Information</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Confirm Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                        <input type="password" class="form-control" name="password_confimation" placeholder="Password">
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="box box-passive">
                            <div class="box-header with-border">
                                <h3 class="box-title">Other Information</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Birthday</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="date" class="form-control" name="birthday" placeholder="Birthday" value="{{ old('birthday') }}">
                                    </div>
                                </div>
                                <label> Gender </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="male" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Male
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="female">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Female
                                    </label>
                                </div>
                                <br>


                                <div class="form-group">
                                    <label for="sel1">Blood Type</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-heartbeat"></i>
                                        </div>
                                        <select class="form-control" id="sel1" name="bloodtype" value="{{ old('bloodtype') }}>
                                            <option value="N/A">N/A</option>
                                            <option value="N/A">N/A</option>
                                            <option value="AB-">AB-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>

                                        </select>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <br>
                                <br>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-8">

                        <div class="box box-passive">
                            <div class="box-header with-border">
                                <h3 class="box-title">Emergency Contact Information</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Emergency Contact Person</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" class="form-control" name="emergency_name" placeholder="Emergency Contact Person" value="{{ old('emergency_name') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Emergency Contact Number</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                        <input type="number" class="form-control" name="emergency_contact" placeholder="Emergency Contact Number" value="{{ old('emergency_contact') }}">
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Submit Registration</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="box-body">
                                <button type="submit" class="btn btn-block btn-success btn-lg"> Submit </button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
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