@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View Events
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-calendar"></i> Events</a></li>
      <li class="active">{{$events->event_name}}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <!--------------------------
        | Your Page Content Here |
        -------------------------->



    <!-- Info boxes -->
    <div class="box">
      <div class="box-header">


        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
        @endif
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form method="post" action="{{url('/user/doeventregistration/'. $events->id)}}">
          {{ csrf_field() }}
          <img src="{{ url("/img/events_banner/". $events->event_image) }}" height="350" width="100%">
          <hr width="90%">

          <!-- Flip Clock -->
          <div class="clock" style="margin:2em;"></div>
          <div class="message"></div>

          <div class="form-group">
            <input type="hidden" class="form-control" name="event_id" value="{{$events->id}}" disabled>
          </div>
          <br>
          <br>
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <h2 style="font-family: &quot;Source Sans Pro&quot;, sans-serif; font-weight: 700; line-height: 44px; color: rgb(72, 72, 72); margin-top: 0px; margin-right: 0px; margin-left: 0px; font-size: 35px; letter-spacing: -0.6px; overflow-wrap: break-word;">{{$events->event_name}}</h2>
                <div class="event-venue blurry-black-text" style="font-size: 15px; text-transform: uppercase; letter-spacing: 1px; color: rgb(72, 72, 72); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;"><span class="fa fa-map-marker" aria-hidden="true" style="transform: translate(0px, 0px);"></span>&nbsp;&nbsp;{{$events->location}}</div>
                <div class="event-start-date blurry-black-text" style="font-size: 15px; text-transform: uppercase; letter-spacing: 1px; color: rgb(72, 72, 72); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;"><span class="fa fa-calendar" aria-hidden="true" style="transform: translate(0px, 0px);"></span>&nbsp;&nbsp;{{date("M jS, Y",strtotime($events->event_date))}}</div>
                <br>
                <br>
                @if($events->description != '')
                <div class="form-group">
                  <h2 style="font-family: &quot;Source Sans Pro&quot;, sans-serif; font-weight: 700; line-height: 44px; color: rgb(72, 72, 72); margin-top: 0px; margin-right: 0px; margin-left: 0px; font-size: 35px; letter-spacing: -0.6px; overflow-wrap: break-word;">Event Description</h2>
                  {!! $events->description !!}
                </div>
                @endif
                <br>
              </div>
              <div class="col-sm-6">
                @if(!\App\Event_list::where('prbi_id','=',Auth::guard('user')->user()->prbi_id)
                ->where('event_id','=', $events->id)
                ->exists())
                <h2 style="font-family: &quot;Source Sans Pro&quot;, sans-serif; font-weight: 700; line-height: 44px; color: rgb(72, 72, 72); margin-top: 0px; margin-right: 0px; margin-left: 0px; font-size: 35px; letter-spacing: -0.6px; overflow-wrap: break-word;"><i class="fa fa-money"></i> {{$events->amount}}PHP</h2>
                <h3 style="font-family: &quot;Source Sans Pro&quot;, sans-serif; font-weight: 700; line-height: 30px; color: rgb(72, 72, 72); margin-top: 0px; margin-right: 0px; margin-left: 0px; font-size: 25px; letter-spacing: -0.6px; overflow-wrap: break-word;"><i class="fa fa-calendar"></i>
                  <font color="red"> Registration until {{date("M jS, Y",strtotime($events->end_reg))}}
                </h3>
                </font>

                <div class="form-group">
                  </i>
                  <h2 style="font-family: &quot;Source Sans Pro&quot;, sans-serif; font-weight: 700; line-height: 44px; color: rgb(72, 72, 72); margin-top: 0px; margin-right: 0px; margin-left: 0px; font-size: 22px; letter-spacing: -0.6px; overflow-wrap: break-word;"><i class="fa fa-tag"></i> Category</h2>
                  <select class="form-control" id="sel1" name="category">
                    <option value="Open Elite">Open Elite</option>
                    <option value="Amatuer">Amatuer</option>
                    <option value="Beginner">Beginner</option>
                    <option value="Fun Ride">Fun Ride</option>
                  </select>
                </div>

                <p align="right">
                  <button type="button" class="btn btn-success btn-block btn-lg" data-target="#event" data-toggle="modal"><i class="fa fa-check"></i> Register</button>
                  <button type="button" class="btn btn-primary btn-block" onclick="window.location='{{url("user/events")}}'"><i class="fa fa-close"></i> Back</button>

                </p>
                @else
                <button type="button" class="btn btn-primary btn-block" onclick="window.location='{{url("user/events")}}'"><i class="fa fa-close"></i> Back</button>
                @endif

              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="modal fade" id="event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Join Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Do you really want to join this event?
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Register</button>
            <button type="button" data-dismiss="modal" class="btn btn-primary">Close</a>
          </div>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    </form>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


@include('user.user_includes.footer')


<link rel="stylesheet" href="{{ asset('/flipclock/flipclock.css') }}">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="{{ asset('/flipclock/flipclock.js') }}"></script>

<script type="text/javascript">
  var clock;

  $(document).ready(function() {

    var date = new Date('{{ $events->event_date }}');
    var now = new Date();
    var diff = (date.getTime() / 1000) - (now.getTime() / 1000);

    var clock;

    clock = $('.clock').FlipClock(diff, {
      clockFace: 'DailyCounter',
      autoStart: false,
      callbacks: {
        stop: function() {
          $('.message').html('The clock has stopped!')
        }
      }
    });


    clock.setTime(diff);
    clock.setCountdown(true);
    clock.start();

  });
</script>