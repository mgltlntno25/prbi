 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">

   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

     <!-- Sidebar user panel (optional) -->
     <div class="user-panel">
       <div class="pull-left image">
         <img src="{{asset("/img/admindp/". Auth::guard('admin')->user()->profile_image)}}" class="img-circle" alt="User Image">
       </div>
       <div class="pull-left info">
         <p>{{Auth::guard('admin')->user()->fname}} {{Auth::guard('admin')->user()->lname}}</p>
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
       <li class="header">ADMIN</li>
       <!-- Optionally, you can add icons to the links -->
       @if(\Request::is('admin/dashboard'))
       <li class="active"><a href="{{url("admin/dashboard")}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
       @else
       <li><a href="{{url("admin/dashboard")}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
       @endif

       @if(\Request::is('admin/banners*'))
       <li class="active treeview">
         <a href="#"><i class="fa fa-address-card-o"></i> <span>Content Management</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="active"><a href="{{url("admin/banners")}}"><i class="fa fa-circle-o"></i><i class="fa fa-image"></i> <span>Banners</span></a></li>
           <li><a href="{{url("admin/faqs")}}"><i class="fa fa-circle-o"></i><i class="fa fa-question-circle"></i> <span>FAQs</span></a></li>
           <li><a href="{{url("admin/sponsors")}}"><i class="fa fa-circle-o"></i><i class="fa fa-users"></i> <span>Sponsors</span></a></li>
           <li><a href="{{url("admin/apkFilesMain")}}"><i class="fa fa-circle-o"></i><i class="fa fa-file"></i> <span>APK Files</span></a></li>

         </ul>
       </li>
       @elseif(\Request::is('admin/faqs*'))
       <li class="active treeview">
         <a href="#"><i class="fa fa-address-card-o"></i> <span>Content Management</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{url("admin/banners")}}"><i class="fa fa-circle-o"></i><i class="fa fa-image"></i> <span>Banners</span></a></li>
           <li class="active"><a href="{{url("admin/faqs")}}"><i class="fa fa-circle-o"></i><i class="fa fa-question-circle"></i> <span>FAQs</span></a></li>
           <li><a href="{{url("admin/sponsors")}}"><i class="fa fa-circle-o"></i><i class="fa fa-users"></i> <span>Sponsors</span></a></li>
           <li><a href="{{url("admin/apkFilesMain")}}"><i class="fa fa-circle-o"></i><i class="fa fa-file"></i> <span>APK Files</span></a></li>

         </ul>
       </li>
       @elseif(\Request::is('admin/sponsors*'))
       <li class="active treeview">
         <a href="#"><i class="fa fa-address-card-o"></i> <span>Content Management</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{url("admin/banners")}}"><i class="fa fa-circle-o"></i><i class="fa fa-image"></i> <span>Banners</span></a></li>
           <li><a href="{{url("admin/faqs")}}"><i class="fa fa-circle-o"></i><i class="fa fa-question-circle"></i> <span>FAQs</span></a></li>
           <li class="active"><a href="{{url("admin/sponsors")}}"><i class="fa fa-circle-o"></i><i class="fa fa-users"></i> <span>Sponsors</span></a></li>
           <li><a href="{{url("admin/apkFilesMain")}}"><i class="fa fa-circle-o"></i><i class="fa fa-file"></i> <span>APK Files</span></a></li>

         </ul>
       </li>
       @elseif(\Request::is('admin/apkFilesMain*'))
       <li class="active treeview">
         <a href="#"><i class="fa fa-address-card-o"></i> <span>Content Management</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{url("admin/banners")}}"><i class="fa fa-circle-o"></i><i class="fa fa-image"></i> <span>Banners</span></a></li>
           <li><a href="{{url("admin/faqs")}}"><i class="fa fa-circle-o"></i><i class="fa fa-question-circle"></i> <span>FAQs</span></a></li>
           <li><a href="{{url("admin/sponsors")}}"><i class="fa fa-circle-o"></i><i class="fa fa-users"></i> <span>Sponsors</span></a></li>
           <li class="active"><a href="{{url("admin/apkFilesMain")}}"><i class="fa fa-circle-o"></i><i class="fa fa-file"></i> <span>APK Files</span></a></li>

         </ul>
       </li>
       @else
       <li class="treeview">
         <a href="#"><i class="fa fa-address-card-o"></i> <span>Content Management</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{url("admin/banners")}}"><i class="fa fa-circle-o"></i><i class="fa fa-image"></i> <span>Banners</span></a></li>
           <li><a href="{{url("admin/faqs")}}"><i class="fa fa-circle-o"></i><i class="fa fa-question-circle"></i> <span>FAQs</span></a></li>
           <li><a href="{{url("admin/sponsors")}}"><i class="fa fa-circle-o"></i><i class="fa fa-users"></i> <span>Sponsors</span></a></li>
           <li><a href="{{url("admin/apkFilesMain")}}"><i class="fa fa-circle-o"></i><i class="fa fa-file"></i> <span>APK Files</span></a></li>

         </ul>
       </li>
       @endif
       @if(\Request::is('admin/announcements*'))
       <li class="active"><a href="{{url("admin/announcements")}}"><i class="fa fa-info-circle"></i> <span>Announcements</span></a></li>
       @else
       <li><a href="{{url("admin/announcements")}}"><i class="fa fa-info-circle"></i> <span>Announcements</span></a></li>
       @endif


       @if(\Request::is('admin/application_list*'))
       <li class="active treeview">
         <a href="#"><i class="fa fa-address-card-o"></i> <span>Members</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="active"><a href="{{url("admin/application_list")}}"><i class="fa fa-circle-o"></i> Application List</a></li>
           <li><a href="{{url("admin/regular_members")}}"><i class="fa fa-circle-o"></i> Regular Members</a></li>
           <li><a href="{{url("admin/premium_members")}}"><i class="fa fa-circle-o"></i> Premium Members</a></li>
           <li><a href="{{url("admin/insured_members")}}"><i class="fa fa-circle-o"></i> Insured Members</a></li>
         </ul>
       </li>
       @elseif(\Request::is('admin/regular_members*'))
       <li class="active treeview">
         <a href="#"><i class="fa fa-address-card-o"></i> <span>Members</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{url("admin/application_list")}}"><i class="fa fa-circle-o"></i> Application List</a></li>
           <li class="active"><a href="{{url("admin/regular_members")}}"><i class="fa fa-circle-o"></i> Regular Members</a></li>
           <li><a href="{{url("admin/premium_members")}}"><i class="fa fa-circle-o"></i> Premium Members</a></li>
           <li><a href="{{url("admin/insured_members")}}"><i class="fa fa-circle-o"></i> Insured Members</a></li>
         </ul>
       </li>
       @elseif(\Request::is('admin/premium_members*'))
       <li class="active treeview">
         <a href="#"><i class="fa fa-address-card-o"></i> <span>Members</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{url("admin/application_list")}}"><i class="fa fa-circle-o"></i> Application List</a></li>
           <li><a href="{{url("admin/regular_members")}}"><i class="fa fa-circle-o"></i> Regular Members</a></li>
           <li class="active"><a href="{{url("admin/premium_members")}}"><i class="fa fa-circle-o"></i> Premium Members</a></li>
           <li><a href="{{url("admin/insured_members")}}"><i class="fa fa-circle-o"></i> Insured Members</a></li>
         </ul>
       </li>
       @elseif(\Request::is('admin/insured_members*'))
       <li class="active treeview">
         <a href="#"><i class="fa fa-address-card-o"></i> <span>Members</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{url("admin/application_list")}}"><i class="fa fa-circle-o"></i> Application List</a></li>
           <li><a href="{{url("admin/regular_members")}}"><i class="fa fa-circle-o"></i> Regular Members</a></li>
           <li><a href="{{url("admin/premium_members")}}"><i class="fa fa-circle-o"></i> Premium Members</a></li>
           <li class="active"><a href="{{url("admin/insured_members")}}"><i class="fa fa-circle-o"></i> Insured Members</a></li>
         </ul>
       </li>

       @else
       <li class=" treeview">
         <a href="#"><i class="fa fa-address-card-o"></i> <span>Members</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{url("admin/application_list")}}"><i class="fa fa-circle-o"></i> Application List</a></li>
           <li><a href="{{url("admin/regular_members")}}"><i class="fa fa-circle-o"></i> Regular Members</a></li>
           <li><a href="{{url("admin/premium_members")}}"><i class="fa fa-circle-o"></i> Premium Members</a></li>
           <li><a href="{{url("admin/insured_members")}}"><i class="fa fa-circle-o"></i> Insured Members</a></li>
         </ul>
       </li>

       @endif


       @if(\Request::is('admin/events*'))
       <li class='active'><a href="{{url("admin/events")}}"><i class="fa fa-calendar"></i> <span>Events</span></a></li>
       @else
       <li><a href="{{url("admin/events")}}"><i class="fa fa-calendar"></i> <span>Events</span></a></li>

       @endif

       @if(\Request::is('admin/payments*'))
       <li class="active"><a href="{{url("admin/payments")}}"><i class="fa fa-dollar"></i> <span>Payments</span></a></li>
       @else
       <li><a href="{{url("admin/payments")}}"><i class="fa fa-dollar"></i> <span>Payments</span></a></li>
       @endif

       @if(\Request::is('admin/donations*'))
       <li class="active"><a href="{{url("admin/donations")}}"><i class="fa fa-heart"></i> <span>Donations</span></a></li>
       @else
       <li><a href="{{url("admin/donations")}}"><i class="fa fa-heart"></i> <span>Donations</span></a></li>
       @endif

       @if(\Request::is('admin/incidents*'))
       <li class="active"><a href="{{url("admin/incidents")}}"><i class="fa fa-warning"></i> <span>Incident Reports</span></a></li>
       @else
       <li><a href="{{url("admin/incidents")}}"><i class="fa fa-warning"></i> <span>Incident Reports</span></a></li>
       @endif

       @if(\Request::is('admin/affiliatedstore*'))
       <li class="active"><a href="{{url("admin/affiliatedstore")}}"><i class="fa fa-handshake-o"></i> <span>Affiliated Store Accounts</span></a></li>
       @else
       <li><a href="{{url("admin/affiliatedstore")}}"><i class="fa fa-handshake-o"></i> <span>Affiliated Store Accounts</span></a></li>
       @endif

       @if(\Request::is('admin/aud_login*'))
       <li class="active treeview">
         <a href="#"><i class="fa fa-history"></i> <span>Audit Trails</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="active"><a href="{{url("admin/aud_login")}}"><i class="fa fa-circle-o"></i> Login Sessions</a></li>
           <li><a href="{{url("admin/aud_activities")}}"><i class="fa fa-circle-o"></i>Activities</a></li>
         </ul>
       </li>
     </ul>
     @elseif(\Request::is('admin/aud_activities*'))
     <li class="active treeview">
       <a href="#"><i class="fa fa-history"></i> <span>Audit Trails</span>
         <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
         </span>
       </a>
       <ul class="treeview-menu">
         <li><a href="{{url("admin/aud_login")}}"><i class="fa fa-circle-o"></i> Login Sessions</a></li>
         <li class="active"><a href="{{url("admin/aud_activities")}}"><i class="fa fa-circle-o"></i>Activities</a></li>
       </ul>
     </li>
     </ul>
     @endif
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>