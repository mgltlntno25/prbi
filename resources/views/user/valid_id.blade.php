@include('user.user_includes.header')
@include('user.user_includes.header_navbar')
@include('user.user_includes.sidebar')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            user
            <small>Profile</small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>

        </ol>
    </section>



    <section class="content">

        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif

            <div class="col-md-12">
                <div class="box box-passive">
                    <div class="box-header with-border">
                        <h3 class="box-title">Personal Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{url('user/doupgrade/step2')}}" method="post" enctype='multipart/form-data'>
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Upload a valid ID</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <input type="file" class="form-control" name="valid_id" placeholder="First Name">
                                </div>
                            </div>
                            <p align="right"> <button type="submit" class="btn btn-success mb-2"><i class="fa fa-upload"></i> Upload ID </button>

                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
</div>

@include('user.user_includes.footer')