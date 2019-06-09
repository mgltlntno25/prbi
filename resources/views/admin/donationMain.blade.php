@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Donations
      <small>Dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Donations</a></li>
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
              <th>Name</th>
              <th>Email</th>
              <th>Transaction Number</th>
              <th>Bank Payment Date</th>
              <th>Image</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($donations as $donation)
            <tr>
              <td>{{$donation->id}}</td>
              <td>{{$donation->user_name}}</td>
              <td>{{$donation->user_email}}</td>
              <td>{{$donation->trans_number}}</td>
              <td>{{$donation->bank_date}}</td>

              <td><button type="button" class="btn btn-info" data-placement="top" title="View Image" data-toggle="modal" data-target="#view-modal{{$donation->id}}"><i class="fa fa-eye"></i> </td>
              <td>{{$donation->status}}</td>
              <td>
                @if($donation->status == 'inactive')
                <button type="button" class="btn btn-success" data-placement="top" title="Verify Donation" data-toggle="modal" data-target="#statusModal{{ $donation->id }}"><i class="fa fa-check"></i>
                </button>
                @endif
                @if($donation->status == 'inactive')
                <button type="button" class="btn btn-warning" data-placement="top" title="Reject Donation" data-toggle="modal" data-target="#rejectModal{{ $donation->id }}"><i class="fa fa-close"></i>
                </button>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="statusModal{{ $donation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Do you really want to verify the donation of
                        <b>{{ $donation->user_name }} </b>?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        <a type="button" href="{{ url('/admin/doverifydonation/'. $donation->id) }}" class="btn btn-primary">Save changes</a>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="rejectModal{{ $donation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reject Donation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Do you really want to reject the donation of
                        <b>{{ $donation->user_name }} </b>?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        <a type="button" href="{{ url('/admin/dorejectdonation/'. $donation->id) }}" class="btn btn-primary">Save changes</a>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <div class="modal fade" id="view-modal{{ $donation->id }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{$donation->trans_number}}</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="formGroupExampleInput"></label>
                      <img src="{{ url("/img/donation/". $donation->deposit_image) }}" height="250" width="570">
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
        </table>
        <br>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->



  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.admin_includes.footer')