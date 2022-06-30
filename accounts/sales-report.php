<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('controller/sales-report.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Sales Report Records</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Sales Report </li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body"><br>
						<form class="row g-3" method="post">
							
							<div class="col-4">
							  <label for="inputNanme4" class="form-label">Salesman: </label>
							  <select  class="form-control" name="salesman" required>
								<option> - Select Salesman -</option>
								<?php
								$pos_salesman = $mysqli->query("SELECT * from pos_salesman");
									while($val1 = $pos_salesman->fetch_object()){
									if($_POST['salesman'] == $val1->sm_id){
										echo "<option value=". $val1->sm_id  ." selected>" .  $val1->name . "</option>";
									} else {
										echo "<option value=". $val1->sm_id  .">" .  $val1->name . "</option>";
									}
									}
								?>
							  </select>
							</div>
							
							<div class="col-4">
							  <label for="inputNanme4" class="form-label">Date From: </label>
							   <input type="date" class="form-control" name="datefrom"  value="<?php echo $_POST['datefrom'];?>" required>
							</div>
							<div class="col-4">
							  <label for="inputNanme4" class="form-label">Date End: </label>
							 <input type="date" class="form-control" name="dateend" value="<?php echo $_POST['dateend'];?>" required>
							</div>
							<div class="modal-footer">
							  <button type="submit" class="btn btn-primary" name="update-customer"><i class="bi bi-filter-circle"></i> Filter </button>
							</div>
						</form>
              <!-- Table with stripped rows -->
              <table class="table " id="sales-report">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">Customer Name</th>
                    <th scope="col"  class="text-center">Sales Man</th>
                    <th scope="col"  class="text-center">Item</th>
                    <th scope="col"  class="text-center">Qty</th>
                    <th scope="col"  class="text-center">Price</th>
                    <th scope="col"  class="text-center">Date</th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $customer->fetch_object()){ 
					$price =  $val->qty * $val->item_price;
				?>
			
				  <tr>
                    <td class="text-center"><?php echo $val->firstname . ' '. $val->lastname;?></td>
                    <td class="text-center"><?php echo $val->name;?></td>
                    <td class="text-center"><?php echo $val->item_code;?></td>
                    <td class="text-center"><?php echo $val->qty;?></td>
                    <td class="text-center"><?php echo number_format($price,2);?></td>
                    <td class="text-center"><?php echo $val->created_at;?></td>
                  </tr>
				<?php } ?> 
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>
	
		
  </main><!-- End #main -->

<?php include('footer.php');?>