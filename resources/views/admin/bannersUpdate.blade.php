@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Update Banner
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/admin/banners')}}"><i class="fa <fa-image></fa-image>"></i> Banners</a></li>
      <li class="active">Update Banner {{$banners->id}}</li>
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


        <!-- /.box-header -->
        <div class="box-body">
          <img src="{{ url("/img/banners/". $banners->banner_image) }}" height="350" width="100%">
          <br>
          <br>
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
        </div>
        <form action="{{url('admin/doupdatebanner/' . $banners->id )}}" method='post' enctype='multipart/form-data'>
          {{ csrf_field() }}
          <div class="form-group">
            <label for="formGroupExampleInput">Image</label><br>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#image"><i class="fa fa-image"></i> Update Image </button>
            <!-- <input type="file" class="form-control" name="banner_image" placeholder="Name"> -->
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Title" value="{{$banners->title}}">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2">Description</label>
            <textarea class="form-control" name="description">{{$banners->description}}</textarea>
          </div>

          <p align="right">
            <button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#updateModal"><i class="fa fa-edit"></i> Update </button>
            <button type="button" onclick="window.location='{{url("admin/banners/")}}'" class="btn btn-primary mb-2"><i class="fa fa-close"></i>
              Back
            </button>
          </p>
          <!-- Modal -->
          <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Change Banner</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Do you really want to update this banner?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                  </button>
                  <button type="submit" class="btn btn-primary">Save changes</a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Change Banner Image</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{url('admin/doupdatebannerimage/' . $banners->id )}}" method='post' enctype='multipart/form-data'>
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="formGroupExampleInput">Image</label><br>
                  <input type="file" class="form-control" name="banner_image" placeholder="Name">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
              </button>
              <button type="submit" class="btn btn-primary">Save changes</a>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.admin_includes.footer')