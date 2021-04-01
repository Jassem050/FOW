@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Customer Orders</h3>
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
                        <a href="{{ url('previousorders') }}" class="btn btn-success"><i class="fa fa-cart-plus fa-2x"></i>   Previous Orders</a>

                        <a style="margin-left:2%" href="{{ url('CanceledOrders') }}" class="btn btn-danger"><i class="fa fa-cart-arrow-down fa-2x"></i>   Canceled Orders</a>
                    </div> 
                    <!-- <hr> -->
					<div class="card-content">
						<div class="card-body">
                            <div class="table-responsive-xl">
                                <table id="example" class="table table-hover table-striped table-borderless table-sm">
                     
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Discount(%)</th>
                                        <th>Discount Price</th>
                                        <th>Actual Amount</th>
                                        <th> Total_Amount  </th>
                                        <th> Action </th>
                                    </tr>
                                    </thead>
                        
                                    <tbody>
                                    @foreach($ordr as $ord)
                                        <tr>
                                            <td>{{ $ord->order_number }}</td>
                                            <td>{{ $ord->uname }}</td>
                                            <td>{{ $ord->order_date }}</td>
                                            <td>{{$ord->offer_price }} <i class="fa fa-percent" aria-hidden="true"></i></td>
                                            <td><i class="fa fa-inr" aria-hidden="true"></i> {{$ord->offer_amt }}</td>
                                            <td><i class="fa fa-inr" aria-hidden="true"></i> {{$ord->actual_amt }}</td>
                                            <td><i class="fa fa-inr" aria-hidden="true"></i> {{ $ord->total_amt}}</td>
                                            <td>
                                            <div class="dropup">
                                                <button type="button" class="btn btn-outline-light text-dark dropdown-toggle" data-toggle="dropdown">
                                                  <i class="fa fa-bars" aria-hidden="true"></i> Action
                                                </button>
                                                <div class="dropdown-menu">
                                                   <a href="/customerorderitems/{{ Crypt::encrypt($ord->order_id) }}/{{ Crypt::encrypt($ord->user_id) }}" class="dropdown-item" ><i class="fa fa-search" aria-hidden="true"></i>View Items</a> 
                                                     <div class="dropdown-divider"></div> 
                                                    @if($ord->u_status == '1')
                                                    <a onclick="return confirm('Are you sure to cancel the order?')" href="/cancelorder/{{ $ord->order_id }}/{{ $ord->user_id }}" class="dropdown-item"><i class="fa fa-ban" aria-hidden="true"></i>Cancel Order</a>
                                                     <div class="dropdown-divider"></div> 
                                                    @endif  
                                                    @if($ord->paid_status == 'Unpaid')
                                                    <a href="/orderpaid/{{ $ord->order_id }}" class="dropdown-item"><i class="fa fa-money" aria-hidden="true"></i>Paid</a>
                                                    @else
                                                    <p>{{ $ord->paid_status }}</p>
                                                    @endif
                                                </div>
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

@stop