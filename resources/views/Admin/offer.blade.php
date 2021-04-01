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
                    <!-- <a style="margin-left:2%" href="{{ url('addoffer') }}" class="btn btn-success fa fa-plus-square"> Add Offer</a> -->
                    </div>
					<div class="card-content">
						<div class="card-body">
							

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class=" text-primary">
                                    <tr>
                                    <th>Offer Percentage</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @if(!$offer->isEmpty())
                                @foreach($offer as $off)    
                                    <tr>
                                       <form action="/offerupdateqry" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="off_id" value="{{ $off->offer_id }}">
                                            <td>
                                                <input type="number" min="0" name="offerprice" class="form-control" value="{{ $off->offer_price }}" required="">
                                            </td>
                                            <td>
                                                <input type="submit" name="submit" class="btn btn-success" value="Update Offer">
                                            </td>    
                                        </form>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                    <form action="/offerqry" method="post">
                                        {{csrf_field()}}
                                        <td>
                                            <input type="number" min="0" name="offerprice" value="0" class="form-control" required="">
                                        </td>
                                        <td>
                                            <input type="submit" name="submit" class="btn btn-success" value="Add Offer">
                                        </td>    
                                    </form>
                                    </tr>
                                @endif
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