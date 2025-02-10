@extends('admin.layouts.main')

@section('main-container')
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Overview</h1>
				<div class="row g-4 mb-4">

				<div class="col-12 col-lg-6">
					    <div class="app-card app-card-chart h-100 shadow-sm">
					        <div class="app-card-header p-3 border-0">
								<button class="btn app-btn-secondary" style="float:right">{{$monthlySales['year']}}</button>
						        <h4 class="app-card-title">Monthly Sales</h4>
					        </div><!--//app-card-header-->
					        <div class="app-card-body p-4">					   
						        <div class="chart-container">
				                    <canvas id="bar-chart-monthly" ></canvas>
						        </div>
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div><!--//col-->
					<div class="col-12 col-lg-6">
					    <div class="app-card app-card-chart h-100 shadow-sm">
					        <div class="app-card-header p-3 border-0">
								<button class="btn app-btn-secondary" style="float:right">This Week</button>
						        <h4 class="app-card-title">Weekly Sales</h4>
					        </div><!--//app-card-header-->
					        <div class="app-card-body p-4">					   
						        <div class="chart-container">
				                    <canvas id="bar-chart-weekly" ></canvas>
						        </div>
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div><!--//col-->
			    <div class="col-12 col-lg-12">
					<div class="app-card app-card-chart h-100 shadow-sm">
						<div class="app-card-header p-3 border-0">
							<button class="btn app-btn-secondary" style="float:right">{{$dailySales['month']}} {{$dailySales['year']}}</button>
							<h4 class="app-card-title">Daily Sales</h4>
						</div><!--//app-card-header-->
						<div class="app-card-body p-4">					   
							<div class="chart-container">
								<canvas id="line-chart-daily" ></canvas>
							</div>
						</div><!--//app-card-body-->
					</div><!--//app-card-->
				</div><!--//col-->
				    
					
					
					<div class="col-12 col-lg-6">
					    <div class="app-card app-card-chart h-100 shadow-sm">
					        <div class="app-card-header p-3 border-0">
								<button class="btn app-btn-secondary" style="float:right">{{$monthlySales['year']}}</button>
						        <h4 class="app-card-title">Top Selling Item(Veg)</h4>
					        </div><!--//app-card-header-->
					        <div class="app-card-body p-4">					   
						        <div class="chart-container">
				                    <canvas id="pie-chart-veg" ></canvas>
						        </div>
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div><!--//col-->
					<div class="col-12 col-lg-6">
					    <div class="app-card app-card-chart h-100 shadow-sm">
					        <div class="app-card-header p-3 border-0">
								<button class="btn app-btn-secondary" style="float:right">{{$monthlySales['year']}}</button>
						        <h4 class="app-card-title">Top Selling Item(Non-Veg)</h4>
					        </div><!--//app-card-header-->
					        <div class="app-card-body p-4">					   
						        <div class="chart-container">
				                    <canvas id="pie-chart-nonveg" ></canvas>
						        </div>
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div><!--//col-->
					
				
			    </div><!--//row-->			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->

<script>

var monthlySales = @json($monthlySales);
	var monthlysalesChart = $('#bar-chart-monthly');
	var myChart = new Chart(monthlysalesChart, {
		type: 'bar',
		data: {
			labels:monthlySales.months,
			datasets: [{
				label: 'Sales',
				data: monthlySales.sales,
				backgroundColor: 'rgba(75, 192, 192, 0.2)',
				borderColor: 'rgba(75, 192, 192, 1)',
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});

	var weeklySales = @json($weeklySales);
	var weeklySalesChart = $('#bar-chart-weekly');
	var myChart = new Chart(weeklySalesChart, {
		type: 'bar',
		data: {
			labels:weeklySales.weekly,
			datasets: [{
				label: 'Sales',
				data: weeklySales.sales,
				backgroundColor: 'rgba(75, 192, 192, 0.2)',
				borderColor: 'rgba(75, 192, 192, 1)',
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});


var dailySales = @json($dailySales);
	var dailySalesChart = $('#line-chart-daily');
	var myChart = new Chart(dailySalesChart, {
		type: 'line',
		data: {
			labels:dailySales.daily,
			datasets: [{
				label: 'Sales',
				data: dailySales.sales,
				backgroundColor: 'rgba(75, 192, 192, 0.2)',
				borderColor: 'rgba(75, 192, 192, 1)',
				borderWidth: 2
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
		});


	

	var topItemsVeg = @json($topItemsVeg);
	var topItemsVegChart = $('#pie-chart-veg');
	var itemNames = topItemsVeg.map(item => item.name); // Extract item names
	var itemQuantities = topItemsVeg.map(item => item.total_quantity); // Extract quantities

	var myChart = new Chart(topItemsVegChart, {
		type: 'doughnut',
		data: {
			labels: itemNames,
			datasets: [{
				label: 'Top Selling (Veg)',
				data: itemQuantities,
				backgroundColor: [
					'rgb(175, 238, 238)',   // Pale Turquoise
					'rgb(0, 139, 139)',   // Dark Cyan
					'rgb(0, 255, 255)',   // Cyan
					'rgb(64, 224, 208)',   // Turquoise
					'rgb(127, 255, 212)',  // Aquamarine
					'rgb(0, 139, 139)',   // Deep Teal
					'rgb(0, 160, 160)',      // Medium Teal
					'rgb(0, 191, 191)',      // Light Teal
					'rgb(0, 102, 102)',      // Dark Teal
					'rgb(0, 128, 128)',    // Teal
				],
				hoverOffset: 4
			}]
		}
	});

	var topItemsNonVeg = @json($topItemsNonVeg);
	var topItemsNonVegChart = $('#pie-chart-nonveg');
	var itemNames = topItemsNonVeg.map(item => item.name); // Extract item names
	var itemQuantities = topItemsNonVeg.map(item => item.total_quantity); // Extract quantities

	var myChart = new Chart(topItemsNonVegChart, {
		type: 'doughnut',
		data: {
			labels: itemNames,
			datasets: [{
				label: 'Top Selling (Non Veg)',
				data: itemQuantities,
				backgroundColor: [
					'rgb(175, 238, 238)',   // Pale Turquoise
					'rgb(0, 139, 139)',   // Dark Cyan
					'rgb(0, 255, 255)',   // Cyan
					'rgb(64, 224, 208)',   // Turquoise
					'rgb(127, 255, 212)',  // Aquamarine
					'rgb(0, 139, 139)',   // Deep Teal
					'rgb(0, 160, 160)',      // Medium Teal
					'rgb(0, 191, 191)',      // Light Teal
					'rgb(0, 102, 102)',      // Dark Teal
					'rgb(0, 128, 128)',    // Teal
				],
				hoverOffset: 4
			}]
		}
	});
</script>
@endsection

<!-- <div class="col-12 col-lg-6">
	<div class="app-card app-card-stats-table h-100 shadow-sm">
		<div class="app-card-header p-3">
			<div class="row justify-content-between align-items-center">
				<div class="col-auto">
					<h4 class="app-card-title">Top Selling Item(Veg)</h4>
				</div>
				
			</div>
		</div>
		<div class="app-card-body p-3 p-lg-4">
			<div class="table-responsive">
				<table class="table table-borderless mb-0">
					<thead>
						<tr>
							<th class="meta ">Name</th>
						
							<th class="meta ">Quantity</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($topItemsVeg as $item)
						<tr>
							<td class="cell">{{$item['name']}}</td>
							
							<td class="cell">{{$item['total_quantity']}}</td>
							@endforeach
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="col-12 col-lg-6">
	<div class="app-card app-card-stats-table h-100 shadow-sm">
		<div class="app-card-header p-3">
			<div class="row justify-content-between align-items-center">
				<div class="col-auto">
					<h4 class="app-card-title">Top Selling Items(Non-Veg)</h4>
				</div>
			</div>
		</div>
		<div class="app-card-body p-3 p-lg-4">
			<div class="table-responsive">
				<table class="table table-borderless mb-0">
					<thead>
						<tr>
							<th class="meta">Name</th>
							<th class="meta">Quantity</th>
							{{-- <th class="meta stat-cell">Price</th> --}}
						</tr>
					</thead>
					<tbody>
						@foreach ($topItemsNonVeg as $item)
						<tr>
							<td class="cell">{{$item['name']}}</td>
							<td class="cell">{{$item['total_quantity']}}</td>
						@endforeach
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div> -->