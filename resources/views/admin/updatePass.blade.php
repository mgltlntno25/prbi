@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update
            <small>Password</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>

        </ol>
    </section>


    <section class="content container-fluid">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"> </h3>

                <div class="container">
                    <div class="row">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form action='/admin/doaddevent' method='post' >
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">New Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="New Password">
                                    </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Re-Type Password</label>
                                    <input type="password" class="form-control" name="repassword" placeholder="Re-Type Password">
                                </div>
                                <p align="right"> <button type="button" class="btn btn-warning mb-2"><i class="fa fa-edit"></i> Update </button>
                                </p>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>

</div>

</section>
</div>




@include('admin.admin_includes.footer')