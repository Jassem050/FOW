@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Cart Amount</h3>
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
            <hr>
						<div class="card-body">
							<div class="table table-responsive">
                <table class="table table-bordered">
                  <thead class="thead-dark">
                    <tr>
                      <th>Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!$amt->isEmpty())
                    @foreach($amt as $value)
                      <tr>
                        <form method="post" action="/updatecartamtary" class="form-group">
                          {{csrf_field()}}
                          <input type="hidden" name="camt_id" value="{{ $value->cart_min_id }}">
                            <td>
                              <input type="text" name="amount" pattern="\d*" maxlength="10" class="form-control" value="{{ $value->minimum_amount }}" required="">
                            </td>
                            <td>
                              <input type="submit" name="add" class="btn btn-info" value="Update">
                            </td>
                        </form>
                      </tr>
                    @endforeach
                    @else
                      <tr>
                        <form method="post" action="/cartamtary" class="form-group">
                          {{csrf_field()}}
                            <td>
                              <input type="text" name="amount" pattern="\d*" maxlength="10" class="form-control" value="0" required="">
                            </td>
                            <td>
                              <input type="submit" name="add" class="btn btn-info" value="Add">
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