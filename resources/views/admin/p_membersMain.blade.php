@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Premium
      <small>Members</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-users"></i> Premium Members</a></li>
      <li class="active">Main</li>
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
        <h3 class="box-title"></h3>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
        @endif
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>PRBI ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>Contact No.</th>
              <th>QR Code </th>
              <th>Status</th>
              <th>Actions </th>
            </tr>
          </thead>
          <tbody>
            @foreach($members as $member)
            <tr>
              <td>{{$member->id}}</td>
              <td>{{$member->prbi_id}}</td>
              <td><img src="{{ url("/img/userdp/". $member->profile_image) }}" height="80" width="80"></td>
              <td>{{$member->first_name}} {{$member->last_name}}</td>
              <td>{{$member->email}}</td>
              <td>{{$member->contact}}</td>
              <td><img src="{{ url("img/qrcode/". $member->qrcode) }}" height="80" width="80"></td>
              <td>{{$member->status}}</td>

              <td><button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View Member" onclick="window.location='{{url("admin/premium_members/" . $member->id)}}'"><i class="fa fa-eye"></i> </button>
                @if($member->status == 'active')
                <button type="button" class="btn btn-danger" data-placement="top" title="Deactivate Account" data-toggle="modal" data-target="#statusModal{{ $member->id }}"><i class="fa fa-close"></i>
                </button>
                @elseif($member->status == 'inactive')
                <button type="button" class="btn btn-success" data-placement="top" title="Activate Account" data-toggle="modal" data-target="#statusModal{{ $member->id }}"><i class="fa fa-check"></i>
                </button>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="statusModal{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Do you really want to change the status of
                        <b>{{ $member->email }} </b>?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        <a type="button" href="{{ url('/admin/dochangestatusmember/'. $member->id) }}" class="btn btn-primary">Save changes</a>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>

            <!-- modal  View-->
            <div class="modal fade" id="view-modal{{ $member->id }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Member Profile</h4>
                  </div>
                  <div class="modal-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-3">
                          <img src="{{ url("/img/userdp/". $member->profile_image) }}"></td>

                        </div>
                        <br>
                        <div class="col-md-4">
                          <label for="formGroupExampleInput">ID :</label>
                          {{ $member->prbi_id }}<br>

                          <label for="formGroupExampleInput">First Name :</label>
                          {{$member->first_name }}<br>

                          <label for="formGroupExampleInput">Last Name :</label>
                          {{$member->last_name }} <br>

                          <label for="formGroupExampleInput">Email :</label>
                          {{ $member->email }} <br>

                          <label for="formGroupExampleInput">Contact :</label>
                          {{ $member->contact }} <br>

                          <label for="formGroupExampleInput">Status :</label>
                          @if($member->status == 'active')
                          <font color="green">{{ $member->status }}</font><br>
                          @elseif($member->status == 'inactive')
                          <font color="red">{{ $member->status }}</font><br>
                          @endif

                          <label for="formGroupExampleInput">Created At :</label>
                          {{ $member->created_at }} <br>

                          <label for="formGroupExampleInput">Updated At :</label>
                          {{ $member->updated_at }} <br>
                        </div>
                        <div class="col-md-6">
                        </div>
                      </div>
                    </div>
                  </div>
                  @if($member->isPremium == 1)

                  <div class="id-card-holder">
                    <div class="id-card">
                      <div class="qr-code">
                        <p align="right">
                          <img src="{{ url("/img/qrcode/". $member->qrcode) }}">
                        </p>
                      </div>
                      <div class="photo">
                        <p align=" left">
                          <img src="{{ url("/img/userdp/". $member->profile_image) }}">
                        </p>
                      </div>
                      <div class="text">
                        {{$member->first_name}} {{$member->last_name}}
                      </div>
                      <div class="mobile">
                        {{$member->contact}}
                      </div>
                      <div class="bday">
                        {{$member->birthday}}
                      </div>
                      <div class="emname">
                        {{$member->emergency_name}}
                      </div>
                      <div class="emcontact">
                        {{$member->emergency_contact}}
                      </div>
                      <div class="address">
                        {{$member->address}}
                      </div>

                    </div>

                  </div>
                </div>

                @endif

                <div class="modal-footer">
                  <p align="right">
                    <button type="button" class="btn btn-primary mb-2" data-dismiss="modal"><i class="fa fa-close"></i>
                      Back
                    </button>
                  </p>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      @endforeach
      </tbody>
      <tfoot>
      </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.admin_includes.footer')