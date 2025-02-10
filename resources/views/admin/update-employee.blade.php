@extends('admin.layouts.main')

@section('main-container')    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">			    
			    <h1 class="app-page-title">Update Employees</h1>
			    <hr class="mb-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form" action="{{url('/')}}/update-employee" method="post">
									@csrf
									<div class="mb-3">
									    <label for="setting-input-1" class="form-label">Name</label>
									    <input type="text" name="name" class="form-control" id="setting-input-1" value="{{old('name')}}" required>
										@error('name')
                						<p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            							@enderror
									</div>
									<div class="mb-3">
									    <label for="setting-input-2" class="form-label">Address</label>
									    <input type="text" name="address" class="form-control" id="setting-input-2" value="{{old('name')}}" required>
										@error('name')
                						<p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            							@enderror
									</div>
								    <div class="mb-3">
									    <label for="setting-input-3" class="form-label">Email</label>
									    <input type="email" name="email" class="form-control" id="setting-input-3" value="{{old('name')}}">
										@error('name')
										<p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
										@enderror
									</div>
									<div class="mb-3">
									    <label for="setting-input-4" class="form-label">Password</label>
									    <input type="password" name="password" class="form-control" id="setting-input-4" value="{{old('name')}}" required>
										@error('name')
										<p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
										@enderror
									</div>
									<div class="mb-3">
									    <label for="setting-input-5" class="form-label">Confirm Password</label>
									    <input type="password" name="password_confirmation" class="form-control" id="setting-input-5" value="{{old('name')}}" required>
										@error('name')
										<p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
										@enderror
									</div>
									<div class="mb-3">
									    <label for="setting-input-6" class="form-label">Contact</label>
									    <input type="text" name="contact" class="form-control" id="setting-input-6" value="{{old('name')}}" required>
										@error('name')
										<p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
										@enderror
									</div>
									
									<div class="mb-3">
									    <label for="setting-input-6" class="form-label">UserType</label>
										<div>
										<label for="setting-input-7" >Admin</label>
									    <input type="radio" name="usertype" class="form-check" id="setting-input-7" value="0" > 
									
									<label for="setting-input-7" >Employee</label>
										<input type="radio" name="usertype" class="form-check" id="setting-input-8" value="1" >
										</div>
										@error('name')
										<p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
										@enderror
									</div>
									<button type="submit" class="btn app-btn-primary" >Update</button>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->
			    <hr class="my-4">
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
@endsection

