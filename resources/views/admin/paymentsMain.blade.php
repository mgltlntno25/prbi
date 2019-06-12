@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Payments
      <small>Dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Payments</a></li>
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
            @foreach($payments as $payment)
            <tr>
              <td>{{$payment->id}}</td>
              <td>{{$payment->user_name}}</td>
              <td>{{$payment->user_email}}</td>
              <td>{{$payment->trans_number}}</td>
              <td>{{$payment->bank_date}}</td>



              @if($payment->deposit_image != "paypal")
              <td><button type="button" class="btn btn-info" data-placement="top" title="View Image" data-toggle="modal" data-target="#view-modal{{$payment->id}}"><i class="fa fa-eye"></i> </td>
              @else
              <td> VIA PAYPAL </td>
              @endif
              <td>{{$payment->status}}</td>
              <td>
                @if($payment->status == 'submitted')
                <button type="button" class="btn btn-success" data-placement="top" title="Verify Payment" data-toggle="modal" data-target="#statusModal{{ $payment->id }}"><i class="fa fa-check"></i>
                </button>
                @endif
                @if($payment->status == 'submitted')
                <button type="button" class="btn btn-warning" data-placement="top" title="Reject Payment" data-toggle="modal" data-target="#rejectModal{{ $payment->id }}"><i class="fa fa-close"></i>
                </button>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="statusModal{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Do you really want to verify the payment of
                        <b>{{ $payment->user_name }} </b>?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        @if($payment->payment_description == 'insured' || $payment->payment_description == 'premium')

                        <a type="button" href="{{ url('/admin/doverifyapplicationpayment/'. $payment->id) }}" class="btn btn-primary">Save changes</a>

                        @else

                        <a type="button" href="{{ url('/admin/doverifypayment/'. $payment->id) }}" class="btn btn-primary">Save changes</a>

                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="rejectModal{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reject Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Do you really want to reject the payment of
                        <b>{{ $payment->user_name }} </b>?

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        @if($payment->payment_description == 'insured' || $payment->payment_description == 'premium')

                        <a type="button" href="{{ url('/admin/dorejectapplicationpayment/'. $payment->id) }}" class="btn btn-primary">Save changes</a>

                        @else

                        <a type="button" href="{{ url('/admin/dorejectpayment/'. $payment->id) }}" class="btn btn-primary">Save changes</a>

                        @endif
                      </div>
                    </div>
                  </div>
                </div>

              </td>
            </tr>
            <div class="modal fade" id="view-modal{{ $payment->id }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{$payment->trans_number}}</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="formGroupExampleInput"></label>
                      <img src="{{ url("/img/payments/". $payment->deposit_image) }}" height="250" width="570">
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