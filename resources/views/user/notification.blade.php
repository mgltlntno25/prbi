@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')






<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3> NOTIFICATIONS </h3>
        <ol class="breadcrumb">
        </ol>
    </section>

    <section class="content container-fluid">
        <div class="box">

            <div class="container">
                <div class="col-md-12">
                    <br>
                    <label> TODAY </label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Message</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifications_today as $notification)
                            <tr>
                                <td>{{$notification->date}}</td>
                                <td>{{$notification->message}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <label> PAST </label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Message</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifications_past as $notification_p)
                            <tr>
                                <td>{{$notification_p->date}}</td>
                                <td>{{$notification_p->message}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

</div>





@include('user.user_includes.footer')