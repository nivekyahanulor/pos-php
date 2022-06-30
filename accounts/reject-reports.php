<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('controller/inventory-report.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reject Inventory Report Records</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Reject Inventor</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body"><br>
					
              <table class="table " id="reject-reports">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">Item Code</th>
                    <th scope="col"  class="text-center">Item Name</th>
                    <th scope="col"  class="text-center">Qty</th>
                    <th scope="col"  class="text-center">Price</th>
                    <th scope="col"  class="text-center">Status</th>
                    <th scope="col"  class="text-center">Date</th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $customer->fetch_object()){ 
				 if($val->status=='2'){
				?>
			
				  <tr>
                    <td class="text-center"><?php echo $val->item_code;?></td>
                    <td class="text-center"><?php echo $val->item_name;?></td>
                    <td class="text-center"><?php echo $val->qty;?></td>
                    <td class="text-center"><?php echo number_format( $val->item_price,2);?></td>
                    <td class="text-center"><?php if($val->status=='1'){ echo "Normal Add"; } else { echo "Reject";}?></td>
                    <td class="text-center"><?php echo $val->date_added;?></td>
                  </tr>
				<?php } } ?> 
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>
	
		
  </main><!-- End #main -->

<?php include('footer.php');?>