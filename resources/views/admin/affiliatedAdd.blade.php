@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa <fa-image></fa-image>"></i> Admin Accounts</a></li>
            <li class="active">Create</li>
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
                <form action="/admin/doaffiliatedstore" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Store Name</label>
                        <input type="text" class="form-control" name="store_name" placeholder="Store Name" value="{{ old('store_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Store Owner</label>
                        <input type="text" class="form-control" name="store_owner" placeholder="Store Owner" value="{{ old('store_owner') }}">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Contact</label>
                        <input type="number" class="form-control" name="contact" placeholder="Contact" value="{{ old('contact') }}">
                    </div>


                    <p align="right">
                        <button type="submit" class="btn btn-success mb-2"><i class="fa fa-check"></i> Submit</button>
                        <button type="button" class="btn btn-primary mb-2" onclick="window.location='{{url("admin/affiliatedMain")}}'"><i class="fa fa-close"></i>
                            Back
                        </button>
                    </p>

                </form>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.admin_includes.footer')