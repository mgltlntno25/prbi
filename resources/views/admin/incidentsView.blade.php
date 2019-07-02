@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin="" />
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
    integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
    crossorigin=""></script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            INCIDENTS
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Banners</a></li>
            <li class="active">Add</li>
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

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form>

                    <br>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Sender Name</label>
                        <input type="name" class="form-control" id="formGroupExampleInput" placeholder=""
                            value="{{$ireports->user_name}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Sender Email</label>
                        <input type="email" class="form-control" id="formGroupExampleInput" placeholder=""
                            value="{{$ireports->user_email}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Sender Contact Number</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder=""
                            value="{{$ireports->user_contact}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Incident image</label>
                        <br>
                        <center>
                            <img src="{{ url("/img/incident_report/". $ireports->report_image) }}" height="300"
                                width="50%">
                        </center>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Date</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder=""
                            value="{{$ireports->created_at}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Details</label>
                        <textarea class="form-control" disabled> {{$ireports->report_details}} </textarea>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Location</label>

                        <div id="mapid" style="width: 100%; height: 400px;"></div>

                    </div>



                    <p align="right"> <button type="submit" class="btn btn-success mb-2"><i class="fa fa-check"></i>
                            Verify</button>
                        <button type="button" class="btn btn-primary mb-2"
                            onclick="window.location='{{url("admin/incidentsMain")}}'"><i class="fa fa-close"></i>
                            Back</button></p>
                    </p>
                </form>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.admin_includes.footer')
<script>
var mymap = L.map('mapid').setView([{{$ireports->longitude}}, {{$ireports->latitude}}], 13);

L.tileLayer(
    'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox.streets'
    }).addTo(mymap);

L.marker([{{$ireports->longitude}}, {{$ireports->latitude}}]).addTo(mymap)
    .bindPopup("<b>INCIDENT!</b><br />{{$ireports->report_details}}").openPopup();

var popup = L.popup();



mymap.on('click', onMapClick);
</script>