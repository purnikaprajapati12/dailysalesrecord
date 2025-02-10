@extends('admin.layouts.main')

@section('main-container')    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">			    
			    <h1 class="app-page-title">{{$title}}</h1>
			    <hr class="mb-4">
                <div class="row g-4 settings-section">
	                
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form" action="{{$url}}" method="POST">
									@csrf
									<div class="mb-3">
									    <label for="setting-input-1" class="form-label">Item Name</label>
									    <input type="text" name="name" class="form-control" id="setting-input-1" value="{{$items->name}}" required>
										@error('name')
										<p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
										@enderror
									</div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Category</label>
										<select name="category_id" class="form-control" id="setting-input-2" value="{{$items->category_id}}" required>
											<option value="">Select category</option>
											@foreach ($categories as $category)
											<option value="{{$category->id}}" @if($items->category_id == $category->id) selected @endif>{{$category->name}}</option>
											@endforeach
										</select>
                                    </div>
                                    <div class="mb-3">
									    <label for="setting-input-3" class="form-label">Price</label>
									    <input type="decimal" name="price" class="form-control" id="setting-input-3" value="{{$items->price}}" required>
									</div>
									<button type="submit" class="btn app-btn-primary" >Submit</button>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
@endsection

