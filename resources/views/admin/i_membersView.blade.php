@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Insured Members
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-user"></i> Insured Members</a></li>
      <li>Main</li>
      <li class="active">{{$member->first_name . ' ' . $member->last_name}}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"> </h3>

        <div class="container">
          </p>
          <div class="row">
            <div class="panel-body">
              <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                <img alt="User Pic" src="{{asset("/img/userdp/". $member->profile_image)}}" id="profile-image1" class="img-circle img-responsive">
                <br>
                <br>
                <a href="{{url('admin/i_card/' . $member->id)}}" target="_blank" type="button" class="btn btn-primary mb-2"><i class="fa fa-user"> </i> View Membership Card</a>
              </div>
              <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                <div class="container">
                  <h2>{{$member->first_name}} {{$member->last_name}}</h2>
                  @if($member->isPremium == 0)
                  <p> a <b>Regular Member </b></p>
                  @elseif($member->isPremium == 1 && $member->isInsured == 0)
                  <p> a <b> Premium Member</b></p>
                  @elseif($member->isPremium == 1 && $member->isInsured == 1)
                  <p> an <b>Insured Member</b></p>
                  @endif
                  <p> PRBI-ID: <b>{{$member->prbi_id}}</b></p>
                </div>
                <hr>
                <ul class="container details">
                  <li>
                    <p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{$member->email}}</p>
                  </li>
                  <li>
                    <p><span class="glyphicon glyphicon-phone one" style="width:50px;"></span>{{$member->contact}}</p>
                  </li>
                  <li>
                    <p><span class="glyphicon glyphicon-home one" style="width:50px;"></span>{{$member->address}}</p>
                  </li>
                  <li>
                    <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>{{$member->birthday}}</p>
                  </li>
                  <li>
                    <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>{{$member->gender}}</p>
                  </li>
                </ul>
                <hr>
                <b> Emergency Information </b><br><br>
                <ul class="container details">
                  <li>
                    <p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{$member->emergency_name}}</p>
                  </li>
                  <li>
                    <p><span class="glyphicon glyphicon-phone one" style="width:50px;"></span>{{$member->emergency_contact}}</p>
                  </li>
                </ul>
                <hr>
                <div class="col-sm-12 col-xs-6 tital ">
                  Date Of Joining : {{$member->created_at->format('m/d/Y')}} <br>
                  Updated At : {{$member->updated_at->format('m/d/Y')}} <br>

                </div>
              </div>
            </div>
          </div>


        </div>

      </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.admin_includes.footer')