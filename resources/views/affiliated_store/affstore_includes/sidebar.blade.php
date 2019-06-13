 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">

   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

     <!-- Sidebar user panel (optional) -->
     <div class="user-panel">
       <div class="pull-left image">
         <img src="{{asset("/img/affiliateddp/". Auth::guard('affiliatedstore')->user()->image)}}" class="img-circle" alt="User Image">
       </div>
       <div class="pull-left info">
         <p>{{Auth::guard('affiliatedstore')->user()->store_name}}</p>
         <!-- Status -->
         <small><i class="fa fa-circle text-success"></i> Online</small>
       </div>
     </div>

     <!-- search form (Optional) -->
    
     <!-- /.search form -->


     <!-- Sidebar Menu -->
     <ul class="sidebar-menu" data-widget="tree">
       <li class="header">Member</li>
       <!-- Optionally, you can add icons to the links -->
       @if(\Request::is('affiliatedstore/search*'))
       <li class="active"><a href="{{url("affiliatedstore/search")}}"><i class="fa fa-search"></i> <span>Search Member</span></a></li>
       @else
       <li><a href="{{url("affiliatedstore/search")}}"><i class="fa fa-search"></i> <span>Search Member</span></a></li>
       @endif
     </ul>
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>