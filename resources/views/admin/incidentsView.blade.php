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

          
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            


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


                    <br>

                    <p align="right"> 
                    @if($ireports->status == 'rejected')

                    <button type="button" class="btn btn-primary mb-2"
                            onclick="window.location='{{url("admin/incidents")}}'"><i class="fa fa-close"></i>
                            Back</button></p>
                    @elseif($ireports->status == 'verified')

                    <button type="button" class="btn btn-primary mb-2"
                            onclick="window.location='{{url("admin/incidents")}}'"><i class="fa fa-close"></i>
                            Back</button></p>

                    @else
                      <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#reject"><i class="fa fa-close"></i> Reject</button>
                      <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#verify"><i class="fa fa-check"></i> Verify</button>
                      <button type="button" class="btn btn-primary mb-2"
                            onclick="window.location='{{url("admin/incidents")}}'"><i class="fa fa-close"></i>
                            Back</button></p>
                  
                    @endif
                    

                        
                    </p>
                </form>

                <!-- modal reject -->
                <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reject Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Do you really want to reject this Incident Report No.
                        <b>{{ $ireports->id }} </b>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        <a type="button" href="{{ url('/admin/report/doreject/'. $ireports->id) }}" class="btn btn-danger">Reject</a>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- modal verifiy -->

                <div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verify Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Do you really want to verify this Incident Report No.
                        <b>{{ $ireports->id }} </b>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        <a type="button" href="{{ url('/admin/report/doverify/'. $ireports->id) }}" class="btn btn-success">Verify</a>
                      </div>
                    </div>
                  </div>
                </div>

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
var mymap = L.map('mapid').setView([{{$ireports->latitude}}, {{$ireports->longitude}}], 13);

L.tileLayer(
    'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox.streets'
    }).addTo(mymap);

L.marker([{{$ireports->latitude}}, {{$ireports->longitude}}]).addTo(mymap)
    .bindPopup("<b>INCIDENT!</b><br />{{$ireports->report_details}} <br /> {{$ireports->longitude}}, {{$ireports->latitude}}").openPopup();

var popup = L.popup();



mymap.on('click', onMapClick);
</script>