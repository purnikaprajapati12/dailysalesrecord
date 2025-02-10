@extends('admin.layouts.main')

@section('main-container')

<div class="app-wrapper">    
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Category</h1>
				</div>
				<div class="col-auto">
					 <div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
								<form class="table-search-form row gx-1 align-items-center">
									{{-- <div class="col-auto">
										<input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
									</div>
									<div class="col-auto">
										<button type="submit" class="btn app-btn-secondary">Search</button>
									</div> --}}
								</form>
								
							</div><!--//col-->
							<div class="col-auto">						    
								<a class="btn app-btn-secondary" href="create-category">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
										<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
										<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
									  </svg>
									Create
								</a>
							</div>
						</div><!--//row-->
					</div><!--//table-utilities-->
				</div><!--//col-auto-->
			</div><!--//row-->
			
			<div class="tab-content" id="orders-table-tab-content">
				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive">
								<div>
									@if(session()->has('message'))
									
									<div class="alert alert-success">
									
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										{{session()->get('message')}}
									
									
									</div>
									
									@endif
								</div>
								<table class="table app-table-hover mb-0 text-left">
									<thead>
										<tr>
											<th class="cell">SN</th>
											<th class="cell">Name</th>
											<th class="cell"></th>
										</tr>
									</thead>
									<tbody>
		
										@foreach ($categories as $category)
										<tr>
											<td class="cell">{{$category->id}}</td>
											<td class="cell">{{$category->name}}</td>
											<td class="cell"> 

												<a href="{{url('/edit-category')}}/{{$category->id}}" class="btn btn-warning btn-sm">
												<i class="bi bi-pencil-fill"></i> Edit
												</a>
						
											<!-- Delete Button -->
											<a href="{{url('/delete-category')}}/{{$category->id}}" class="btn btn-danger btn-sm">
												<i class="bi bi-trash-fill"></i> Delete
											</a>
											</td>
										</tr>	
										@endforeach
	
									</tbody>
								</table>
							</div><!--//table-responsive-->
						   
						</div><!--//app-card-body-->		
					</div><!--//app-card-->
					{{-- <nav class="app-pagination">
						<ul class="pagination justify-content-center">
							<li class="page-item disabled">
								<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
							</li>
							<li class="page-item active"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item">
								<a class="page-link" href="#">Next</a>
							</li>
						</ul>
					</nav><!--//app-pagination--> --}}
					
				</div><!--//tab-pane-->
			</div><!--//tab-content-->	
		</div><!--//container-fluid-->
	</div><!--//app-content-->

	    
@endsection
