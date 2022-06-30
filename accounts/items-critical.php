<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('controller/critical-items.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Critical Items Records</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Inventory</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">Item Code</th>
                    <th scope="col"  class="text-center">Price</th>
                    <th scope="col"  class="text-center">Qty</th>
                    <th scope="col"  class="text-center">Unit</th>
                    <th scope="col"  class="text-center">Critical Level</th>
                    <th scope="col"  class="text-center">Supplier</th>
                    <th scope="col"  class="text-center">Category</th>
                    <th scope="col"  class="text-center">Date Added</th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $customer->fetch_object()){ ?>
				<?php if($val->item_critical_level == $val->item_qty){?>
                  <tr bgcolor="red">
                    <td class="text-center"><?php echo $val->item_code;?></td>
                    <td class="text-center"><?php echo $val->item_price;?></td>
                    <td class="text-center"><?php echo $val->item_qty;?></td>
                    <td class="text-center"><?php echo $val->item_unit;?></td>
                    <td class="text-center"><?php echo $val->item_critical_level;?></td>
                    <td class="text-center"><?php echo $val->supplier;?></td>
                    <td class="text-center"><?php echo $val->category;?></td>
                    <td class="text-center"><?php echo $val->date_added;?></td>
                    
                  </tr>
				<?php } ?>
				  
					 <div class="modal fade" id="edit-item<?php echo $val->item_id;?>" tabindex="-1">
					 <div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">Update Inventory</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						   <form class="row g-3" method="post">
						   <div class="row">
							<div class="col-6">
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Code: </label>
								  <input type="text" class="form-control" name="item_code" value="<?php echo $val->item_code;?>" required>
								  <input type="hidden" class="form-control" name="id" value="<?php echo $val->item_id;?>" required>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Name: </label>
								  <input type="text" class="form-control" name="item_name" value="<?php echo $val->item_name;?>" required>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Price: </label>
								  <input type="text" class="form-control" name="item_price" value="<?php echo $val->item_price;?>" required>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Quantity: </label>
								  <input type="text" class="form-control" name="item_qty"  value="<?php echo $val->item_qty;?>" required>
								</div>
							</div>
							<div class="col-6">
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Unit: </label>
								  <input type="text" class="form-control" name="item_unit" value="<?php echo $val->item_unit;?>" required>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Critical Level: </label>
								  <input type="text" class="form-control" name="item_critical_level" value="<?php echo $val->item_critical_level;?>" required>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Supplier: </label>
								  <select class="form-control" name="item_supplier_id" required>
									<option value=""> - Select Supplier - </option>
									<?php
										$supplier = $mysqli->query("SELECT * from pos_supplier");
											while($val1 = $supplier->fetch_object()){
												if($val->item_supplier_id == $val1->supplier_id){
													echo "<option value=". $val1->supplier_id ." selected>" .  $val1->name . "</option>";
												} else {
													echo "<option value=". $val1->supplier_id .">" .  $val1->name . "</option>";
												}
											}
									?>
								  </select>
								</div>
								<div class="col-12">
								  <label for="inputNanme4" class="form-label">Item Category: </label>
								  <select class="form-control" name="item_category_id" required>
									<option value=""> - Select Category - </option>
									<?php
										$category = $mysqli->query("SELECT * from pos_item_category");
											while($val2 = $category->fetch_object()){
												if($val->item_category_id == $val2->category_id){
													echo "<option value=". $val2->category_id ." selected>" .  $val2->name . "</option>";
												} else {
													echo "<option value=". $val2->category_id .">" .  $val2->name . "</option>";
												}
											}
									?>
								  </select>
								</div>
							</div>
							</div>
						
								<div class="modal-footer">
								  <button type="submit" class="btn btn-primary" name="update-item">Save </button>
								  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								</div>
								</form>
						</div>
						</div>
						</div>
					</div>
					
					 <div class="modal fade" id="delete-item<?php echo $val->item_id;?>" tabindex="-1">
					 <div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">Delete Item</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						 <form class="row g-3" method="post">
							<div class="col-12">
							 <br>
							  Are your sure to delete this Item Data?
							  <input type="hidden" class="form-control" name="id" value="<?php echo $val->item_id;?>" required>
							</div>
						</div>
						<div class="modal-footer">
						  <button type="submit" class="btn btn-warning" name="delete-item">Delete </button>
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
	
	    <div class="modal fade" id="add-item" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Item Receiving Form</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <form class="row g-3" method="post">
						<div class="col-6">
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Item Code: </label>
							  <input type="text" class="form-control" name="item_code" required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Item Name: </label>
							  <input type="text" class="form-control" name="item_name" required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Item Price: </label>
							  <input type="text" class="form-control" name="item_price" required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Item Quantity: </label>
							  <input type="text" class="form-control" name="item_qty" required>
							</div>
						</div>
						<div class="col-6">
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Item Unit: </label>
							  <input type="text" class="form-control" name="item_unit" required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Item Critical Level: </label>
							  <input type="text" class="form-control" name="item_critical_level" required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Item Supplier: </label>
							  <select class="form-control" name="item_supplier_id" required>
								<option value=""> - Select Supplier - </option>
								<?php
									$supplier = $mysqli->query("SELECT * from pos_supplier");
										while($val1 = $supplier->fetch_object()){
											echo "<option value=". $val1->supplier_id .">" .  $val1->name . "</option>";
										}
								?>
							  </select>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Item Category: </label>
							  <select class="form-control" name="item_category_id" required>
								<option value=""> - Select Category - </option>
								<?php
									$category = $mysqli->query("SELECT * from pos_item_category");
										while($val2 = $category->fetch_object()){
											echo "<option value=". $val2->category_id .">" .  $val2->name . "</option>";
										}
								?>
							  </select>
							</div>
						</div>
					
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="add-item">Save </button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
        </div>
		
		
  </main><!-- End #main -->

<?php include('footer.php');?>