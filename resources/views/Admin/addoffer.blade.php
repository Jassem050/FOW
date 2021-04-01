@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Offer</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Add Offer</li>
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
                    <a style="margin-left:2%" href="{{ url('/offer') }}" class="btn btn-dark fa fa-arrow-left"> Back</a>
                    </div>
					<div class="card-content">
						<div class="card-body">
							

                        <form action="/offerqry" method="post"  enctype="multipart/form-data">
                            {{csrf_field()}}
                            <label>Offer(in percentage)</label>
                            <input type="number" min="0" name="offerprice" class="form-control" required=""><br>
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