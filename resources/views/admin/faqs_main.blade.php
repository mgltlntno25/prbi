@include('admin.admin_includes.header')
@include('admin.admin_includes.header_navbar')
@include('admin.admin_includes.sidebar')

<!-- include summernote css/js-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      FAQs
      <small>Dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa <fa-image></fa-image>"></i> FAQs</a></li>
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
        <h3 class="box-title"></h3>
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
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($faqs as $faq)
            <tr>
              <td>{{$faq->id}}</td>
              <td>
                {{$faq->title}}
              </td>
              <td>
                {{$faq->description}}
              </td>
              <td>{{$faq->status}}</td>
              <td>

                <button type="button" class="btn btn-info" data-placement="top" title="View FAQs" data-toggle="modal" data-target="#view-modal{{$faq->id}}"><i class="fa fa-eye"></i> </button>
                <!-- <button type="button" class="btn btn-warning"><i class="fa fa-edit" onclick="window.location='{{url("admin/faqs/" . $faq->id)}}'"></i></button> -->
                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit FAQs" onclick="window.location='{{url("admin/faqs/" . $faq->id)}}'"><i class="fa fa-edit"></i></button>
                @if($faq->status == 'active')
                <button type="button" class="btn btn-danger" data-placement="top" title="Deactivate FAQS" data-toggle="modal" data-target="#statusModal{{ $faq->id }}"><i class="fa fa-close"></i>
                </button>
                @elseif($faq->status == 'inactive')
                <button type="button" class="btn btn-success" data-placement="top" title="Activate FAQs" data-toggle="modal" data-target="#statusModal{{ $faq->id }}"><i class="fa fa-check"></i>
                </button>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="statusModal{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <b>{{ $faq->title }} </b>?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        <a type="button" href="{{ url('/admin/dochangestatusfaq/'. $faq->id) }}" class="btn btn-primary">Save changes</a>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <!-- modal  View-->
            <div class="modal fade" id="view-modal{{ $faq->id }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">FAQ ID. {{$faq->id}}</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="formGroupExampleInput">Title</label><br>
                      {{$faq->title}}
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput2">Description</label>
                      <br>
                      {{ $faq->description }}
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
        <p align="right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addmodal"> <i class="fa fa-plus"></i> Add FAQ </button></p>
        <!-- modal  Create-->
        <div class="modal fade" id="addmodal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CREATE FAQ</h4>
              </div>
              <div class="modal-body">
                <form action='/admin/doaddfaq' method='post'>
                  {{ csrf_field() }}
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


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.admin_includes.footer')