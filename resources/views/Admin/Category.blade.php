@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Category</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                  </li>
                  <!-- <li class="breadcrumb-item active">Blank Page</li> -->
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">

        <div class="row">
			<div class="col-md-12">
				<div class="card">
          <div class="card-header">
            <a href="{{ url('/addcategory') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Category</a>
          </div>
					<div class="card-content">
						<div class="card-body">
							 <div class="table table-responsive">
                 <table class="table table-bordered">
                   <thead class="thead-dark">
                     <tr>
                       <th>#</th>
                       <th>Category</th>
                       <th>Category Image</th>
                       <th>Action</th>
                     </tr>
                   </thead>
                   <tbody>
                     @foreach($cat as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->category_name }}</td>
                        <td>
                          <img src="{{ asset('category_image/'.$value->category_image) }}" width="100" height="100"><br><br>
                          <button class="btn btn-info" data-toggle="modal" data-target="#uploadpic" style="width:44%;">Upload & Update</button>
                        </td>
                        <td>
                          <div class="btn-group">
                            <button href="" class="btn btn-info edit-modal" data-id="{{$value->category_id}}" data-name="{{$value->category_name}}">Edit</button>
                            @if($value->category_status == '1')
                            <a onclick="return confirm('Are you sure want to disable?')" href="categorystatus/{{$value->category_id}}/disable" class="btn btn-danger" style="margin-left: 3%;">Disable</a>
                            @else
                            <a onclick="return confirm('Are you sure want to enable?')" href="categorystatus/{{$value->category_id}}/enable" class="btn btn-success" style="margin-left: 3%;">Enable</a>
                            @endif
                          </div>
                        </td>
                      </tr>
                     @endforeach
                   </tbody>
                 </table>
               </div>
						</div>
					</div>
				</div>
			</div>        	
        </div>

        </div>
      </div>
    </div>
    <!-- END: Content-->


     <!-- Modals -->
        <!-- Edit Modal -->
          <div class="modal" id="EditModal">
            <div class="modal-dialog">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Edit</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                  <form method="post" action="/updatecategory" class="form-group">
                  @csrf
                    <input type="hidden" class="form-control" name="cat_id" id="id" readonly>
                    <label for="cat">Category Name</label>
                    <input type="text" class="form-control" name="cname" id="n" required><br>
                    <input type="submit" value="Update" class="mdl-button mdl-js-button mdl-button--raised bg-primary btn-sm text-white">
                  </form>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                
              </div>
            </div>
          </div>
    <!-- Modal End -->


    <!-- The Image Modal -->
        <div class="modal fade" id="uploadpic">
            <div class="modal-dialog">
                <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Upload Image</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <h6 class="text-center"><img class="img-responsive" src="{{ asset('category_image/'.$value->category_image) }}" id="profile-img-tag" width="295" height="200" /></h6>
                    <form method="post" action="/updatecategorypic" class="form-group" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="cid" value="{{ $value->category_id }}">
                        <input type="hidden" name="cat_img" value="{{ $value->category_image }}">
                        <label>Upload Photo</label>
                        <input type="file" name="photo" pattern="" class="form-control" id="profile-img" onchange="readURL(this);" required=""><br>
                        <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                    </form>

                </div>    
                </div>
            </div>
        </div>
    <!-- End modal -->


  <script type="text/javascript">
    // Edit Data (Modal and function edit data)
    $(document).on('click', '.edit-modal', function() {
    $('.modal-title').text('Edit');
    $('#id').val($(this).data('id'));
    $('#n').val($(this).data('name'));
    $('#EditModal').modal('show');
    });
  </script>

  <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile-img-tag')
                    .attr('src', e.target.result)
                    .width(295)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>

@stop