@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Products</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Products</li>
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
          <a href="{{ url('/additem') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Products</a>
        </div>
					<div class="card-content">
						<div class="card-body">
							<div class="table-responsive-xl">
                <table class="table table-hover table-striped table-borderless table-lg">
                  <thead class="thead-dark text-primary">
                    <th>#</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Stock</th>
                    <th>Weight</th>
                    <th>Action</th>
                  </thead>
                  @foreach($item as $key=>$it)
                  <tbody>
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td>{{ $it->category_name }}</td>
                      <td>{{ $it->iname }}</td>
                      <td>
                        <img width="60" height="60" src="{{asset("itemimage/$it->item_image")}}"
                      </td>
                      <td>
                        @if($it->item_qty == '0')
                        <p style="color: red;">Out Of Stock</p>
                        @else
                        {{ $it->item_qty }}
                        @endif
                      </td>
                      <td>
                        {{ $it->netWeight }}

                        <!-- <a href="itemDetails/{{Crypt::encrypt($it->item_id)}}" class="btn btn-success btn-sm">View & Edit</a> -->
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn btn-outline-light text-dark dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars" aria-hidden="true"></i> Action</button>
                          <div class="dropdown-menu">
                            <a href="/edititems/{{Crypt::encrypt($it->item_id)}}" class="dropdown-item"><i class="fa fa-pencil-square" aria-hidden="true"></i>edit</a>
                            <a onclick="return confirm('Are you sure to delete, all details will be deleted?')" href="/deleteitems/{{Crypt::encrypt($it->item_id)}}" class="dropdown-item"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a> 
                            @if($it->i_status == '1')
                            <a href="/deactiveitemsqry/{{Crypt::encrypt($it->item_id)}}" class="dropdown-item"><i class="fa fa-toggle-off" aria-hidden="true"></i>Deactivate</a>
                            @else
                            <a href="/activeitemsqry/{{Crypt::encrypt($it->item_id)}}" class="dropdown-item"><i class="fa fa-toggle-on" aria-hidden="true"></i>Activate</a>
                            @endif
                            <a href="updatestock/{{ Crypt::encrypt($it->item_id) }}" class="dropdown-item"><i class="fa fa-database" aria-hidden="true"></i>Update Stock</a>
                          </div>
                        </div> 
                      </td>
                    </tr>
                   
                  </tbody>
                  @endforeach
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

@stop