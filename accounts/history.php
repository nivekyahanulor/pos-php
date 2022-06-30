<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('controller/history.php');?>

<style type="text/css">
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	/* Firefox */
	input[type=number] {
	  -moz-appearance: textfield;
	}

	tr:hover{
		background: #ddd !important;
		color: #777;
		cursor: pointer;
	}

	.unpaid{
		background: #e74c3c;
		color: #fff
	}
	.paid{
		background: #2ecc71;
		color: #fff
	}
	tr{
		text-align: center;
	}
</style>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Order History</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Order</li>
          <li class="breadcrumb-item active">History</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Select Customer</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable hover-datatable" id="myTable">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">Trans Code</th>
                    <th scope="col"  class="text-center">Customer Name</th>
                    <th scope="col"  class="text-center">Transaction Date</th>
                    <th scope="col"  class="text-center">Payment Flag</th>
 
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $order->fetch_object()){ 
					if($val->status == 1){
						$paidBG = 'paid';
					}else{
						$paidBG = 'unpaid';
					}
				?>
					
                  <tr class="order-sel <?php echo $paidBG ?>" onClick="getOrderByID('<?= $val->transcode ?>','<?= $val->status ?>','<?= $val->amount ?>','<?= $val->transcode ?>','<?= $val->customer_id ?>','<?= $val->total_amount ?>','<?= $val->discounted_amount ?>','<?= $val->discount_1 ?>','<?= $val->discount_2 ?>')">
                  	<td class="text-center"><?php echo $val->transcode;?></td>
                    <td class="text-center"><?php echo $val->firstname . ' '. $val->lastname;?></td>
                    <td class="text-center"><?php echo $val->created_at;?></td>
                    <td class="text-center"><?php echo $val->status;?></td>
                  </tr>
			
                <?php } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  
	
	<div id="order-con" style="display:none">
		<section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Select Item  <button class="btn btn-primary btn-md" id="btn-add-order" data-bs-toggle="modal" data-bs-target="#add-item"> <i class="bi bi-plus-square"></i> Add Order </button></h5>

              <!-- Table with stripped rows -->
              <table class="table" id="order-tbl">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center"></th>
                    <th scope="col"  class="text-center">Trans Code</th>
                    <th scope="col"  class="text-center">Customer Name</th>
                    <th scope="col"  class="text-center">Item Code</th>
                    <th scope="col"  class="text-center">Item Name</th>
                    <th scope="col"  class="text-center">Item Qty</th>
                    <th scope="col"  class="text-center">Stock Qty</th>
                    <th scope="col"  class="text-center">Item Price</th>
                    <th scope="col"  class="text-center">Total Price</th>
                    <th scope="col"  class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
				
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

   
	</div>

	
	
	   

        <div class="modal-footer">
			<div id="view-dr"></div>
			<button onclick="showPaymentForm()"  id="payment-btn"  style="display: none;"type="button" class="btn btn-primary" name="add-customer">Pay Now </button>
		</div>
		</form>
         </div>
       </div>
        </div>
    <div class="modal fade" id="payment-id" tabindex="-1">
	 <div class="modal-dialog modal-dialog-centered modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title">Payment Form</h5>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
		   <form class="row g-1" method="post">
		   <br>
		   <div class="row">
			<div class="col-6">
				<div class="col-12">
				  <label for="inputNanme4" class="form-label">Item Count: </label>
				  <input type="text" class="form-control" id="payment-count" readonly>
				</div>
				
			</div>
			<div class="col-6">
				<div class="col-12">
				  <label for="inputNanme4" class="form-label">Total Amount: </label>
				  <input type="text" class="form-control" id="payment-total" readonly>
				</div>
				
			</div>
			</div>
			<div class="row">
				<div class="col-6">
					<div class="col-12">
					  <label for="inputNanme4" class="form-label">Discount # 1 (%): </label>
					  <input type="text" class="form-control" id="discount1" name="discount1" value="0" >
					</div>
					
				</div>
				<div class="col-6">
					<div class="col-12">
					  <label for="inputNanme4" class="form-label">Discount # 2 (%): </label>
					  <input type="text" class="form-control" id="discount2" name="discount2" value="0" >
					</div>
					
				</div>
			</div>
		   <hr>
		   <div class="row">
		  <div class="col-6">
					<div class="col-12">
					  <label for="inputNanme4" class="form-label">Total Net Amount: </label>
					  <input type="text" class="form-control" id="total-net" value="0" readonly>
					</div>
					
				</div>
		   </div>
		   <hr>
			<div class="row">
			<div class="col-6">
				<div class="col-12">
				  <label for="inputNanme4" class="form-label">Cash: </label>
				  <input type="number" class="form-control" id="payment-cash">
				</div>
				
			</div>
			<div class="col-6">
				<div class="col-12">
				  <label for="inputNanme4" class="form-label">Change: </label>
				  <input type="text" class="form-control" id="payment-change" value="0" readonly>
				</div>
				
			</div>
			
			</div>
		
				<div class="modal-footer">
				  <button type="button" id="btn-pay" onclick="submitPayment()" class="btn btn-primary" name="update-item">Pay Now</button>
				  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
				</form>
		</div>
		</div>
		</div>
	</div>
	
	    <div class="modal fade" id="add-item" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Order Form</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <form class="row g-3" method="post">
						<div class="col-12">
							<div class="col-12">
							  <label for="inputNanme4" class="form-label"> Item: </label>
							   <select class=" form-control" name="item_code" id="item_code_select" required>
									<option value="" selected> - Select Item - </option>
									<?php
										$pos_items = $mysqli->query("SELECT * from pos_items");
											while($val1 = $pos_items->fetch_object()){
											?>
										<option value="<?php echo $val1->item_code;?>"> <?php echo $val1->item_code;?></option>
									<?php } ?>
								 </select>
							</div>
							<br>
							<div id="get-selected-item" style="display:none;">
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Name: </label>
								  <input type="text" class="form-control" name="item_name" id="item_name_selected" required readonly>
								  <input type="hidden" class="form-control" name="item_transcode" id="item_transcode_selected" required readonly>
								  <input type="hidden" class="form-control" name="item_customer_id" id="item_customer_id" required readonly>
								  <input type="hidden" class="form-control" name="item_id" id="item_id" required readonly>
								  <input type="hidden" class="form-control" name="item_status" id="item_status" required readonly>
								  <input type="hidden" class="form-control" name="item_total_amount" id="item_total_amount" required readonly>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Price: </label>
								  <input type="text" class="form-control" name="item_price" id="item_price_selected"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required readonly>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Stock Quantity: </label>
								  <input type="text" class="form-control" name="item_price" id="total-qty"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required readonly>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Quantity: </label>
								  <input type="text" class="form-control" name="item_qty" id="item-qty"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required >
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Total: </label>
								  <input type="text" class="form-control" name="total" id="total"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly required >
								</div>
							</div>
						</div>
			
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="submitAddOrder()" name="add-item-order">Add </button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
        </div>
        </div>
		<div class="modal fade" id="update_item" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update Order</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <form class="row g-3" method="post">
						<div class="col-12">
							<div class="col-12">
							
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Name: </label>
								  <input type="text" class="form-control" name="item_name" id="item_name_update" required readonly>
								  <input type="hidden" class="form-control" name="order_id" id="order_id" required readonly>
								  <input type="hidden" class="form-control" name="item_transcode" id="item_transcode" required readonly>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Price: </label>
								  <input type="text" class="form-control" name="item_price" id="item_price_update"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required readonly>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Stock Quantity: </label>
								  <input type="text" class="form-control" name="item_price" id="total-qty1"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required readonly>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Quantity: </label>
								  <input type="text" class="form-control" name="item_qty" id="item-qty1"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required >
								</div>
							
						</div>
			
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="submitUpdateOrder()">Update </button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
        </div>
        </div>
        </div>
		<div class="modal fade" id="delete_item" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete Order</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <form class="row g-3" method="post">
						<div class="col-12">
							<div class="col-12">
							Are you sure to delete this Order?
							<input type="text" class="form-control" name="order_id" id="order_id_delete" required readonly>
							<input type="hidden" class="form-control" name="item_transcode" id="item_transcode_delete" required readonly>
						</div>
			
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning" onclick="submitDeleteOrder()">Delete </button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
        </div>
        </div>
        </div>
		
  </main><!-- End #main -->

 
<?php include('footer.php');?>

<script type="text/javascript">
$( "select#item_code_select" ).on('change', function() {
	  $("#get-selected-item").show();
	    var item_codes = $("#item_code_select").val();
		var text =  $('#item_code_select').val();
		$.ajax({
			type: "POST",
			url: 'controller/api.php',
			data : {
				'item_code'  : item_codes , 
				'get_item_code'  : '1' , 
			},
			success: function(result)
			{
				var selected_data = $.parseJSON(result);
                $('#item_name_selected').val(selected_data.item_name)
                $('#item_price_selected').val(selected_data.item_price)
                $('#total-qty').val(selected_data.item_qty)
			}
		});	
});
</script>
<script>
$(document).on('click', '.update_order', function (e) {
	var table1 = $('#order-tbl').DataTable();
	var data = table1.row( $(this).parents('tr') ).data();
						$("#item_name_update").val( data[3]);
						$("#item_price_update").val( data[7]);
						$("#total-qty1").val( data[6]);
						$("#item-qty1").val( data[5]);
						$("#order_id").val( data[0]);
						$("#item_transcode").val( data[1]);
						$('#update_item').modal('show');
});
$(document).on('click', '.delete_order', function (e) {
	var table1 = $('#order-tbl').DataTable();
	var data = table1.row( $(this).parents('tr') ).data();
	$("#order_id_delete").val(data[0]);
	$("#item_transcode_delete").val( data[1]);
	$('#delete_item').modal('show');
});
function submitAddOrder(){

	$('#order-con').show();
		if($('#item_qty').val() == '' || parseFloat($('#total').val()) < 0){
			Swal.fire({
			title: "Error! ",
			text: "Invalid Quantity",
			icon: "error",
			}).then(function(){
				
			});
			
		}else {
			var item_transcode = $("#item_transcode_selected").val();
			var item_customer_id = $("#item_customer_id").val();
			var item_id = $("#item_id").val();
			var item_status = $("#item_status").val();
			var item_total_amount = $("#item_total_amount").val();
			var total = $("#total").val();
			var item_qty = $("#item-qty").val();
			var item_code_select = $("#item_code_select").val();
		
			curr_status = status;
			
			$.ajax({
				type: "POST",
				url: 'controller/api.php',
				data : {
					'item_transcode'    : item_transcode , 
					'item_customer_id'  : item_customer_id , 
					'total' 			: total , 
					'item_qty'  		: item_qty , 
					'item_code_select'  : item_code_select , 
					'save_add_item_1'  	: '1' , 
				},
				success: function(result)
				{
					Swal.fire({
						title: "Order Added! ",
						text: "Order Added",
						icon: "success",
					}).then(function(){
						 $("#add-item").modal('hide');
					});
					curr_status = status;
					$.ajax({
						url: 'controller/api.php',
						data: {
							'id': item_id,
							'getOrderByID': '1'
						},
						type: "POST",
						success: function (result) {
							
							
							$('#order-con').show();
						 

							var dataset =  [];

							$('#payment-count').val($.parseJSON(result).length)

							$.each($.parseJSON(result),function(k,v){
								var arr = Object.keys(v).map(function (key) { return v[key]; });

								dataset.push(arr);
								var itemObj = {
									'item_code' : v.item_code,
									'item_price' : v.item_price,
									'item_qty' : v.qty,
									'item_total' : v.amount,
								}

								orders.push(itemObj);
								cust_arr['customer_id'] = v.customer_id;
								transcode = v.transcode
							})


							var table = $('#order-tbl').DataTable( {
									data: dataset,
									"bDestroy": true,
									"columnDefs": [
										{
										  "data": null,
										  "defaultContent": "<button class='btn btn-sm btn-primary update_order'><i class='bi bi-pencil-square'></i></button>&nbsp;&nbsp; <button class='btn btn-sm btn-warning delete_order'><i class='bi bi-trash'></i></button>",
										  "targets": [-1]
										},{
										  "visible": false,
										  "targets": [0]
										}
								  ]
								} );

							$(document).scrollTop($(document).height());
					   
							
						}
					});
				}
			});	
				
		}
	}

function submitDeleteOrder(){
			var order_id = $("#order_id_delete").val();
			var item_id = $("#item_transcode_delete").val();
		
			curr_status = status;
			
			$.ajax({
				type: "POST",
				url: 'controller/api.php',
				data : {
					'order_id'  : order_id , 
					'delete_item'  	: '1' , 
				},
				success: function(result)
				{
					Swal.fire({
						title: "Order Deleted! ",
						text: "Order Deleted",
						icon: "success",
					}).then(function(){
						$('#delete_item').modal('hide');
					});
					curr_status = status;
					$.ajax({
						url: 'controller/api.php',
						data: {
							'id': item_id,
							'getOrderByID': '1'
						},
						type: "POST",
						success: function (result) {
							

							// $('#order-con').show();
						 

							var dataset =  [];

							$('#payment-count').val($.parseJSON(result).length)

							$.each($.parseJSON(result),function(k,v){
								var arr = Object.keys(v).map(function (key) { return v[key]; });

								dataset.push(arr);
								var itemObj = {
									'item_code' : v.item_code,
									'item_price' : v.item_price,
									'item_qty' : v.qty,
									'item_total' : v.amount,
								}

								orders.push(itemObj);
								cust_arr['customer_id'] = v.customer_id;
								transcode = v.transcode
							})


							  var table = $('#order-tbl').DataTable( {
									data: dataset,
									"bDestroy": true,
									"columnDefs": [
										{
										  "data": null,
										  "defaultContent": "<button class='btn btn-sm btn-primary update_order'><i class='bi bi-pencil-square'></i></button>&nbsp;&nbsp; <button class='btn btn-sm btn-warning delete_order'><i class='bi bi-trash'></i></button>",
										  "targets": [-1]
										},{
										  "visible": false,
										  "targets": [0]
										}
								  ]
								} );
				
							
							$(document).scrollTop($(document).height());
					   
							
						}
					});
				}
			});	

}
function submitUpdateOrder(){
		if($('#item_qty1').val() == ''){
			Swal.fire({
			title: "Error! ",
			text: "Invalid Quantity",
			icon: "error",
			}).then(function(){
				
			});
			
		}else {
			var order_id = $("#order_id").val();
			var item_qty1 = $("#item-qty1").val();
			var item_id = $("#item_transcode").val();
		
			curr_status = status;
			
			$.ajax({
				type: "POST",
				url: 'controller/api.php',
				data : {
					'order_id'  : order_id , 
					'item_qty'  : item_qty1 , 
					'save_add_item'  	: '1' , 
				},
				success: function(result)
				{
					Swal.fire({
						title: "Order Updated! ",
						text: "Order Updated",
						icon: "success",
					}).then(function(){
						$('#update_item').modal('hide');
					});
					curr_status = status;
					$.ajax({
						url: 'controller/api.php',
						data: {
							'id': item_id,
							'getOrderByID': '1'
						},
						type: "POST",
						success: function (result) {
							

							// $('#order-con').show();
						 

							var dataset =  [];

							$('#payment-count').val($.parseJSON(result).length)

							$.each($.parseJSON(result),function(k,v){
								var arr = Object.keys(v).map(function (key) { return v[key]; });

								dataset.push(arr);
								var itemObj = {
									'item_code' : v.item_code,
									'item_price' : v.item_price,
									'item_qty' : v.qty,
									'item_total' : v.amount,
								}

								orders.push(itemObj);
								cust_arr['customer_id'] = v.customer_id;
								transcode = v.transcode
							})


							  var table = $('#order-tbl').DataTable( {
									data: dataset,
									"bDestroy": true,
									"columnDefs": [
										{
										  "data": null,
										  "defaultContent": "<button class='btn btn-sm btn-primary update_order'><i class='bi bi-pencil-square'></i></button>&nbsp;&nbsp; <button class='btn btn-sm btn-warning delete_order'><i class='bi bi-trash'></i></button>",
										  "targets": [-1]
										},{
										  "visible": false,
										  "targets": [0]
										}
								  ]
								} );
				
							
							$(document).scrollTop($(document).height());
					   
							
						}
					});
				}
			});	
				
	}

}
</script>
<script type="text/javascript">
	var orders = [];
	var cust_arr = [];
	var sum = 0;
	var transcode = '';
	var curr_status = 0;
	$('#item-qty').on('keyup',function(){
		if($(this).val() == ''){
			$('#total').val('0');
		}else{

			if(parseInt($(this).val()) > parseInt($('#total-qty').val()) ){
				Swal.fire({
				title: "Error! ",
				text: "Invalid Quantity Stocks",
				icon: "error",
				}).then(function(){
					
				});

				$(this).val('')
			}else{
				$('#total').val(parseInt($(this).val()) * parseFloat($('#item_price_selected').val()));
			}

			
		}
	});
	
	$('#item-qty1').on('keyup',function(){
		if($(this).val() == ''){
			// $('#total').val('0');
		}else{

			if(parseInt($(this).val()) > parseInt($('#total-qty1').val()) ){
				Swal.fire({
				title: "Error! ",
				text: "Invalid Quantity Stocks",
				icon: "error",
				}).then(function(){
					
				});

				$(this).val('')
			}else{
				// $('#total').val(parseInt($(this).val()) * parseFloat($('#item_price_selected').val()));
			}

			
		}
	});

	function showPaymentForm(){
		$('#payment-id').modal('show');
		var item_transcode = $("#item_transcode_selected").val();
		$.ajax({
			type: "POST",
			url: 'controller/api.php',
			data : {
				'item_code'  : item_transcode , 
				'get_total_amount'  : '1' , 
			},
			success: function(result)
			{
				var selected_data = $.parseJSON(result);
                var net1 = selected_data.amount;
				var net = $('#payment-total').val(net1);	
				
				var discount1 = $('#discount1').val();
				var discount2 = $('#discount2').val();
		
				var total = net1 - (net1 * ( (parseInt(discount1) + parseInt(discount2)) / 100));
				$('#total-net').val(total);
				
			}
		});	
		
		$('#payment-change').val('');
		$('#payment-cash').val('');
	}

	$('#payment-cash').on('keyup',function(){
		if($(this).val() == ''){
			$('#payment-change').val('0');
		}else{

			$('#payment-change').val(parseInt($(this).val()) - parseFloat($('#total-net').val()));
		}
	});
	function getOrderByID(id,status,total_amount,code,customer, totalamount , discountedamount , discount1 , discount2){
		var dscounted = total_amount - (total_amount * ( (parseInt(discount1) + parseInt(discount2)) / 100));
		$('#payment-total').val(total_amount);
		$('#discount1').val(discount1);
		$('#discount2').val(discount2);
		$('#item_transcode_selected').val(code);
		$('#item_customer_id').val(customer);
		$('#item_id').val(id);
		$('#item_status').val(status);
		$('#item_total_amount').val(total_amount);
		$('#total-net').val(dscounted);
		$('#view-dr').html('<a href="print-payment.php?transcode='+code+'" target="_blank"><button type="button" class="btn btn-secondary"> View DR </button></a>');

		if(status == 0){
			$('#payment-btn').show();
			$('#btn-add-order').show();
		} else {
			$('#btn-add-order').hide();
			$('#payment-btn').hide();
		}
		curr_status = status;
		$.ajax({
            url: 'controller/api.php',
            data: {
                'id': id,
                'getOrderByID': '1'
            },
            type: "POST",
            success: function (result) {
                
                
                $('#order-con').show();
             

                var dataset =  [];

                $('#payment-count').val($.parseJSON(result).length)

                $.each($.parseJSON(result),function(k,v){
                	var arr = Object.keys(v).map(function (key) { return v[key]; });

                	dataset.push(arr);
                	var itemObj = {
						'item_code' : v.item_code,
						'item_price' : v.item_price,
						'item_qty' : v.qty,
						'item_total' : v.amount,
					}

					orders.push(itemObj);
					cust_arr['customer_id'] = v.customer_id;
					transcode = v.transcode
                })

                var table = $('#order-tbl').DataTable( {
				    data: dataset,
    				"bDestroy": true,
					"columnDefs": [
						{
						  "data": null,
						  "defaultContent": "<button class='btn btn-sm btn-primary update_order'><i class='bi bi-pencil-square'></i></button>&nbsp;&nbsp; <button class='btn btn-sm btn-warning delete_order'><i class='bi bi-trash'></i></button>",
						  "targets": [-1]
						},{
						  "visible": false,
						  "targets": [0]
						}
				  ]
				} );
				
					

                $(document).scrollTop($(document).height());
           
                
            }
        });
	}

	function deleteItem(itemcode,itemname){
		$.ajax({
            url: 'controller/api.php',
            data: {
                'itemcode': itemcode,
                'deleteOrder': '1'
            },
            type: "POST",
            success: function (result) {

            	// console.log(result)
                Swal.fire({
				title: "Success! ",
				text: itemname + " Order Item has been Cancelled",
				icon: "success",
				type: "success"
				}).then(function(){
					setTimeout(function(){
						window.location.reload();
					},1000)
					
				});
                
            }
          })
	}

	function selectItem(id,price,qty){

		if(qty<1){
			Swal.fire({
			title: "Error! ",
			text: "No Stock Available",
			icon: "error",
			}).then(function(){
				
			});
		}else{
			$('#item-qty').val('');
			$('#submit-qty-id').modal('show');
			$('#item-code').val(id);
			$('#item-price').val(price);
			$('#total-price').val('0 : ')
			$('#total-qty').text(qty)
		}

		

		// orders = orders + id;

		// console.log(cust_arr);
	}
	$( "#discount1" ).change(function() {
		var net = $('#payment-total').val();
		var net1 = $('#total-net').val();
		var discount1 = $("#discount1").val();
		if(discount1 ==0){
			var discount2 = $("#discount2").val();

			var total = (parseInt(net) - (net * ( discount2 / 100)));
			
		} else {
			
			var total = net1 - (net * ( discount1 / 100));
		
		}
		$('#total-net').val(total)
	});
	$( "#discount2" ).change(function() {
		var net = $('#payment-total').val();
		var net1 = $('#total-net').val();
		var discount2 = $("#discount2").val();
		if(discount2 ==0){
			var discount1 = $("#discount1").val();

			var total = (parseInt(net) - (net * ( discount1 / 100)));
			
		} else {
		var total = net1 - (net * ( discount2 / 100));
		}
		$('#total-net').val(total)
	});
	function submitSelectedItem(){
		var itemObj = {
			'item_code' : $('#item-code').val(),
			'item_price' : $('#item-price').val(),
			'item_qty' : $('#item-qty').val(),
			'item_total' : $('#total').val(),
		}

		orders.push(itemObj);
		$('#submit-qty-id').modal('hide');

		// console.log(orders);
		$('#item-body tr').remove();
		sum = 0;
		$.each(orders,function(k,v){
			// console.log(v.item_code)
			$('#item-body').append(`
				<tr>
			      <td>`+v.item_code+`</th>
			      <td>`+v.item_price+`</td>
			      <td>`+v.item_qty+`</td>
			      <td>`+v.item_total+`</td>
			    </tr>
			`);

			sum = sum + parseFloat(v.item_total);


		})

		$('#sum').text(sum);
	}

	function saveOrderPayment(){
		if(orders.length == 0 || cust_arr.length == 0){
			Swal.fire({
			title: "Error! ",
			text: "Please Select Customer and Add Item Order",
			icon: "error",
			}).then(function(){
				
			});
		}else{
			$('#payment-id').modal('show')
			$('#payment-count').val(orders.length)
			$('#payment-total').val(sum)
		}
	}

	function submitPayment(){
			console.log(orders);

		if($('#payment-cash').val() == '' || parseFloat($('#payment-change').val()) < 0){
			Swal.fire({
			title: "Error! ",
			text: "Invalid Cash Amount",
			icon: "error",
			}).then(function(){
				
			});
		}else {
			$('#btn-pay').text('Processing');
			$('#btn-pay').attr('disabled','disabled');


			$.ajax({
            url: 'controller/api.php',
            data: {
                'transcode': transcode,
                'orders': orders,
                'customer': cust_arr,
                'total_amount': $('#payment-total').val(),
                'discount1': $('#discount1').val(),
                'discount2': $('#discount2').val(),
                'cash': $('#payment-cash').val(),
                'total': $('#total-net').val(),
                'submitPayment': '1'
            },
            type: "POST",
            success: function (result) {
                Swal.fire({
				title: "Success! ",
				text: "Payment Success",
				icon: "success",
				type: "success"
				}).then(function(){
					$('#btn-pay').hide();
					setTimeout(function(){
						window.location = 'print-payment.php?transcode='+transcode;
					},1000)
					
				});
                
            }
        });

			
		}
		
	}

</script>