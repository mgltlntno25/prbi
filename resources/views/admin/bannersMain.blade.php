@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Banners
      <small>Dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa <fa-image></fa-image>"></i> Banners</li>
      <li class="active">Main</li>
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
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <h3 class="box-title"></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Title</th>
              <th>Description</th>
              <th> Status </th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($banners as $banner)
            <tr>
              <td>{{$banner->id}} </td>
              <td><img src="{{ url("/img/banners_thumb/". $banner->banner_image) }}"></td>
              <td>{{$banner->title}} </td>
              <td>{{$banner->description}} </td>
              <td>{{$banner->status}} </td>
              <td>
                <button type="button" class="btn btn-info"  data-placement="top" title="View Banner" data-toggle="modal" data-target="#view-modal{{$banner->id}}"><i class="fa fa-eye"></i></button>
                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Update Banner" onclick="window.location='{{url("admin/banners/" . $banner->id)}}'"><i class="fa fa-edit"></i></button>
                @if($banner->status == 'active')
                <button type="button" class="btn btn-danger" data-toggle="modal"  data-placement="top" title="Deactive Banner" data-target="#statusModal{{ $banner->id }}"><i class="fa fa-close"></i>
                </button>
                @elseif($banner->status == 'inactive')
                <button type="button" class="btn btn-success" data-toggle="modal"  data-placement="top" title="Activate Banner" data-target="#statusModal{{ $banner->id }}"><i class="fa fa-check"></i>
                </button>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="statusModal{{ $banner->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Do you really want to change the status of
                        <b>{{ $banner->title }} </b>?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        <a type="button" href="{{ url('/admin/dochangestatusbanner/'. $banner->id) }}" class="btn btn-primary">Save changes</a>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>

            <!-- modal  View-->
            <div class="modal fade" id="view-modal{{ $banner->id }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><b>{{$banner->title}}</b></h4>
                  </div>
                  <div class="modal-body">
                    <img src="{{ url("/img/banners/". $banner->banner_image) }}" height="250" width="570">
                    <br>
                    <br>
                    <div class="form-group">
                      <label for="formGroupExampleInput">Title</label>
                      <input type="text" class="form-control" name="title" placeholder="Title" value="{{$banner->title}}">
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput2">Description</label>
                      <textarea class="form-control" name="description">{{$banner->description}}</textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <p align="right">
                      <button type="button" class="btn btn-primary mb-2" data-dismiss="modal"><i class="fa fa-close"></i>
                        Back
                      </button>
                    </p>
                  </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            @endforeach
          </tbody>
          <tfoot>
          </tfoot>
        </table>
        <br>
        <p align="right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addmodal"> <i class="fa fa-plus"></i> Add Banner </button>
        </p>
        <!-- modal  Create-->
        <div class="modal fade" id="addmodal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CREATE BANNER</h4>
              </div>
              <div class="modal-body">

                <form action='/admin/doaddbanner' method='post' enctype='multipart/form-data'>
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="formGroupExampleInput">Image</label>
                    <input type="file" class="form-control" name="banner_image" placeholder="Name">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{old('title')}}">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">Description</label>
                    <textarea class="form-control" name="description">{{old('description')}}</textarea>
                  </div>
              </div>
              <div class="modal-footer">
                <p align="right">
                  <button type="submit" class="btn btn-success mb-2"><i class="fa fa-check"></i> Submit</button>
                  <button type="button" class="btn btn-primary mb-2" data-dismiss="modal"><i class="fa fa-close"></i>
                    Back
                  </button>
                </p>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>


@include('admin.admin_includes.footer')