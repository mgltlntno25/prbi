@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')

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
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
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
              <th>Amount</th>
              <th>Image</th>
              <th>Status</th>
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
              <td>{{$donation->amount}}</td>


              <td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#view-modal{{$donation->id}}"><i class="fa fa-eye"></i> </td>
              <td>{{$donation->status}}</td>
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
        <p align="right">
          <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#add-modal"><i class="fa fa-heart"></i> Donate</button>
        </p>
      </div>
      <!-- modal  Create-->
      <div class="modal fade" id="add-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">DONATE</h4>
            </div>
            <div class="modal-body">
              <form action='{{url('/user/doadddonation')}}' method='post' enctype='multipart/form-data'>
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="formGroupExampleInput">Image</label>
                  <input type="file" class="form-control" name="deposit_image">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput">Transaction Number</label>
                  <input type="text" class="form-control" name="trans_number" placeholder="" value="{{old('trans_number')}}">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Bank Date</label>
                  <input type="date" class="form-control" name="bank_date" value="{{old('bank_date')}}">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput">Amount</label>
                  <input type="number" class="form-control" name="amount" placeholder="" value="{{old('amount')}}">
                </div>
            </div>
            <div class="modal-footer">
              <p align="right">
                <button type="submit" class="btn btn-success mb-2"><i class="fa fa-check"></i> Submit</button>
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
      <!-- /.box-body -->
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



@include('user.user_includes.footer')