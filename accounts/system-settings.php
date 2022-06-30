<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('controller/settings.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>System Settings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active"> Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="row">
	  
	   <div class="col-lg-12">
          <div class="row">

            <div class="col-xxl-12 col-md-12">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Settings </h5>
                    <form class="row g-3" method="post">
						<div class="col-6">
						<?php while($val = $settings->fetch_object()){ ?>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">System Title: </label>
							  <input type="text" class="form-control item_code" value="<?php echo $val->title;?>" name="title" required>
							</div> <br>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">System Contact : </label>
							  <input type="text" class="form-control" name="contact" value="<?php echo $val->contact;?>"  required>
							</div><br>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label">Item Quantity: </label>
							  <textarea type="text" class="form-control" name="address" required><?php echo $val->address;?></textarea>
							</div>
						<?php } ?>
						</div>
					
					
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="update-settings">Save </button>
                    </div>
					</form>
                </div>

              </div>
            </div>
         </div>
        </div>
		

      </div>
    </section>

  </main>
<?php include('footer.php');?>