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
                  <li class="breadcrumb-item active">Edit NetWeight</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">

        <div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-content">
						<div class="card-body">
							 <form action="/insertitemsqry" method="post"  enctype="multipart/form-data" style="width: 65%;">
                  {{csrf_field()}}
                  @foreach($item as $value)
                  <label>Net Weight</label>
                  <div class="row">
                    <div class="col-md-4">
                      <label>KG</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <input type="checkbox" name="kilogram" id="kg" value="Kg" onclick="chkweight()">
                          </div>
                        </div>
                        <input type="text" name="weight1" class="form-control" value="1" readonly="">
                      </div>
                      <label class="mt-1">Price</label>
                      <input type="number" name="price1" id="price1" min="0"  class="form-control" readonly="">
                    </div>
                    <div class="col-md-4">
                      <label>Grams</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <input type="checkbox" name="Grams" id="grm" value="Grams" onclick="chkweight()">
                          </div>
                        </div>
                        <input type="text" name="weight2" id="weight2" class="form-control" placeholder="Enter Weight" readonly="">
                      </div>
                      <label class="mt-1">Price</label>
                      <input type="number" name="price2" id="price2" min="0"  class="form-control" readonly="">
                    </div>
                    <div class="col-md-4">
                      <label>Piece</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <input type="checkbox" name="Piece" id="piece" value="Piece" onclick="chkweight()">
                          </div>
                        </div>
                        <input type="text" name="weight3" id="weight3" class="form-control" placeholder="Enter Weight" readonly="">
                      </div>
                      <label class="mt-1">Price</label>
                      <input type="number" name="price3" id="price3" min="0" class="form-control" readonly="">
                    </div>
                  </div>
                  <br>
                  <label>Minimun Purchase Quantity</label>
                  <div class="row">
                    <div class="col-md-4">
                      <label>Kg</label>
                      <input type="text" name="minkg" id="minkg" pattern="\d*" maxlength="4" class="form-control" readonly="">
                    </div>
                    <div class="col-md-4">
                      <label>Grams</label>
                      <input type="text" name="mingrams" id="mingrams" pattern="\d*" maxlength="4" class="form-control" readonly="">
                    </div>
                    <div class="col-md-4">
                      <label>Piece</label>
                      <input type="text" name="minPiece" id="minPiece" pattern="\d*" maxlength="4" class="form-control" readonly="">
                    </div>
                  </div>
                  <br>
                  @endforeach
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