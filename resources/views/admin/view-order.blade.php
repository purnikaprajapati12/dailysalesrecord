@extends('admin.layouts.main')

@section('main-container') 
<style>
    body {
        background-color: #F6F6F6; 
        margin: 0;
        padding: 0;
        font-size: 12px; /* Default font size */
    }
    h1, h2, h3, h4, h5, h6 {
        margin: 0;
        padding: 0;
    }
    h2,h3{
        font-size: 16px;
        padding-top: 5px;
        padding-bottom: 5px;
    }
    p {
        margin: 0;
        padding: 0;
        padding-top: 5px;
        padding-bottom: 5px;
        font-size: 16px;
    }
    .main-heading{
        text-align: center;
        font-size: 25px;
        /* font-weight: 100; */
        padding-top: 5px;
    }
    .main-sub-heading{
        text-align: center;
        font-size: 15px;
        padding-top: 3px;
    }
    .logo-icon{
        width:30px;
        height: auto;
    }
    .invoice-container {
        width: 100%; /* Full width for the invoice */
        padding: 10px; /* Add some padding */
        margin: 10px auto; /* Center container */
        border: 1px solid gray; /* Optional border for visibility */
    }
    table {
        background-color: #fff;
        width: 100%;
        border-collapse: collapse;
        font-size: 16px; /* Set table font size */
    }
    table thead th {
        border: 1px solid #111;
        background-color: #f2f2f2;
        text-align: center;
        font-weight: 500px;
        
    }
    table thead tr {
        border: 1px solid #111;
        background-color: #f2f2f2;
    }
    table td {
        vertical-align: middle !important;
        text-align: center;
        padding: 5px; /* Reduce padding in table cells */
        
    }
    @media print {
        body * {
            visibility: hidden; /* Hide all elements */
        }
        .invoice-container, .invoice-container * {
            visibility: visible; /* Show only the invoice container and its children */
        }
        .invoice-container {
            position: absolute; /* Position the invoice container for printing */
            left: 0;
            top: 0;
        }
        .app-btn-secondary {
            display: none; /* Hide the print button when printing */
        }
    }
</style>


    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">			    
			    <h1 class="app-page-title">Sales Invoice</h1>
                <div class="col-auto">						    
								<a class="btn app-btn-secondary" onclick="window.print()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
  <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
  <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
</svg>
									Print
								</a>
							</div>
                            <div class="invoice-container">
    <!-- Your existing invoice content here -->
			    <hr class="mb-4">
                <div class="row g-4 settings-section">
					<div class="container">
						<div class="body-section">
							<div class="row">
                                <div>
                                
                                <h1 class="main-heading"> <img class="logo-icon me-2" src="{{url('frontend/images/app-logo.svg')}}"
                                alt="logo">Tucha Dhuku Newa Chatamari</h1>
                                <h2 class="main-sub-heading">Hyumat, Teku</h2>
                                <h2 class="main-sub-heading">Contact: 9876543212</h2>
                                </div>
								<div class="col-6">
									<h2 class="heading">Date: {{@$order->date}} </h2>
									<p class="sub-heading">Code.: {{@$order->order_code}}</p>
                                    <p class="sub-heading">Full Name: {{@$order->customer_name}} </p>
								</div>
								<div class="col-6">
								</div>
							</div>
						</div>

						<div class="body-section">
							<h3 class="heading">Items Detail</h3>
							<br>
							<table class="table-bordered">
								<thead>
									<tr>
                                        <th>SN.</th>
										<th>Item</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
                                    @php $i=0 @endphp
									@foreach(@$order->order_detail as $row)
                                    @php $i++ @endphp
									<tr>
                                        <td>{{$i}}</td>
										<td>{{$row->item->name}}</td>
										<td>{{$row->price}}</td>
										<td>{{$row->quantity}}</td>
										<td>{{$row->amount}}</td>
									</tr>
									@endforeach
									<tr>
										<td colspan="3" class="text-right">Sub Total</td>
										<td>Rs. {{$order->total + $order->discount}}</td>
									</tr>
									<tr>
										<td colspan="3" class="text-right">Discount</td>
										<td>Rs. {{$order->discount}}</td>
									</tr>
									<tr>
										<td colspan="3" class="text-right">Grand Total</td>
										<td>Rs. {{$order->total}}</td>
									</tr>
								</tbody>
							</table>
							<br>
						</div>

					</div><!--//app-card-body-->
	                </div>
                <!-- <hr class="my-4"> -->
                </div>
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->		

        <script>
            function printinvoice() {
                window.print();
            }
        </script>
@endsection

