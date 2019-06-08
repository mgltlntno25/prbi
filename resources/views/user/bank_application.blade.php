@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')
<style>
    div .box1 {
        background-color: white;
        width: 1080px;
        border: 2px solid gray;
        padding: 10px;

    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            BANK DEPOSIT
            <small></small>
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
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box-body" style="color: rgb(51, 51, 51); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;">
                                        <div class="row site-box-view" style="margin-left: -10px; margin-right: -10px; border: none;">
                                            <div class="col-md-6" style="width: 553px; font-size: 15px;">
                                                <h5 style="font-family: &quot;Source Sans Pro&quot;, sans-serif; font-size: 20px; text-transform: uppercase;">THANK YOU FOR SUBMITTING YOUR APPLICATION!</h5>Kindly send your payment to the Organizer's account as follows:&nbsp;<br>
                                                <br>
                                                <br>
                                                <label> BDO </label><br>
                                                Account Name: Juan Miguel Tolentino
                                                <br>
                                                Branch: Apalit Pampanga
                                                <br>
                                                Account Number: 1251579

                                                <br>
                                                <br>
                                                <br>

                                                <label> BPI </label><br>
                                                Account Name: Juan Miguel Tolentino
                                                <br>
                                                Branch: Apalit Pampanga
                                                <br>
                                                Account Number: 1251579


                                                <br>
                                                <br>
                                                <br>

                                                @if(!App\Application_List::where('user_id', '=', Auth::guard('user')->user()->prbi_id)
                                                ->where('application_status', '=','submitted')->where('application_description','insured')->first()
                                                )
                                                <p style="font-size: 25px; font-weight: bold;">Amount to be paid:&nbsp;
                                                    220 PHP</p>

                                                @else

                                                <p style="font-size: 25px; font-weight: bold;">Amount to be paid:&nbsp;
                                                    500 PHP</p>

                                                @endif

                                                <p>After payment, please take a photo of your deposit slip and upload it here.</p>
                                            </div>
                                        </div>
                                        <div class="row" style="border-top: 1px solid rgb(244, 244, 244);">
                                            <div class="col-md-12" style="width: 1116px; font-size: 15px;">
                                                <p style="margin-top: 5px;">Your payment status will be updated after verification of your submitted deposit slip.</p>
                                                <p style="margin-bottom: 0px;">Thank you very much!</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div><br></div>

                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <form action="{{url('/user/doapplicationbank/')}}" method="post" enctype='multipart/form-data'>
                                        {{ csrf_field() }}


                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Desposit Slip Image</label>
                                            <input type="file" class="form-control" name="deposit_image" placeholder="">
                                        </div>


                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Transaction/Reference Number</label>
                                            <input type="text" class="form-control" name="trans_number" placeholder="Reference Number" value="{{old('trans_number')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Bank Deposit Date</label>
                                            <input type="date" class="form-control" name="bank_date" placeholder="Link" value="{{old('bank_date')}}">
                                        </div>
                                        <p align="right"><button type="submit" class="btn btn-success mb-2"><i class="fa fa-bank"></i> Submit</button>
                                        </p>
                                    </form>



                                </div>

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