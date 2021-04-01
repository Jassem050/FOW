@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Orders</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Previous Orders</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        
      <div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-content">
						<div class="card-body">
							

                <div class="table-responsive">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date</th>
                               <th>Mobile Number</th>
                               <th>Discount(%)</th>
                               <th>Discount Price</th>
                               <th>Actual Amount</th>
                                <th> Total_Amount  </th>
                                <th> Action </th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach($ordr as $key=>$ord)
                            <tr>
                            <td>{{ ++$key }}</td>
                           
                                <td>{{ $ord->uname }}</td>
                                <td>{{ $ord->order_date }}</td>
                                <td>{{$ord->ucontact }}</td>
                                <td>{{$ord->offer_price }}%</td>
                                <td><i class="fa fa-inr" aria-hidden="true"></i> {{$ord->offer_amt }}</td>
                                <td><i class="fa fa-inr" aria-hidden="true"></i> {{$ord->actual_amt }}</td>
                                <td><i class="fa fa-inr" aria-hidden="true"></i> {{ $ord->total_amt}}</td>
                              <td>
                              <a href="/porderitems/{{ $ord->order_id }}/{{ $ord->user_id }}" class="btn btn-primary" > View Items</a>
                              </td>
                              <td>{{ $ord->paid_status }}</td>
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