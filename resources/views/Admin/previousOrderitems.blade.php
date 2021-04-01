@extends('Admin.layout.nav')
@section('bodycontent')
<style type="text/css">
    @page { size: auto;  margin: 0mm; }
</style>
<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Customer Order</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Order Items</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body" id="dvContents">
            <div class="row Printheader">
                <div class="col-md-6 companydetails">
                    <p>Fresh On Wheel</p>
                    <p>Ph: +919606226969</p>
                </div>
                <div class="col-md-6 invoicedetails">
                    <p>Invoice Date: {{ date('Y-m-d') }}</p>
                    @foreach($order as $viw)
                    <p>Invoice #: {{ $viw->order_number }}</p>
                    @endforeach
                </div>
            </div>
        <div class="row">
			<div class="col-md-12">
				<div class="card">
                    <div class="card-header">
                        <a href="{{ url('/orders') }}" class="btn btn-dark printPageButton"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        <button type="button" class="btn btn-warning printPageButton" onclick="PrintDiv();">Print</button>
                        <hr class="line1">
                            <div class="row printrow">
                                <div class="col-md-6 cdetails">
                                    <h3><u>Customer Details</u></h3>
                                    @foreach($user as $lld )
                                    <h5>Name:  {{$lld->uname }}</h5>  
                                    <h5>Address:  {{$lld->uaddress }}</h5>	
                                    <h5>Phone:  {{$lld->ucontact }}</h5>
                                    <h5>E-mail:  {{$lld->uemail }}</h5>
                                    @endforeach	                            
                                </div>
                                <div class="col-md-6 corder">
                                    <h3><u>Order  Details</u></h3>
                                    @foreach($order as $viw)
                                    <h5>Order id:   {{$viw->order_number}}</h5>	
                                    <h5>Order Date:  {{$viw->order_date}}</h5>              
                                    @endforeach                 
                                </div>
                            </div>  
                    </div>
					<div class="card-content">
						<div class="card-body">
                        <div class="table-responsive">
                            <hr class="line2" style="display: none;">
                            <table id="example" class="table table-bordered" style="width:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Items</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody class="tbodyorder">
                                    @foreach($view as $key=>$iit)
                                        <tr>
                                        <td>{{ ++$key }}</td>
                                    
                                            <td>{{ $iit->iname }}</td>
                                            <td>{{ $iit->cart_qty }}</td>
                                            <td><i class="fa fa-inr" aria-hidden="true"></i> {{ $iit->item_price }}</td>
                                            <td><i class="fa fa-inr" aria-hidden="true"></i> {{ $iit->sub_total }}</td>
                                        
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    
                                    <tfoot class="tfootorder">
                                        @foreach($order as $ord)
                                        <tr>
                                        <td style="border: none;"></td>
                                        <td style="border: none;"></td>
                                        <td style="border: none;"></td>
                                        <td class="">Discount(%)</td>
                                        <td class="dis">{{$ord->offer_price }}%</td>
                                        </tr>
                                        <tr>
                                        <td style="border: none;"></td>
                                        <td style="border: none;"></td>
                                        <td style="border: none;"></td>
                                        <td class="">Discount Price</td>
                                        <td class="dis"><i class="fa fa-inr" aria-hidden="true"></i> {{$ord->offer_amt }}</td>
                                        </tr>
                                        <tr>
                                        <td style="border: none;"></td>
                                        <td style="border: none;"></td>
                                        <td style="border: none;"></td>
                                        <td class="">Actual Amount</td>
                                        <td class="dis"><i class="fa fa-inr" aria-hidden="true"></i> {{$ord->actual_amt }}</td>
                                        </tr>
                                        <tr>
                                        <td style="border: none;"></td>
                                        <td style="border: none;"></td>
                                        <td style="border: none;"></td>
                                        <td class="">Total Amount</td>
                                        <td class="distotal"><i class="fa fa-inr" aria-hidden="true"></i> {{ $ord->total_amt}}</td>
                                        </tr>
                                        @endforeach
                                    </tfoot>
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


    <script type="text/javascript">
        function PrintDiv() {
            var divContents = document.getElementById("dvContents").innerHTML;
            var printWindow = window.open('', '', 'height=1000,width=1000');
            printWindow.document.write('<html><head><title>Print Bill</title>');
            printWindow.document.write('<style>');
            printWindow.document.write('.line1{display: none;}')
            printWindow.document.write('.Printheader{position: fixed;top: 0;display:block;width: 98%;margin-top: 1%;border-top-style: dotted;}');
            printWindow.document.write('.companydetails {float:left;text-align: justify;}');
            printWindow.document.write('.companydetails p{line-height: 4px;}');
            printWindow.document.write('.invoicedetails {float:right;text-align: justify;}');
            printWindow.document.write('.invoicedetails p{line-height: 4px;}');
            printWindow.document.write('.printline{display:block;}');
            printWindow.document.write('.printrow{margin-top: 10%;border-top-style: dotted;}')
            printWindow.document.write('.cdetails {float:left;text-align: justify;}');
            printWindow.document.write('.cdetails h3,h5{line-height: 2px;}');
            printWindow.document.write('.corder {float:right;text-align: justify;}');
            printWindow.document.write('.corder h3,h5{line-height: 2px;}');
            printWindow.document.write('.printPageButton {display: none;}');  
            printWindow.document.write('line2 { display: none; border-top-style: dotted; }')
            printWindow.document.write('table{width: 100%;border-collapse: collapse;}');  
            printWindow.document.write('.thead-light th{text-align: center;height: 30px;border: 1px solid #A9A9A9;background-color:#A2D0CE;}');  
            printWindow.document.write('.tbodyorder td{text-align: left;height: 30px;border: 1px solid #A9A9A9;}'); 
            printWindow.document.write('.tbodyorder th{text-align: left;height: 30px;border: 1px solid #A9A9A9;}');
            printWindow.document.write('.tfootorder .dis{height: 30px;border: 1px solid #A9A9A9;}'); 
            printWindow.document.write('.tfootorder .distotal{height: 30px;border: 1px solid #A9A9A9;background-color:#A2D0CE;}'); 
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
@stop