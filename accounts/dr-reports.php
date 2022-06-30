<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('controller/dr-reports.php');?>

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
      <h1>DR / Invoice Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">DR / Invoice</li>
          <li class="breadcrumb-item active">Reports</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
			<br>
						<form class="row g-3" method="post">
							<div class="col-4">
							  <label for="inputNanme4" class="form-label">Status: </label>
							  <select  class="form-control" name="status" required>
								<option value=""> - Select Status -</option>
								<?php if($_POST['status'] == 1){?>
								<option value="1" selected> PAID </option>
								<option value="0"> UNPAID </option>
								<?php } else if($_POST['status'] ==2){?>
								<option value="1"> PAID </option>
								<option value="0" selected> UNPAID </option>
								<?php } else { ?>
								<option value="1"> PAID </option>
								<option value="0" > UNPAID </option>
								<?php } ?>
							  </select>
							</div>
							
							<div class="col-4">
							  <label for="inputNanme4" class="form-label">Date From: </label>
							   <input type="date" class="form-control" name="datefrom" value="<?php echo $_POST['datefrom'];?>" required>
							</div>
							<div class="col-4">
							  <label for="inputNanme4" class="form-label">Date End: </label>
							 <input type="date" class="form-control" name="dateend" value="<?php echo $_POST['dateend'];?>" required>
							</div>
							<div class="modal-footer">
							  <button type="submit" class="btn btn-primary" name="filter-dr"><i class="bi bi-filter-circle"></i> Filter </button>
							</div>
						</form>
              <!-- Table with stripped rows -->
              <table class="table  hover-datatable" id="reject-reports">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">Trans Code</th>
                    <th scope="col"  class="text-center">Customer Name</th>
                    <th scope="col"  class="text-center">Total Amount</th>
                    <th scope="col"  class="text-center">Amount Recieved</th>
                    <th scope="col"  class="text-center">Transaction Date</th>
                    <th scope="col"  class="text-center">Payment Flag</th>
 
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $order->fetch_object()){ 
				
				?>
					
                  <tr >
                  	<td class="text-center"><a href="print-payment.php?transcode=<?php echo $val->transcode;?>" target="_blank"><?php echo $val->transcode;?></a></td>
                    <td class="text-center"><?php echo $val->firstname . ' '. $val->lastname;?></td>
                    <td class="text-center"><?php echo $val->total_amount;?></td>
                    <td class="text-center"><?php echo ($val->status == 1) ? $val->cash : 0;?></td>
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

    <!-- <section class="section">
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
    </section> -->
	
	<div id="order-con" style="display:none">
		<section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Select Item</h5>

              <!-- Table with stripped rows -->
              <table class="table" id="order-tbl">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">Trans Code</th>
                    <th scope="col"  class="text-center">Customer ID</th>
                    <th scope="col"  class="text-center">Customer Name</th>
                    <th scope="col"  class="text-center">Address</th>
                    <th scope="col"  class="text-center">Item Code</th>
                    <th scope="col"  class="text-center">Item Name</th>
                    <th scope="col"  class="text-center">Item Qty</th>
                    <th scope="col"  class="text-center">Item Unit</th>
                    <th scope="col"  class="text-center">Item Price</th>
                    <th scope="col"  class="text-center">Total Price</th>
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
		
		
  </main><!-- End #main -->

 
<?php include('footer.php');?>
