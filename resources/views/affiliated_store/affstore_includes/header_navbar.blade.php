    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->


            <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{asset("/img/userdp/". Auth::guard('affiliatedstore')->user()->image)}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{Auth::guard('affiliatedstore')->user()->store_name}} </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{asset("/img/userdp/". Auth::guard('affiliatedstore')->user()->image)}}" class="img-circle" alt="User Image">

                <p>
                  {{Auth::guard('affiliatedstore')->user()->store_name}}  <br>
                  Store Owner: {{Auth::guard('affiliatedstore')->user()->store_owner}}
                  <small>Member since {{Auth::guard('affiliatedstore')->user()->created_at->format('m/d/Y')}}</small>
                </p>
              </li>
              
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div> -->
              <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="{{url('user/profile')}}" type="button" class="btn btn-primary mb-2"><i class="fa fa-user"></i> Profile </button></a>
            </div>
            <div class="pull-right">
              <a href="{{url('/logout')}}" type="button" class="btn btn-danger mb-2"><i class="fa fa-user"></i> Logout </button></a>
            </div>
          </li>
        </ul>
        </li>

        <!-- Control Sidebar Toggle Button -->

        </ul>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
    </nav>
    </header>
    