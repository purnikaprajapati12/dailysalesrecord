@extends('admin.layouts.main')

@section('main-container')    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">			    
			    <h1 class="app-page-title">Create Sales Record</h1>
			    <hr class="mb-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form" method="POST" action="{{$url}}">
									@csrf
									<div class="mb-3">
										<label for="setting-input-2" class="form-label">Customer Name</label>
										<input type="text" name="customername" class="form-control" id="setting-input-2"  required>
									</div>
									<div class="mb-3">
										<label for="setting-input-2" class="form-label">Sale Date</label>
										<input type="date" name="date" class="form-control" id="setting-input-2"  required>
									</div>
									<div class="mb-3">
										<table>
											<thead>
												<tr>
													<th>
														<label for="setting-input-3" class="form-label">Item Id</label>
													</th>
													<th>
														<label for="setting-input-4" class="form-label">Quantity</label>
													</th>
													<th>
														<label for="setting-input-5" class="form-label">Price</label>
													</th>
													<th>
														<label for="setting-input-5" class="form-label">Total</label>
													</th>
												</tr>
											</thead>
											<tbody id="item-container">
												<tr id="item-0">
													<td>
														<select id="selectItem-0" name="items[0][item_id]" class="form-control" id="setting-input-3" onchange="addPrice(0)" required>
															<option value="">Select item</option>
															@foreach ($items as $item)
															<option value="{{$item->id}}" data-price="{{$item->price}}">{{$item->name}}</option>
															@endforeach
														</select>
													</td>
													<td>
														<input type="number" data-id="0" id="selectItemQty-0" name="items[0][quantity]" class="form-control" id="setting-input-4" onkeyup=changeQty(0) required>
													</td>
													<td>
														<input type="number" id="selectItemPrice-0" step="0.01" name="items[0][price]" class="form-control" id="setting-input-5" required>
													</td>
													<td>
														<input type="number" id="selectItemTotal-0" step="0.01" name="items[0][total]" class="form-control" id="setting-input-5" required>
													</td>
													<td>
														<button type="button" class="btn app-btn-primary" id="add_btn" onClick="addItem()" >
															<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
															<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
														  </svg></button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="mb-3">
									    <label for="setting-input-7" class="form-label">Discount</label>
									    <input type="number" id="itemDiscount" step="0.01" name="discount" class="form-control" id="setting-input-7" value="0" onkeyup="changeDiscount()">
									</div>
									<div class="mb-3">
									    <label for="setting-input-8" class="form-label">Sub Total: </label>
									    <span id="itemSubTotal"></span>
									</div>
									<div class="mb-3">
									    <label for="setting-input-8" class="form-label">Total: </label>
									    <span id="itemGrandTotal"></span>
									</div>
									<button type="submit" class="btn app-btn-primary" >Submit</button>
								</form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->
                <hr class="my-4">
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
		<script type="text/javascript">
			// $(document).ready(function(){
			function addItem(){
				var rowCount = $('#item-container tr').length;
				var html='';
				html+='<tr id="item-'+rowCount+'">';
				html+='<td><select id="selectItem-'+rowCount+'" name="items['+rowCount+'][item_id]" class="form-control" id="setting-input-3" onchange=addPrice("'+rowCount+'")><option value="">Select item</option>@foreach ($items as $item)<option value="{{$item->id}}" data-price={{$item->price}}>{{$item->name}}</option>@endforeach</select></td>';
				html+='<td><input data-id="'+rowCount+'" id="selectItemQty-'+rowCount+'" type="number" name="items['+rowCount+'][quantity]" class="form-control" id="setting-input-4" onkeyup=changeQty("'+rowCount+'")></td>';
				html+='<td><input id="selectItemPrice-'+rowCount+'" type="number" name="items['+rowCount+'][price]" class="form-control" id="setting-input-5"></td>';	
				html+='<td><input id="selectItemTotal-'+rowCount+'" type="number" name="items['+rowCount+'][total]" class="form-control" id="setting-input-5"></td>';	
				html+='<td><button type="button" class="btn btn-danger" id="remove" data-id="" onClick="removeItem('+rowCount+')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/></svg></button></td>';							
				html+='</tr>';
				$('tbody').append(html);
			}
			//});
			function removeItem(index){
				$('#item-'+index).remove();
			}

			function addPrice(index)
			{
				var itemPrice = $('#selectItem-'+index).find(':selected').data('price');
				$('#selectItemPrice-'+index).val(itemPrice);
				$('#selectItemQty-'+index).val(1);
				calTotal(index);
			}

			function calTotal(index)
			{
				var itemQty = $('#selectItemQty-'+index).val();
				var itemPrice = $('#selectItemPrice-'+index).val();
				var itemTotal = itemQty * itemPrice;
				$('#selectItemTotal-'+index).val(itemTotal);
				calGrandTotal();
			}

			function changeQty(index)
			{
				var qtyLength = $('#selectItemQty-'+index).val().length
				if(qtyLength > 0){
					calTotal(index);
				}
			}

			function changeDiscount()
			{
				var length = $('#itemDiscount').val().length
				if(length >= 0){
					calGrandTotal();
				}
			}

			function calGrandTotal()
			{
				console.log('here');
				var subTotal = 0;
				var rowCount = $('#item-container tr').length;
				for(var i=0; i<rowCount; i++){
					subTotal += parseInt($('#selectItemTotal-'+i).val());
				}
				var itemDiscount = $('#itemDiscount').val();
				var grandTotal = subTotal - itemDiscount;
				$('#itemSubTotal').text(subTotal);
				$('#itemGrandTotal').text(grandTotal);
			}

		</script>
		
		
@endsection

