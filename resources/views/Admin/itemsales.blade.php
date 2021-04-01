@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Product Sold Today</h3>
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
            
          </div>
					<div class="card-content">
						<div class="card-body">
							

              <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead class="thead-dark">
                        <tr>
                          <th>Item</th>
                          <th>Price</th>
                          <th>Quantity Sold</th>
                          <th>Date Of Sale</th>
                          <th>Total Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($itemsold as $value)
                        <tr>
                          <td>{{ $value->iname }}</td>
                          <td><i class="fa fa-inr" aria-hidden="true"></i> {{ $value->item_price }}</td>
                          <td>{{ $value->qty }}</td>
                          <td>{{ $value->paid_date }}</td>
                          <td><i class="fa fa-inr" aria-hidden="true"></i> {{ $value->total }}</td>
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

@stop