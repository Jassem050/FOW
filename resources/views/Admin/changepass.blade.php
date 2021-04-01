@extends('Admin.layout.nav')
@section('bodycontent')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Change Password</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Change Password</li>
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
							<form action="/adminchngpass" method="post"  style="width: 50%;">
							{{csrf_field()}}
							<label>Old Password</label>
							<div class="input-group mb-3">
			              		<input type="password" name="opass" id="opass" class="form-control" required="">
							    <div class="input-group-append">
							      <button type="button" class="input-group-text" onclick="myFunction1()"><i class="fa fa-eye" aria-hidden="true"></i></button>
							   	</div>
							</div>
			                    
			              	<label>New Password</label>
			              	<div class="input-group mb-3">
			              		<input type="password" name="npass" id="npass"  class="form-control" required="">
			              		<div class="input-group-append">
			              			<button type="button" class="input-group-text" onclick="myFunction2()"><i class="fa fa-eye" aria-hidden="true"></i></button>
			              		</div>
			              	</div>
			              		
			              	<label>Conform Password</label>
			              	<div class="input-group mb-3">
			              		<input type="password" name="cpass"  id="cpass" class="form-control" required="">
			              		<div class="input-group-append">
			              			<button type="button" class="input-group-text" onclick="myFunction3()"><i class="fa fa-eye" aria-hidden="true"></i></button>
			              		</div>
			              	</div>
			              	
			    			<input type="submit" name="submit" class="btn btn-success" value="Change Password">
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
<script>
function myFunction1() {
  var x = document.getElementById("opass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function myFunction2() {
  var x = document.getElementById("npass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function myFunction3() {
  var x = document.getElementById("cpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
@stop