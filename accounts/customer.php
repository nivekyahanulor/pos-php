<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('controller/customer.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Customer Records</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Customer</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><button class="btn btn-info btn-md" data-bs-toggle="modal" data-bs-target="#add-customer"> <i class="bi bi-person-plus-fill"></i> Add Customer</button></h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">Name</th>
                    <th scope="col"  class="text-center">Address</th>
                    <th scope="col"  class="text-center">Contact</th>
                    <th scope="col"  class="text-center">Area</th>
                    <th scope="col"  class="text-center">Sales Man</th>
                    <th scope="col"  class="text-center">Date Added</th>
                    <th scope="col"  class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $customer->fetch_object()){ ?>
                  <tr>
                    <td class="text-center"><?php echo $val->firstname . ' '. $val->lastname;?></td>
                    <td class="text-center"><?php echo $val->address;?></td>
                    <td class="text-center"><?php echo $val->contact;?></td>
                    <td class="text-center"><?php echo $val->area;?></td>
                    <td class="text-center"><?php echo $val->salesman;?></td>
                    <td class="text-center"><?php echo $val->date_added;?></td>
                    <td class="text-center">
						<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit-customer<?php echo $val->customer_id;?>"> <i class="bi bi-pencil-square"></i> </button>
						<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#delete-customer<?php echo $val->customer_id;?>"> <i class="bi bi-trash"></i> </button>
					</td>
                  </tr>
					 <div class="modal fade" id="edit-customer<?php echo $val->customer_id;?>" tabindex="-1">
					 <div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">Update Salesman</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						 <form class="row g-3" method="post">
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">First Name: </label>
							  <input type="text" class="form-control" name="fname" value="<?php echo $val->firstname;?>" required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Last Name: </label>
							  <input type="text" class="form-control" name="lname" value="<?php echo $val->lastname;?>" required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Address: </label>
							  <input type="text" class="form-control" name="address" value="<?php echo $val->address;?>"  required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Contact Number: </label>
							  <input type="text" class="form-control" name="contactnumber" value="<?php echo $val->contact;?>" required>
							  <input type="hidden" class="form-control" name="id" value="<?php echo $val->customer_id;?>" required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Area: </label>
							  <input type="text" class="form-control" name="area" value="<?php echo $val->area;?>"  required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Salesman: </label>
							  <select  class="form-control" name="salesman" required>
								<option> - Select Salesman -</option>
								<?php
								$pos_salesman = $mysqli->query("SELECT * from pos_salesman");
									while($val1 = $pos_salesman->fetch_object()){
									if($val->sm_id == $val1->sm_id){
										echo "<option value=". $val1->sm_id  ." selected>" .  $val1->name . "</option>";
									} else {
										echo "<option value=". $val1->sm_id  .">" .  $val1->name . "</option>";
									}
									}
								?>
							  </select>
							</div>
							</div>
							<div class="modal-footer">
							  <button type="submit" class="btn btn-primary" name="update-customer">Update </button>
							  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							</div>
						</form>
					  </div>
					</div>
					</div>
					 <div class="modal fade" id="delete-customer<?php echo $val->customer_id;?>" tabindex="-1">
					 <div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">Delete Customer</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						 <form class="row g-3" method="post">
							<div class="col-12">
							 <br>
							  Are your sure to delete this Customer Data?
							  <input type="hidden" class="form-control" name="id" value="<?php echo $val->customer_id;?>" required>
							</div>
						</div>
						<div class="modal-footer">
						  <button type="submit" class="btn btn-warning" name="delete-customer">Delete </button>
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
	
	    <div class="modal fade" id="add-customer" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered ">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Customer Registration</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <form class="row g-3" method="post">
					
						<div class="col-12">
						  <label for="inputNanme4" class="form-label">First Name: </label>
						  <input type="text" class="form-control" name="fname" required>
						</div>
						<div class="col-12">
						  <label for="inputNanme4" class="form-label">Last Name: </label>
						  <input type="text" class="form-control" name="lname" required>
						</div>
						<div class="col-12">
						  <label for="inputNanme4" class="form-label">Address: </label>
						  <input type="text" class="form-control" name="address" required>
						</div>
						<div class="col-12">
						  <label for="inputNanme4" class="form-label">Contact Number: </label>
						  <input type="text" class="form-control" name="contactnumber" required>
						</div>
					
						<div class="col-12">
						  <label for="inputNanme4" class="form-label">Area: </label>
						  <input type="text" class="form-control" name="area" required>
						</div>
						<div class="col-12">
						  <label for="inputNanme4" class="form-label">Salesman: </label>
						  <select  class="form-control" name="salesman" required>
							<option> - Select Salesman -</option>
							<?php
							$pos_salesman = $mysqli->query("SELECT * from pos_salesman");
								while($val1 = $pos_salesman->fetch_object()){
								echo "<option value=". $val1->sm_id  .">" .  $val1->name . "</option>";
								}
							?>
						  </select>
						</div>
					 </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="add-customer">Save </button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
        </div>
		
		
  </main><!-- End #main -->

<?php include('footer.php');?>