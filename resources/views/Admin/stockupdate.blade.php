@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Items</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Stock Update</li>
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
                <a href="{{ url('/items') }}" class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>
					<div class="card-content">
						<div class="card-body">
                        <form action="/stockupdateqry" method="post">
                            {{csrf_field()}}
                            @foreach($item as $value)
                            <input type="hidden" name="item_id" value="{{ $value->item_id }}">
                            <label>Item Name</label>
                            <input type="text" name="iname" class="form-control" value="{{ $value->iname }}" readonly=""><br>
                            <label>Available Stock</label>
                            <input type="text" name="astock" class="form-control" value="{{ $value->item_qty }}" readonly=""><br>
                            @endforeach
                            <label>Stock</label>
                            <input type="text" name="stock" class="form-control" pattern="\d*" maxlength="4" required=""><br>
                            <input type="submit" name="submit" class="btn btn-success" value="Update">
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