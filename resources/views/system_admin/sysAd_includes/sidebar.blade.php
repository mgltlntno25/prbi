 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">

   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

     <!-- Sidebar user panel (optional) -->
     <div class="user-panel">
       <div class="pull-left image">
         <img src="{{asset("/img/islaw.png")}}" class="img-circle" alt="User Image">
       </div>
       <div class="pull-left info">
         <p>System Admin</p>
         <!-- Status -->
         <small><i class="fa fa-circle text-success"></i> Online</small>
       </div>
     </div>

     <!-- search form (Optional) -->
     <form action="#" method="get" class="sidebar-form">
       <div class="input-group">
         <input type="text" name="q" class="form-control" placeholder="Search...">
         <span class="input-group-btn">
           <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
           </button>
         </span>
       </div>
     </form>
     <!-- /.search form -->


     <!-- Sidebar Menu -->
     <ul class="sidebar-menu" data-widget="tree">
       <li class="header">SYSTEM ADMIN</li>
       <!-- Optionally, you can add icons to the links -->
       @if(\Request::is('sysad/dashboard'))
       <li class="active"><a href="{{url("sysad/dashboard")}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
       @else
       <li><a href="{{url("sysad/dashboard")}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
       @endif

       @if(\Request::is('sysad/adminaccMain'))
       <li class="active"><a href="{{url("sysad/adminaccMain")}}"><i class="fa fa-address-card-o"></i> <span>Admin Accounts</span></a></li>
       @else
       <li><a href="{{url("sysad/adminaccMain")}}"><i class="fa fa-address-card-o"></i> <span>Admin Accounts</span></a></li>
       @endif
       @if(\Request::is('sysad/audLogin'))
       <li class="active treeview">
         <a href="#"><i class="fa fa-history"></i> <span>Admin Audit Trails</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="active"><a href="{{url("sysad/audLogin")}}"><i class="fa fa-circle-o"></i>Login Sessions</a></li>
           <li><a href="{{url("sysad/audAct")}}"><i class="fa fa-circle-o"></i> Activities</a></li>
         </ul>
       </li>
       @elseif(\Request::is('sysad/audAct'))
       <li class="active treeview">
         <a href="#"><i class="fa fa-history"></i> <span>Admin Audit Trails</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{url("sysad/audLogin")}}"><i class="fa fa-circle-o"></i>Login Sessions</a></li>
           <li class="active"><a href="{{url("sysad/audAct")}}"><i class="fa fa-circle-o"></i> Activities</a></li>
         </ul>
       </li>
       @else
       <li class="treeview">
         <a href="#"><i class="fa fa-history"></i> <span>Admin Audit Trails</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{url("sysad/audLogin")}}"><i class="fa fa-circle-o"></i>Login Sessions</a></li>
           <li><a href="{{url("sysad/audAct")}}"><i class="fa fa-circle-o"></i> Activities</a></li>
         </ul>
       </li>
       
       @endif
     </ul>
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>