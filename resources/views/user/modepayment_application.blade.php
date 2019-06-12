@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')
<style>
    div .box1 {
        background-color: white;
        width: 700px;
        border: 2px solid gray;
        padding: 10px;

    }

    div .box2 {
        background-color: white;
        width: 300px;
        border: 2px solid gray;
        padding: 10px;

    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @if(!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
            ->where('application_status', '=','verified')->where('application_description','insured')->first())
            <small>PREMIUM</small>
            @else
            <small>INSURED</small>

            @endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Mode of Payment</h3>

            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="box1">
                            <h3>UPGRADE FEE</h3>
                            @if(!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
                            ->where('application_status', '=','verified')->where('application_description','insured')->first())
                            <h4>Amount: 220</h4>
                            @else
                            <h4>Amount: 500</h4>
                            @endif


                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <hr>
                            <button type="button" class="btn btn-primary mb-2" onclick="window.location='{{url('user/application_bank')}}'"><i class="fa fa-bank"></i> Bank Deposit</button>
                            <button type="button" class="btn btn-primary mb-2" onclick="window.location='{{url('user/application_paypal')}}'"><i class="fa fa-paypal"></i> PayPal</button>

                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="box2">
                            <center>
                                <h3>Payment Summary</h3>
                                <hr>

                                @if(!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
                                ->where('application_status', '=','verified')->where('application_description','insured')->first())
                                <div class="col-md-6">Base Fee:</div>
                                <div class="col-md-6">220 PHP </div>
                                @else
                                <div class="col-md-6">Base Fee:</div>
                                <div class="col-md-6">500 PHP </div>

                                @endif

                                <br>
                                <br>

                                @if(!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
                                ->where('application_status', '=','verified')->where('application_description','insured')->first())
                                <div class="col-md-6">Subtotal:</div>
                                <div class="col-md-6">220 PHP </div>
                                @else
                                <div class="col-md-6">Base Fee:</div>
                                <div class="col-md-6">500 PHP </div>

                                @endif
                                <br>
                                <br>

                                <hr>
                                @if(!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
                                ->where('application_status', '=','verified')->where('application_description','insured')->first())
                                <h1> TOTAL: 220 PHP </h1>
                                @else
                                <h1> TOTAL: 500 PHP </h1>
                                @endif


                            </center>
                        </div>


                    </div>

                </div>
            </div>
            <!-- /.box-body -->
            <br>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('user.user_includes.footer')