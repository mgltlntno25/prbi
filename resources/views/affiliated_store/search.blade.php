@include('affiliated_store.affstore_includes.header')
@include('affiliated_store.affstore_includes.header_navbar')
@include('affiliated_store.affstore_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Search Member
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-search"></i> Search</a></li>
            <li class="active">Main</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
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

                <form action="/affiliatedstore/search" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Search PRBI-ID..."> <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>

                <br>
                <br>
                <br>
                <div class="container">
                    @if(isset($details))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        User found!
                    </div>
                    <h2>User Details : </h2>
                    <br>
                    @foreach($details as $user)
                    <div class="row">
                        <div class="panel-body">
                            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                                <img alt="User Pic" src="{{asset("/img/userdp/". $user->profile_image)}}" id="profile-image1" class="img-circle img-responsive">
                                <br>
                                <br>
                            </div>
                            <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                                <div class="container">
                                    <h2>{{$user->first_name}} {{$user->last_name}}</h2>

                                    @if($user->isPremium == 0 )

                                    <p>a <b>
                                            REGULAR MEMBER

                                            @elseif($user->isPremium == 1 && $user->isInsured == 0)
                                            <p>a <b>
                                                    PREMIUM MEMBER

                                                    @elseif($user->isPremium == 1 && $user->isInsured == 1)
                                                    <p>an <b>
                                                            INSURED MEMBER

                                                            @endif

                                                        </b></p>
                                </div>
                                <hr>
                                <ul class="container details">
                                    <li>
                                        <p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{$user->email}}</p>
                                    </li>
                                    <li>
                                        <p><span class="glyphicon glyphicon-phone one" style="width:50px;"></span>{{$user->contact}}</p>
                                    </li>
                                    @if($user->address != '')
                                    <li>
                                        <p><span class="glyphicon glyphicon-home one" style="width:50px;"></span>{{$user->address}}</p>
                                    </li>
                                    @endif
                                    @if($user->gender != '')
                                    <li>
                                        <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>{{$user->gender}}</p>
                                    </li>
                                    @endif
                                    @if($user->birthday != '')
                                    <li>
                                        <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>{{$user->birthday}}</p>
                                    </li>
                                    @endif
                                    <li>
                                        <p><span class="glyphicon glyphicon-check one" style="width:50px;"></span>{{$user->status}}</p>
                                    </li>
                                </ul>
                                <hr>
                                <div class="col-sm-5 col-xs-6 tital ">Date Of Joining: {{$user->created_at->format('m/d/Y')}}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @else
                    @if(isset($message))
                    <div class="alert alert-danger">{{$message}}</div>
                    @endif
                    @endif

                </div>

            </div> <!-- /.box-body -->
            <div class="box-footer">

            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->






@include('affiliated_store.affstore_includes.footer')