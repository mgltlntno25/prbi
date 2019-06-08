 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">

   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

     <!-- Sidebar user panel (optional) -->
     <div class="user-panel">
       <div class="pull-left image">
         <img src="{{asset("/img/userdp/". Auth::guard('user')->user()->profile_image)}}" class="img-circle" alt="User Image">
       </div>
       <div class="pull-left info">
         <p>{{Auth::guard('user')->user()->first_name}} {{Auth::guard('user')->user()->last_name}}</p>
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
       <li class="header">Member</li>
       <!-- Optionally, you can add icons to the links -->
       @if(\Request::is('user/events*'))
       <li class="active"><a href="{{url("user/events")}}"><i class="fa fa-calendar"></i> <span>Events</span></a></li>
       @else
       <li><a href="{{url("user/events")}}"><i class="fa fa-calendar"></i> <span>Events</span></a></li>
       @endif
       @if(\Request::is('user/myevents*'))
       <li class="active"><a href="{{url("user/myevents")}}"><i class="fa fa-list"></i> <span>My Events</span></a></li>
       @else
       <li><a href="{{url("user/myevents")}}"><i class="fa fa-list"></i> <span>My Events</span></a></li>
       @endif
       @if(\Request::is('user/donations*'))
       <li class="active"><a href="{{url("user/donations")}}"><i class="fa fa-heart"></i> <span>Donation</span></a></li>
       @else
       <li><a href="{{url("user/donations")}}"><i class="fa fa-heart"></i> <span>Donation</span></a></li>

       @endif
       @if(\Request::is('user/profile*'))
       <li class="active"><a href="{{url("user/profile")}}"><i class="fa fa-address-card-o"></i> <span>Profile</span></a></li>

       @else
       <li><a href="{{url("user/profile")}}"><i class="fa fa-address-card-o"></i> <span>Profile</span></a></li>


       @endif
       @if(\Request::is('user/announcements*'))
       <li class="active"><a href="{{url("user/announcements")}}"><i class="fa fa-info-circle"></i> <span>Announcements</span></a></li>
       @else
       <li><a href="{{url("user/announcements")}}"><i class="fa fa-info-circle"></i> <span>Announcements</span></a></li>

       @endif
     </ul>
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>