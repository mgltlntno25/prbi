@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Announcements
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Announcements</a></li>
            <li class="active">Main</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    
        <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <br>
        <br>
        <ul class="timeline">

            <!-- timeline time label -->
        
            @foreach($announcements as $announcement)
            <li class="time-label">
                <span class="bg-red">
                    {{$announcement->created_at->format('m-d-Y')}}
                </span>
            </li>
            <!-- /.timeline-label -->

            <!-- timeline item -->

            <li>
                <!-- timeline icon -->
                <i class="fa fa-microphone bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i></span>

                    <h3 class="timeline-header"><a href="#">{{$announcement->title}}</a> ...</h3>

                    <div class="timeline-body">
                        {!! $announcement->description !!}
                    </div>

                    <div class="timeline-footer">

                    </div>
                </div>
            </li>
            <!-- END timeline item -->
            @endforeach
           

            ...

        </ul>

    </section>
    <!-- /.content -->
</div>


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->







@include('user.user_includes.footer')