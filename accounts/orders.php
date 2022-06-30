<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('controller/payment.php');?>

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
</style>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Order Payment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Order</li>
          <li class="breadcrumb-item active">Payment</li>
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
                    <th scope="col"  class="text-center">Name</th>
                    <th scope="col"  class="text-center">Address</th>
                    <th scope="col"  class="text-center">Contact</th>
 
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $customer->fetch_object()){ ?>
				
                  <tr>
                    <td class="text-center"><a href="#" onClick="getCustomerByID('<?= $val->customer_id ?>')"><?php echo $val->firstname . ' '. $val->lastname;?></a></td>
                    <td class="text-center"><a href="#" onClick="getCustomerByID('<?= $val->customer_id ?>')"><?php echo $val->address;?></a></td>
                    <td class="text-center"><a href="#" onClick="getCustomerByID('<?= $val->customer_id ?>')"><?php echo $val->contact;?></a></td>
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

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" id="no-sel">No Selected User</h5>
              <h5 class="card-title cust-data" style="display:none">Customer ID: <span id="cust-id"></span></h5>
              <h5 class="card-title cust-data" style="display:none">Name: <span id="cust-name"></span></h5>
              <h5 class="card-title cust-data" style="display:none">Address: <span id="cust-address"></span></h5>
              <h5 class="card-title cust-data" style="display:none">Contact: <span id="cust-contact"></span></h5>
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
              <h5 class="card-title">Select Item</h5>

              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">Item Code</th>
                    <th scope="col"  class="text-center">Item Name</th>
                    <th scope="col"  class="text-center">Price</th>
                    <th scope="col"  class="text-center">Qty</th>
                    <th scope="col"  class="text-center">Unit</th>
                    <th scope="col"  class="text-center">Critical Level</th>
                    <th scope="col"  class="text-center">Supplier</th>
                    <th scope="col"  class="text-center">Category</th>
  
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $inventory->fetch_object()){ ?>
				<?php if($val->item_critical_level == $val->item_qty){?>
                  <tr bgcolor="#e74c3c" onClick="selectItem('<?= $val->item_code ?>','<?= $val->item_name ?>','<?= $val->item_price ?>','<?= $val->item_qty ?>')" style="color:#fff">
                <?php } else if($val->item_qty == 0){?>
                <tr bgcolor="#777" onClick="selectItem('<?= $val->item_code ?>','<?= $val->item_name ?>','<?= $val->item_price ?>','<?= $val->item_qty ?>')" style="color:#fff">
				<?php } else { ?>
				  <tr onClick="selectItem('<?= $val->item_code ?>','<?= $val->item_name ?>','<?= $val->item_price ?>','<?= $val->item_qty ?>')">
				<?php } ?>
                    <td class="text-center"><?php echo $val->item_code;?></td>
                    <td class="text-center"><?php echo $val->item_name;?></td>
                    <td class="text-center"><?php echo $val->item_price;?></td>
                    <td class="text-center"><?php echo $val->item_qty;?></td>
                    <td class="text-center"><?php echo $val->item_unit;?></td>
                    <td class="text-center"><?php echo $val->item_critical_level;?></td>
                    <td class="text-center"><?php echo $val->supplier;?></td>
                    <td class="text-center"><?php echo $val->category;?></td>

                  </tr>
                <?php } ?>
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" id="no-sel">Selected Item/s</h5>
              <table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Item Code</th>
				      <th scope="col">Price</th>
				      <th scope="col">Qty</th>
				      <th scope="col">Total Price</th>
				    </tr>
				  </thead>
				  <tbody id="item-body">
				  </tbody>
				  <tfoot>
				    <tr>
				      <td></td>
				      <td></td>
				      <td style="text-align:right">Total Amount:</td>
				      <td><span id="sum">0</span></td>
				    </tr>
				  </tfoot>
				</table>

              

            </div>
          </div>

        </div>
      </div>
    </section>
	</div>

	<div class="modal fade" id="submit-qty-id" tabindex="-1">
	 <div class="modal-dialog modal-dialog-centered modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title">Enter Quantity</h5>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
		   <form class="row" method="post">
		   <div class="row">
		   	<label>AVAILABLE STOCK/S : <span id="total-qty" style="font-weight:bold"></span></label>
		   </div>
			<hr>
			<div class="row">
				<div class="col-6">
					<div class="col-12">
					  <label for="inputNanme4" class="form-label">Item Code: </label>
					  <input type="text" class="form-control" id="item-code" readonly>
					</div>
					
				</div>
				<div class="col-6">
					<div class="col-12">
					  <label for="inputNanme4" class="form-label">Item Name: </label>
					  <input type="text" class="form-control" id="item-name" readonly>
					</div>
					
				</div>
			</div>
			<br><br><br><br>
			<div class="row">
				<div class="col-6">
					<div class="col-12">
					  <label for="inputNanme4" class="form-label">Price: ( <input type="checkbox"  id="update_price" name="update_price" value="1"> Edit ) </label>
					  <input type="text" class="form-control" id="item-price" readonly>
					  <input type="text" class="form-control" id="item-price-change" value="0" readonly>
					</div>
				</div>
				<div class="col-6">
					<div class="col-12">
					  <label for="inputNanme4" class="form-label">Quantity: </label>
					  <input type="number" class="form-control" id="item-qty">
					</div>
					
				</div>
			
			</div>
			<br><br><br><br>
			<hr>
			<div class="row">
				<div class="col-6">
					<div class="col-12">
					  <label for="inputNanme4" class="form-label">Total Price: </label>
					  <input type="text" class="form-control" id="total" value="0" readonly>
					</div>
					
				</div>
			</div>

		
				<div class="modal-footer">
				  <button type="button" onclick="submitSelectedItem()" class="btn btn-primary" name="update-item">Submit </button>
				  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
				</form>
		</div>
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
		   <form class="row g-3" method="post">
		   <hr>
		      <div class="row">
			<div class="col-6">
				<div class="col-12">
				  <label for="inputNanme4" class="form-label">Item Count: </label>
				  <input type="text" class="form-control" id="payment-count" readonly>
				  <input type="hidden" class="form-control" id="payment-transcode" readonly>
				</div>
				
			</div>
			<div class="col-6">
				<div class="col-12">
				  <label for="inputNanme4" class="form-label">Total Amount: </label>
				  <input type="text" class="form-control" id="payment-total" readonly>
				</div>
				
			</div>
			</div>
			<hr>
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
					  <input type="hidden" class="form-control" id="total-net1" value="0" readonly>
					  <input type="hidden" class="form-control" id="total-net2" value="0" readonly>
					</div>
					
				</div>
		   </div>
		   <hr>
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
				  <button type="button" class="btn btn-secondary"  id="close-order">Close</button>
				</div>
				</form>
		</div>
		</div>
		</div>
	</div>
	   

                    <div class="modal-footer">
                      <button onclick="saveOrderPayment()" type="button" class="btn btn-primary" name="add-customer">Proceed </button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
        </div>
		
		
  </main><!-- End #main -->

 
<?php include('footer.php');?>

<script type="text/javascript">
	var orders = [];
	var cust_arr;
	var sum = 0;
	var transcode = '';
	$('#item-qty').on('keyup',function(){
		if($(this).val() == ''){
			$('#total').val('0');
		}else{

			if(parseInt($(this).val()) > parseInt($('#total-qty').text()) ){
				Swal.fire({
				title: "Error! ",
				text: "Invalid Quantity Stocks",
				icon: "error",
				}).then(function(){
					
				});

				$(this).val('')
			}else{
				$('#total').val(parseInt($(this).val()) * parseFloat($('#item-price').val()));
			}

			
		}
	});
	
	$( "#close-order" ).click(function() {
		
		var paymenttranscode = $("#payment-transcode").val();
		var paymenttotal = $("#payment-total").val();
		var discount1 = $("#discount1").val();
		var discount2 = $("#discount2").val();
		var totalnet = $("#total-net").val();
		
	  	$.ajax({
			type: "POST",
			url: 'controller/api.php',
			data : {
				'paymenttranscode'  : paymenttranscode , 
				'paymenttotal'  : paymenttotal , 
				'discount1'  : discount1 , 
				'discount2'  : discount2 , 
				'totalnet'  : totalnet , 
				'save_close_order'  : '1' , 
			},
			success: function(result)
			{
				$('#payment-id').modal('hide');

			}
		});	
	});
	

	$('#payment-cash').on('keyup',function(){
		if($(this).val() == ''){
			$('#payment-change').val('0');
		}else{

			$('#payment-change').val(parseInt($(this).val()) - parseFloat($('#total-net').val()));
		}
	});
	function getCustomerByID(id){
		$.ajax({
            url: 'controller/api.php',
            data: {
                'id': id,
                'getCustomerByID': '1'
            },
            type: "POST",
            success: function (result) {
                // console.log($.parseJSON(result).customer_id)
                transcode = 'TC-'+Date.now();
                $('#no-sel').hide();
                $('.cust-data').show();
                $('#order-con').show();
                var cust_data = $.parseJSON(result);
                $('#cust-id').text(cust_data.customer_id)
                $('#cust-name').text(cust_data.firstname+' '+cust_data.lastname)
                $('#cust-address').text(cust_data.address)
                $('#cust-contact').text(cust_data.contact)
                $('#sum').text('0');
                $('#total').val('0');
                $('#item-body tr').remove();

                orders = [];
                cust_arr = cust_data;
            }
        });

        $(document).scrollTop($(document).height());
	}
	
	function selectItem(id,name,price,qty){

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
			$('#item-name').val(name);
			$('#item-price').val(price);
			$('#total-net').val(price);
			$('#total-price').val('0 : ')
			$('#total-qty').text(qty)
		}

		// orders = orders + id;

		// console.log(cust_arr);
	}
	
	$( "#discount1" ).change(function() {
		var net = $('#payment-total').val();
		var discount1 = $("#discount1").val();
		var total = net - (net * ( discount1 / 100));
		$('#total-net1').val(net * ( discount1 / 100))
		
		
		var t1 = $('#total-net1').val();
		var t2 = $('#total-net2').val();
		var net = $('#payment-total').val();
		var stotal = net - (parseInt(t1) + parseInt(t2));
		$('#total-net').val(stotal)
	
		
	});
	$( "#discount2" ).change(function() {
		var net = $('#payment-total').val();
		var net1 = $('#total-net').val();
		var discount2 = $("#discount2").val();
		var total = net - (net * ( discount2 / 100));
		$('#total-net2').val(net * ( discount2 / 100))
		
		var t1 = $('#total-net1').val();
		var t2 = $('#total-net2').val();
		var net = $('#payment-total').val();
		var stotal = net - (parseInt(t1) + parseInt(t2));
		$('#total-net').val(stotal)
		
	});
	
	function submitSelectedItem(){
		var itemObj = {
			'item_code' : $('#item-code').val(),
			'item_price' : $('#item-price').val(),
			'item_price_change' : $('#item-price-change').val(),
			'item_qty' : $('#item-qty').val(),
			'item_total' : $('#total').val(),
			'item_total' : $('#total').val(),
		}

		orders.push(itemObj);
		$('#submit-qty-id').modal('hide');

		// console.log(orders);
		$('#item-body tr').remove();
		sum = 0;
		var cnt = 0;
		$.each(orders,function(k,v){
			// console.log(v.item_code)
			cnt++;
			$('#item-body').append(`
				<tr id="order`+ cnt +`">
			      <td>`+v.item_code+`</th>
			      <td>`+v.item_price+`</td>
			      <td>`+v.item_qty+`</td>
			      <td>`+v.item_total+`</td>
			      <td><button onclick="cancelItem('`+v.item_code+`','order`+cnt+`','`+v.item_total+`')" class="btn btn-danger">Cancel</button></td>
			    </tr>
			`);

			sum = sum + parseFloat(v.item_total);

		})

		$('#sum').text(sum);
	}

	$('#payment-id').on('hidden.bs.modal', function (e) {
	  window.location.reload();
	})

	function cancelItem(item,cnt,total){
		// alert(item)

		Swal.fire({
		  title: 'Do you want to cancel this item order?',
		  showDenyButton: true,
		  // showCancelButton: true,
		  confirmButtonText: 'Cancel',
		  // denyButtonText: `Don't save`,
		}).then((result) => {
		  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    cancelItemSubmit(item,cnt,total)
		  } else if (result.isDenied) {
		    // Swal.fire('Delete', '', 'info')
		  }
		})


	}

	const formatToCurrency = amount => {
	  return "" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
	};

	function cancelItemSubmit(item,cnt,total){


		var removeIndex = orders.map(function(itemm) { return itemm.item_code; }).indexOf(item);
 
		// remove object
		orders.splice(removeIndex, 1);

		console.log(orders)

		var sum = parseFloat($('#sum').text());

		$('#sum').text(sum-parseFloat(total));

		$('#'+cnt).remove();
		Swal.fire({
		title: "Success! ",
		text: "Item Order has been cancelled!",
		icon: "success",
		type: "success"
		}).then(function(){

			
		});
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
			$('#total-net').val(sum)
			$.ajax({
	            url: 'controller/api.php',
	            data: {
	                'transcode': transcode,
	                'orders': orders,
	                'customer': cust_arr,
	                'submitOrder': '1'
	            },
	            type: "POST",
	            success: function (result) {
	                Swal.fire({
					title: "Success! ",
					text: "Order Saved",
					icon: "success",
					type: "success"
					}).then(function(){

						
					});
	              $('#payment-transcode').val(transcode)  
	            }
	        });
		}


	}

	function submitPayment(){
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