@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PayPal Payment
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Mode of Payment</a></li>
            <li class="active">PayPal Payment</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">PayPal Payment</h3>

            </div>
            <div class="box-body">

                <h3>PAYMENT SUMMARY</h3> <br>

                <h4> <strong>Base Fee: </strong>
                @if(!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
                ->where('application_status', '=','verified')->where('application_description','insured')->first())
                 220 PHP </h4>
                @else
                500</h4>
                @endif

                <h4> <strong>Online Transaction Fee: </strong> 150 PHP </h4>
                <h4> <strong>Total Amount Due: </strong>
                @if(!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
                ->where('application_status', '=','verified')->where('application_description','insured')->first())
                 370 PHP </h4>
                @else
                650</h4>
                @endif
                <br>

                <strong> Note: After payment do not close the paypal page until you will be redirected to your dashboard in order to save the payment information. </strong>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">

                <script src="https://www.paypal.com/sdk/js?client-id=AbGnKOw7mQdj4DBfBvyzBuzyMKnpwbT5CBGjAi5gYphRGllGuJDd0aeRwcOHZrsc5BSibAn3qDYPmHIz&currency=PHP">
                </script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>



                <div id="paypal-button-container"></div>




                <p align="right">
                    <button type="button" class="btn btn-primary mb-2" onclick="window.location='{{url("user/application_paymentmethod/")}}'"><i class="fa fa-close"></i>
                        Back
                    </button>
                </p>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>


@include('user.user_includes.footer')

@if(!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
->where('application_status', '=','verified')->where('application_description','insured')->first())
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: 220 + 150
                    },

                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {

                Swal.fire('Success!', 'Your Payment has been submitted! Please wait for your payment to be verified. Thank You!', 'success');
                location.href = "{{url('/user/dopaypal/'. $events->id)}}"

                // Call your server to save the transaction

                return fetch('/paypal-transaction-complete', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                });
            });
        }
    }).render('#paypal-button-container');
</script>
@else
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: 500 + 150
                    },

                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {

                Swal.fire('Success!', 'Your Payment has been submitted! Please wait for your payment to be verified. Thank You!', 'success');
                location.href = "{{url('/user/dopaypal/')}}"

                // Call your server to save the transaction

                return fetch('/paypal-transaction-complete', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                });
            });
        }
    }).render('#paypal-button-container');
</script>
@endif
