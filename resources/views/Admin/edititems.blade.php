@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Blank Page</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Blank Page</li>
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
                        <a href="{{ url('/items') }}" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    </div>
					<div class="card-content">
            <hr>
						<div class="card-body">
              <div class="row">
                  <div class="col-md-6 card">
                    <div class="card-body">
                      <form action="/updateitemqry" method="post"  enctype="multipart/form-data"  >
                      {{csrf_field()}}
                      @foreach($item as $items)
                      <input type="hidden" name="item_id" value="{{ $items->item_id }}">
                      <label>Category</label>
                      <select name="category" class="form-control" required="">
                        <option value="{{ $items->category_id }}">{{ $items->category_name }}</option>
                        <option disabled="">-------------------------</option>
                        @foreach($category as $cat)
                          <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                        @endforeach
                      </select><br>
                      <label>Name</label>
                      <input type="text" name="name"  pattern="[a-z A-Z]+" class="form-control" value="{{$items->iname}}" required="">
                      <br>
                      @endforeach
                      <input type="submit" name="submit" class="btn btn-success btn-block" value="Update">
                      </form>
                    </div>
                  </div>
                  <div class="col-md-6 d-inline-flex card">
                    <div class="card-body">
                      <h4>Upload & Update Image</h4>
                      @foreach($item_image as $value)
                      <img src="{{ asset('itemimage/'.$value->item_image) }}" width="295" height="200">
                      @endforeach
                      <br>
                      <button class="btn btn-info" data-toggle="modal" data-target="#uploadpic" style="width:53%;">Upload & Update</button>
                    </div>
                  </div>
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


    <!-- The Modal -->
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
      <h6 class="text-center">
        @foreach($item_image as $value)
        <img class="img-responsive" src="{{ asset('itemimage/'.$value->item_image) }}" id="profile-img-tags" width="295" height="200" />
        @endforeach
      </h6>
      <form method="post" action="/updateitempic" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @foreach($item_image as $value)
         <input type="file" name="item_pic" class="form-control" id="ii-img" onchange="readURL(this);" required=""><br>
        <input type="hidden" name="itemid" value="{{ $value->item_id }}">
        <input type="hidden" name="itemimg" value="{{ $value->item_image }}">
        <label>Upload Photo</label>
       <br>
       @endforeach
        <input type="submit" name="upload" class="btn btn-primary" value="Upload">
      </form>

    </div>    
    </div>
  </div>
  </div>
  <!-- End modal -->

    <script>
         function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile-img-tags')
                    .attr('src', e.target.result)
                    .width(295)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>

@stop