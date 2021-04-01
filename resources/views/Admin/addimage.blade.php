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
                <a href="{{ url('/image') }}" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>
					<div class="card-content">
						<div class="card-body">
							
                        <form action="/inserimageqry" method="post"  enctype="multipart/form-data"  >
                            {{csrf_field()}}
                            <label>Name</label>
                            <input type="text" name="imagename"  pattern="[a-z A-Z]+" class="form-control" required=""><br>
                            <label>Image</label>
                            <input type="file" name="image"   class="form-control" required=""><br>
                            <input type="submit" name="submit" class="btn btn-success" value="SUBMIT">
                        </form>


						</div>
					</div>
				</div>
			</div>        	
        </div>

        </div>
      </div>
    </div>
    <!-- END: Content-->

@stop