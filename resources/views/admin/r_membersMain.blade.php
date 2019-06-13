@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Regular
      <small>Members</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-users"></i> Regular Members</a></li>
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
              <td>{{$member->status}}</td>
              <td><button type="button" class="btn btn-info" data-placement="top" title="View Member" data-toggle="modal" data-target="#view-modal{{$member->id}}"><i class="fa fa-eye"></i> </button>
                @if($member->status == 'active')
                <button type="button" class="btn btn-danger" data-placement="top" title="Deactivate User" data-toggle="modal" data-target="#statusModal{{ $member->id }}"><i class="fa fa-close"></i>
                </button>
                @elseif($member->status == 'inactive')
                <button type="button" class="btn btn-success" data-placement="top" title="Activate User" data-toggle="modal" data-target="#statusModal{{ $member->id }}"><i class="fa fa-check"></i>
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
                        <div class="panel-body">
                          <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                            <img alt="User Pic" src="{{asset("/img/userdp/". $member->profile_image)}}" id="profile-image1" class="img-circle img-responsive">
                          </div>
                          <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                            <div class="container">
                              <h2>{{$member->first_name}} {{$member->last_name}}</h2>
                              @if($member->isPremium == 0)
                              <p> a <b>Regular Member </b></p>
                              @elseif($member->isPremium == 1 && $member->isInsured == 0)
                              <p> a <b> Premium Member</b></p>
                              @elseif($member->isPremium == 1 && $member->isInsured == 1)
                              <p> a <b>Insured Member</b></p>
                              @endif
                              <p> PRBI-ID: <b>{{$member->prbi_id}}</b></p>
                            </div>
                            <hr>
                            <ul class="container details">
                              <li>
                                <p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{$member->email}}</p>
                              </li>
                              <li>
                                <p><span class="glyphicon glyphicon-phone one" style="width:50px;"></span>{{$member->contact}}</p>
                              </li>
                              <li>
                                <p><span class="glyphicon glyphicon-home one" style="width:50px;"></span>{{$member->address}}</p>
                              </li>
                              <li>
                                <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>{{$member->birthday}}</p>
                              </li>
                              <li>
                                <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>{{$member->gender}}</p>
                              </li>
                            </ul>
                            <hr>
                            <b> Emergency Information </b><br><br>
                            <ul class="container details">
                              <li>
                                <p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{$member->emergency_name}}</p>
                              </li>
                              <li>
                                <p><span class="glyphicon glyphicon-phone one" style="width:50px;"></span>{{$member->emergency_contact}}</p>
                              </li>
                            </ul>
                            <hr>
                            <div class="col-sm-12 col-xs-6 tital ">
                              Date Of Joining : {{$member->created_at->format('m/d/Y')}} <br>
                              Updated At : {{$member->updated_at->format('m/d/Y')}} <br>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

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
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.admin_includes.footer')