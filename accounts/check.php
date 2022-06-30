<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('controller/cheque.php');?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Cheque Records</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Cheque</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><button class="btn btn-info btn-md" data-bs-toggle="modal" data-bs-target="#add-check"> <i class="bi bi-plus-circle"></i> Add Check</button></h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Customer Name</th>
                    <th class="text-center" scope="col">Bank</th>
                    <th class="text-center" scope="col">Branch</th>
                    <th class="text-center" scope="col">Cheque #</th>
                    <th class="text-center" scope="col">Date</th>
                    <th class="text-center" scope="col">Amount</th>
                    <th class="text-center" scope="col">Deposit Bank</th>
                    <th class="text-center" scope="col">Status</th>
                    <th class="text-center" scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $pos_cheque->fetch_object()){ ?>
                  <tr>
                    <td class="text-center"><?php echo $val->firstname .' '. $val->lastname;?></td>
                    <td class="text-center"><?php echo $val->bank;?></td>
                    <td class="text-center"><?php echo $val->branch;?></td>
                    <td class="text-center"><?php echo $val->check_number;?></td>
                    <td class="text-center"><?php echo $val->check_date;?></td>
                    <td class="text-center"><?php echo $val->amount;?></td>
                    <td class="text-center"><?php echo $val->deposit_bank;?></td>
                    <td class="text-center"><?php echo $val->check_status;?></td>
                    <td class="text-center">
						<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit-check<?php echo $val->check_id;?>"> <i class="bi bi-pencil-square"></i> </button>
						<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#delete-supplier<?php echo $val->check_id;?>"> <i class="bi bi-trash"></i> </button>
					</td>
                  </tr>
					<div class="modal fade" id="edit-check<?php echo $val->check_id;?>" tabindex="-1">
							<div class="modal-dialog modal-lg modal-dialog-centered">
							  <div class="modal-content">
								<div class="modal-header">
								  <h5 class="modal-title">Cheque Details</h5>
								  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
								 <form method="post">
									<div class="row">
									<div class="col-12">
									  <label for="inputNanme4" class="form-label">Customer Name: </label>
									   <select  class="form-control" name="customer_id" required>
									   <option value=""> - Select Customer - </option>
										<?php
										$pos_customer = $mysqli->query("SELECT * from pos_customer");
											while($val1 = $pos_customer->fetch_object()){
											if($val->customer_id ==  $val1->customer_id){
											echo "<option value=". $val1->customer_id   ." selected>" .  $val1->firstname . ' '. $val1->lastname . "</option>";
											} else {
											echo "<option value=". $val1->customer_id   .">" .  $val1->firstname . ' '. $val1->lastname . "</option>";
											} }
										?>
										</select>
									</div>
									</div>
									<div class="row">
										<div class="col-6">
										  <label for="inputNanme4" class="form-label">Bank: </label>
										  <input type="text" class="form-control" name="bank" value="<?php echo $val->bank;?>" required>
										  <input type="hidden" class="form-control" name="check_id" value="<?php echo $val->check_id;?>" required>
										</div>
										<div class="col-6">
										<label for="inputNanme4" class="form-label">Branch: </label>
										<input type="text" class="form-control" name="branch" value="<?php echo $val->branch;?>" required>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
										  <label for="inputNanme4" class="form-label">Cheque #: </label>
										  <input type="text" class="form-control" name="check_number" value="<?php echo $val->check_number;?>" required>
										</div>
										<div class="col-6">
										  <label for="inputNanme4" class="form-label">Date: </label>
										  <input type="date" class="form-control" name="check_date"  value="<?php echo $val->check_date;?>" required>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
										  <label for="inputNanme4" class="form-label">Amount: </label>
										  <input type="text" class="form-control" name="amount" value="<?php echo $val->amount;?>" required>
										</div>
										<div class="col-6">
										  <label for="inputNanme4" class="form-label">Deposit Bank: </label>
										  <input type="text" class="form-control" name="deposit_bank" value="<?php echo $val->deposit_bank;?>" required>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
										  <label for="inputNanme4" class="form-label">Status: </label>
											<select  class="form-control" name="check_status" required>
												<option value=""> - Select Status - </option>
												<?php if($val->check_status == 'Uncleared'){?>
												<option value="Uncleared" selected> Uncleared </option>
												<option value="Cleared"> Cleared </option>
												<option value="Return"> Return </option>
												<?php } else if($val->check_status == 'Cleared'){?>
												<option value="Uncleared" > Uncleared </option>
												<option value="Cleared" selected> Cleared </option>
												<option value="Return"> Return </option>
												<?php } else if($val->check_status == 'Return'){?>
												<option value="Uncleared" > Uncleared </option>
												<option value="Cleared" > Cleared </option>
												<option value="Return" selected> Return </option>
												<?php } ?>
											</select>
										</div>
										<div class="col-6">
										  <label for="inputNanme4" class="form-label">Move Date: </label>
										  <input type="date" class="form-control" name="move_date" value="<?php echo $val->move_date;?>">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-12">
										  <label for="inputNanme4" class="form-label">Remarks : </label>
										  <textarea class="form-control" name="remarks" ><?php echo $val->remarks;?></textarea>
										</div>
									</div>
								</div>
								<div class="modal-footer">
								  <button type="submit" class="btn btn-primary" name="update-check"> Submit </button>
								  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								</div>
								</form>
							  </div>
							</div>
					</div>
		
					 <div class="modal fade" id="delete-supplier<?php echo $val->check_id;?>" tabindex="-1">
					 <div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">Delete Supplier</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						 <form class="row g-3" method="post">
							<div class="col-12">
							 <br>
							  Are your sure to delete this Cheque?
							  <input type="hidden" class="form-control" name="id" value="<?php echo $val->check_id;?>" required>
							</div>
						</div>
						<div class="modal-footer">
						  <button type="submit" class="btn btn-warning" name="delete-check">Delete </button>
						  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
					  </div>
					</div>
					</div>
                <?php } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
	
	    <div class="modal fade" id="add-check" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Cheque Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <form method="post">
						<div class="row">
						<div class="col-12">
						  <label for="inputNanme4" class="form-label">Customer Name: </label>
						   <select  class="form-control" name="customer_id" required>
						   <option value=""> - Select Customer - </option?>
							<?php
							$pos_customer = $mysqli->query("SELECT * from pos_customer");
								while($val1 = $pos_customer->fetch_object()){
								echo "<option value=". $val1->customer_id   .">" .  $val1->firstname . ' '. $val1->lastname . "</option>";
								}
							?>
							</select>
						</div>
						</div>
						<div class="row">
							<div class="col-6">
							  <label for="inputNanme4" class="form-label">Bank: </label>
							  <input type="text" class="form-control" name="bank" required>
							</div>
							<div class="col-6">
							<label for="inputNanme4" class="form-label">Branch: </label>
							<input type="text" class="form-control" name="branch" required>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
							  <label for="inputNanme4" class="form-label">Cheque #: </label>
							  <input type="text" class="form-control" name="check_number" required>
							</div>
							<div class="col-6">
							  <label for="inputNanme4" class="form-label">Date: </label>
							  <input type="date" class="form-control" name="check_date" required>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
							  <label for="inputNanme4" class="form-label">Amount: </label>
							  <input type="text" class="form-control" name="amount" required>
							</div>
							<div class="col-6">
							  <label for="inputNanme4" class="form-label">Deposit Bank: </label>
							  <input type="text" class="form-control" name="deposit_bank" required>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
							  <label for="inputNanme4" class="form-label">Status: </label>
							    <select  class="form-control" name="check_status" required>
									<option value=""> - Select Status - </option?>
									<option value="Uncleared"> Uncleared </option?>
									<option value="Cleared"> Cleared </option?>
									<option value="Return"> Return </option?>
								</select>
							</div>
							<div class="col-6">
							  <label for="inputNanme4" class="form-label">Move Date: </label>
							  <input type="date" class="form-control" name="move_date" >
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Remarks : </label>
							  <textarea class="form-control" name="remarks" ></textarea>
							</div>
						</div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="add-check"> Submit </button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
        </div>
		
		
  </main><!-- End #main -->

<?php include('footer.php');?>