@extends('Admin.layout.nav')
@section('bodycontent')

<div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Stats -->
<div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-primary bg-darken-2">
                        <i class="fa fa-cubes font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-primary white media-body">
                        <h5>Products</h5>
                        <h5 class="text-bold-400 mb-0"><i class="fa fa-plus"></i> {{ $itemcount }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-danger bg-darken-2">
                        <i class="icon-user font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-danger white media-body">
                        <h5>Customers</h5>
                        <h5 class="text-bold-400 mb-0"><i class="fa fa-arrow-up"></i> {{ $usercount }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-warning bg-darken-2">
                        <i class="icon-basket-loaded font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-warning white media-body">
                        <h5>New Orders</h5>
                        <h5 class="text-bold-400 mb-0"><i class="fa fa-arrow-down"></i> {{ $ncount }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-success bg-darken-2">
                        <i class="icon-wallet font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-success white media-body">
                        <h5>Today's Profit</h5>
                        <h5 class="text-bold-400 mb-0"><i class="fa fa-inr"></i> {{ $profit }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Stats -->
<!--Product sale & buyers -->
<div class="row match-height">
    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Today's Product Sales</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <table class="table table-bordered">
                    	<thead>
                    		<tr>
                    			<th>Item</th>
                    			<th>Price</th>
                    			<th>Quantity Sold</th>
                    			<th>Total Amount</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($itemsold as $value)
                    		<tr>
                    			<td>{{ $value->iname }}</td>
                    			<td>{{ $value->item_price }}</td>
                    			<td>{{ $value->qty }}</td>
                    			<td>{{ $value->total }}</td>
                    		</tr>
                    		@endforeach
                    	</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Recent Buyers</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            </div>
            <div class="card-content px-1">
                <div id="recent-buyers" class="media-list height-300 position-relative">
                @foreach($rbuyer as $rvalue)
                    <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle" src="{{ asset('shopimage/'.$rvalue->shop_image) }}" alt="Generic placeholder image">
                            <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <h6 class="list-group-item-heading">{{ $rvalue->uname }} <span class="font-medium-4 float-right pt-1"><i class="fa fa-inr"></i>{{ $rvalue->actual_amt }}</span></h6>
                            <p class="list-group-item-text mb-0"><span class="badge badge-primary">{{ $rvalue->ucontact }}</span><span class="badge badge-warning ml-1">{{ $rvalue->order_date }}</span></p>
                        </div>
                    </a>
            @endforeach        
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Product sale & buyers -->
<!--Recent Orders & Monthly Salse -->
<div class="row match-height">
    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Today's Orders</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <p>Total paid invoices {{ $pcount }}, unpaid {{ $ucount }}. <span class="float-right"><a href="project-summary.html" target="_blank">Invoice Summary <i class="ft-arrow-right"></i></a></span></p>
                </div>
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Order#</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($pbuyer as $key => $pvalue)
                        	<tr>
                                <td class="text-truncate">{{ ++$key }}</td>
                                <td class="text-truncate"><a href="#">{{ $pvalue->order_number }}</a></td>
                                <td class="text-truncate">{{ $pvalue->uname }}, {{ $pvalue->ucontact }}</td>
                                @if($pvalue->paid_status == 'Paid')
                                	<td class="text-truncate"><span class="badge badge-success">Paid</span></td>
                                @elseif($pvalue->paid_status == 'Unpaid')
                                	<td class="text-truncate"><span class="badge badge-warning">Unpaid</span></td>
                                @elseif($pvalue->paid_status == 'Canceled')    
                                    <td class="text-truncate"><span class="badge badge-danger">Canceled</span></td>
                                @endif
                                
                                <td class="text-truncate"><i class="fa fa-inr"></i> {{ $pvalue->actual_amt }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body sales-growth-chart">
                    <div id="monthly-sales" class="height-250"></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="chart-title mb-1 text-center">
                    <h6>Total monthly Sales.</h6>
                </div>
                <div class="chart-stats text-center">
                    <a href="#" class="btn btn-sm btn-primary mr-1">Statistics <i class="ft-bar-chart"></i></a> <span class="text-muted">for the last year.</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Recent Orders & Monthly Salse -->

        </div>
      </div>


@stop