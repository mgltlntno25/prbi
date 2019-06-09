 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">

   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

     <!-- Sidebar user panel (optional) -->
     <div class="user-panel">
       <div class="pull-left image">
         <img src="{{asset("/img/userdp/". Auth::guard('affiliatedstore')->user()->image)}}" class="img-circle" alt="User Image">
       </div>
       <div class="pull-left info">
         <p>{{Auth::guard('affiliatedstore')->user()->store_name}}</p>
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
       @if(\Request::is('affiliatedstore/search*'))
       <li class="active"><a href="{{url("affiliatedstore/search")}}"><i class="fa fa-search"></i> <span>Search Member</span></a></li>
       @else
       <li><a href="{{url("affiliatedstore/search")}}"><i class="fa fa-search"></i> <span>Events</span></a></li>
       @endif
     </ul>
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>