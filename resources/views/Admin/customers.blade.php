@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Customers</h3>
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
          <div class="card-header">Customers</div>
					<div class="card-content">
						<div class="card-body">
						<div class="table-responsive">
              <table id="example" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr style="font-size: 14px;">
                        <th>#</th>
                        <th>Manager</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Aadhar</th>
                        <th>Address</th>
                        <th>Shop Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach($users as $key => $user)
                <tbody>
                    <tr style="font-size: 14px;">
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->mname }}</td>
                        <td>{{ $user->uname }}</td>
                        <td>{{ $user->ucontact }}</td>
                        <td>{{ $user->uemail }}</td>
                        <td>{{ $user->user_Aadhar }}</td>
                        <td>{{ $user->uaddress }}</td>
                        <td><img src="{{ asset('shopimage/'.$user->shop_image) }}" width="60" height="80"></td>
                        <td>
                          @if($user->ustatus == '1')
                          <a href="/cust_action/{{ $user->user_id }}/block" class="btn btn-danger btn-sm">Deactivate</a>
                          @else
                          <a href="/cust_action/{{ $user->user_id }}/unblock" class="btn btn-info btn-sm">Activate</a>
                          @endif
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