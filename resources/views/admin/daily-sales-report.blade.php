@extends('admin.layouts.main')

@section('main-container')

<style>
	@media print {
    body * {
        visibility: hidden; 
    }
    .report-container, .report-container * {
        visibility: visible; /* Show the report container and its children */
    }
    .report-container {
        position: absolute;
        left: 0;
        top: 0;
		
    }
    .app-btn-secondary {
        display: none; /* Hide print button when printing */
    }
}

</style>

<div class="app-wrapper">    
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Report</h1>
					
				</div>
				
				<div class="col-auto">
					 <div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
								<form class="table-search-form row gx-1 align-items-center">
									<div class="col-auto">
										<input type="date" id="search-orders" name="start" class="form-control search-orders" placeholder="Start Date" value="{{@$start}}">
									</div>
									<div class="col-auto">
										<input type="date" id="search-orders" name="end" class="form-control search-orders" placeholder="End Date" value="{{@$end}}">
									</div>
									<div class="col-auto">
										<button type="submit" class="btn app-btn-secondary">Search</button>
									</div>
									<div class="col-auto">						    
								<a class="btn app-btn-secondary" onclick="window.print()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
  <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
  <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
</svg>
									Print
								</a>
							</div>
								</form>
								
							</div>
						</div><!--//row-->
					</div><!--//table-utilities-->
				</div><!--//col-auto-->
			</div><!--//row-->
		<div class="report-container">
			<div class="tab-content" id="orders-table-tab-content">
				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive">
								<table class="table app-table-hover mb-0 text-left">
									<thead>
										<tr>
											<th class="cell">SN</th>
											<th class="cell">Date</th>
											<th class="cell">Code</th>
											<th class="cell">SubTotal</th>
											<th class="cell">Discount</th>
											<th class="cell">Total</th>
											<th class="cell"></th>
										</tr>
									</thead>
									<tbody>
										{{-- {{dd($orders)}} --}}
										@php $i=0; $stotal = 0; $dtotal = 0; $gtotal = 0;@endphp
										@foreach($orders as $order)
										
										@php $i++; 
											$stotal += ($order->discount + $order->total); 
											$dtotal += $order->discount; 
											$gtotal += $order->total;
										@endphp
										<tr>
											<td class="cell">{{$i}}</td>
											<td class="cell">{{$order->date}}</td>
											<td class="cell">{{$order->order_code}}</td>
											<td class="cell">Rs. {{$order->discount + $order->total}}</td>
											<td class="cell">Rs. {{$order->discount}}</td>
											<td class="cell">Rs. {{$order->total}}</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr>
											<th></th>
											<th></th>
											<th>Grand Total</th>
											<th>{{$stotal}}</th>
											<th>{{$dtotal}}</th>
											<th>{{$gtotal}}</th>
										</tr>
									</tfoot>
								</table>
							</div><!--//table-responsive-->
						   
						</div><!--//app-card-body-->		
					</div><!--//app-card-->
				</div><!--//tab-pane-->
			</div><!--//tab-content-->	
		</div><!--//report container-->
		</div><!--//container-fluid-->
	</div><!--//app-content-->

	    
@endsection
