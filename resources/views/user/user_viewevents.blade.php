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
      <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Events</a></li>
      <li class="active">View</li>
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
                <div class="event-start-date blurry-black-text" style="font-size: 15px; text-transform: uppercase; letter-spacing: 1px; color: rgb(72, 72, 72); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;"><span class="fa fa-calendar" aria-hidden="true" style="transform: translate(0px, 0px);"></span>&nbsp;&nbsp;{{date("M jS, Y"),strtotime($events->event_date)}}</div>
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
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="formGroupExampleInput2">Start of Registration</label>
                  <input type="date" class="form-control" value="{{$events->start_reg}}" disabled>
                </div>


                <div class="form-group">
                  <label for="formGroupExampleInput2">End of Registration</label>
                  <input type="date" class="form-control" value="{{$events->end_reg}}" disabled>
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Event Date</label>
                  <input type="date" class="form-control" value="{{$events->event_date}}" disabled>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="sel1">Category</label>
                  <select class="form-control" id="sel1" name="category">
                    <option value="Open Elite">Open Elite</option>
                    <option value="Ammatuer">Ammatuer</option>
                    <option value="Begginer">Begginer</option>
                    <option value="Fun Ride">Fun Ride</option>
                  </select>
                </div>
                @if($events->amount != '')
                <div class="form-group">
                  <label for="formGroupExampleInput">Amount</label>
                  <input type="text" class="form-control" value="{{$events->amount}}" disabled>
                </div>
              </div>
              @endif
              <p align="right">
                <button type="submit" class="btn btn-success">Register</button>
                <button type="button" class="btn btn-primary mb-2"  onclick="window.location='{{url("user/events")}}'"><i class="fa fa-close"></i> Back</button>

              </p>

        </form>
      </div>
      <div class="col-md-6">

      </div>
    </div>


    <div class="modal fade" id="donation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="window.location='{{url("user/events")}}'" class="btn btn-primary">Save changes</a>
          </div>
        </div>
      </div>
      <!-- /.box-body -->



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