<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('controller/check-reports.php');?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Cheque Report Records</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Cheque Report</li>
          <li class="breadcrumb-item active">Data</li>
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
							   <select  class="form-control" name="check_status" required>
									<option value=""> - Select Status - </option?>
									<option value="Uncleared"> Uncleared </option?>
									<option value="Cleared"> Cleared </option?>
									<option value="Return"> Return </option?>
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
							  <button type="submit" class="btn btn-primary" name="update-customer"><i class="bi bi-filter-circle"></i> Filter </button>
							</div>
						</form>
              <!-- Table with stripped rows -->
              <table class="table " id="inventory-report">
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
	
	    
		
  </main><!-- End #main -->

<?php include('footer.php');?>