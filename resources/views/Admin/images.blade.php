@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Advertisement</h3>
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
                    <a href="{{ url('addimage') }}" class="btn btn-success fa fa-plus-square"> Add Images</a>
                    </div>
					<div class="card-content">
						<div class="card-body">
							
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                            
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>image</th>
                                        
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
                                @foreach($img as $key=>$nme)
                                    <tr>
                                    
                                        <td>{{++$key}}</td>
                                        <td>{{$nme->image_name}}</td>
                                        <td><img width="60" height="60" src="{{asset("itemimage/$nme->img_url")}}"</td>
                                        
                                    
                                        <td>
                                        <a onclick="return confirm('Are you sure to delete, all details will be deleted?')" href="/deleteimage/{{ $nme->im_id }}/{{ $nme->img_url }}" class="btn btn-danger">Delete</a>
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