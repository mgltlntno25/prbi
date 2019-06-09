<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("/img/islaw.png")}}" />
    <title>Pinoy Road Biker Inc.</title>
</head>

<body>

    <font face="courier new" size="2">
        <table width="900">
            <tr>
                <th colspan="5"> {{$events->event_name}}</th>
            </tr>
            <tr>
                <td>
                </td>
            </tr>

            <td colspan="2">Event Location: {{$events->location}}</td>
            <td></td>
            <td colspan="2">Event Date: {{$events->event_date}}</td>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
            <tr>
                <td>PRBI ID</td>
                <td>NAME</td>
                <td>EMAIL</td>
                <td>AGE</td>
                <td>CATEGORY</td>
            </tr>

            @foreach($events_list as $event)
            <tr>
                <td>{{$event->prbi_id}}</td>
                <td>{{$event->user_name}}</td>
                <td>{{$event->user_email}}</td>
                <td>{{$event->user_age}}</td>
                <td>{{$event->category}}</td>
            </tr>


            @endforeach
        </table>
    </font>



</body>