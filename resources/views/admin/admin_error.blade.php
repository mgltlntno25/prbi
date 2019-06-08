@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')




<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
        </ol>
    </section>

    <section class="content container-fluid">
        <div class="box">
            <div class="container">
                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">
                            <p align="center">
                                <img src="{{asset('img/error_img.gif')}}">
                                <br>
                            </p>
                            <section class="content">
                                <div class="error-page">
                                    

                                    <div class="error-content">
                                        <h4><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h4>
                                        <p>
                                            We could not find the page you were looking for.
                                            Meanwhile, you may <a href="{{ url('/admin/dashboard/') }}">return to dashboard</a>.
                                        </p>
                                    </div>
                                </div>
                            </section>
                            <br>
                            <br>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>







@include('admin.admin_includes.footer')