@extends('admin.layouts.main')

@section('main-container')    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">			    
			    <h1 class="app-page-title">Edit Category</h1>
			    <hr class="mb-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form" action="{{ route('admin.update-category', $categories->category_id) }}" method="POST">
									@csrf
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Category Name</label>
                                        <input type="text" name="name" class="form-control" id="setting-input-1" >
                                    </div>
                                    
									<button type="submit" class="btn app-btn-primary" >Update</button>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
@endsection

