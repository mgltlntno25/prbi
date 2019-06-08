@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
  </div>
  @endif
  <section class="content-header">
    <!-- <h1>
        Events
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Events</a></li>
        <li class="active">Main</li>
      </ol> -->
  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <!--------------------------
        | Your Page Content Here |
        -------------------------->
    <h2> UPCOMING EVENTS </h2>
    <hr>

    <div class="wrapperGrid">
      @foreach($events as $event)
      @if($event->status != 'inactive')
      <div class="grid-item content-box">
        <div class="inner">
          <img class="content-box-thumb" src="{{ url("/img/events_thumb/". $event->event_image) }}" />

          <h1 class="content-box-header">
            <b> {{$event->event_name}} </b>
          </h1>
          <br>
          <p class="content-box-blurb">

          </p>
          <br>
          @if(\App\Event_list::where('prbi_id','=',Auth::guard('user')->user()->prbi_id)
          ->where('event_id','=', $event->id)
          ->exists())
          <p> You have already submitted your registration. </p>
          @else
          <button type="button" class="btn btn-info" onclick="window.location='{{url("user/events/viewevent/" . $event->id)}}'"><i class="fa fa-eye"></i> View </button>
          @endif
        </div>

      </div><!-- /.content-box -->
      @endif
      @endforeach
    </div>




  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->




@include('user.user_includes.footer')