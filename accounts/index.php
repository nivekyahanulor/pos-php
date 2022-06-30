<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('controller/dashboard.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
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
                  <h5 class="card-title">DAILY SALES</h5>
                   <div id="container"></div>
                </div>

              </div>
            </div>
         </div>
        </div>
		<div class="col-lg-12">
          <div class="row">

            <div class="col-xxl-12 col-md-12">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">INVENTORY SALES</h5>
                   <div id="container-1"></div>
                </div>

              </div>
            </div>
         </div>
        </div>
			

        <div class="col-lg-12">
          <div class="row">

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">TOTAL SALES</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-check2-circle"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo number_format($totalsales,2);?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">TOTAL ORDERS</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $totalorders;?></h6>

                    </div>
                  </div>
                </div>

              </div>
            </div>
			
			<div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">TOTAL ITEM</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-server"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $totalitem;?></h6>

                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">TOTAL CUSTOMERS</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $totalcustomers;?></h6>

                    </div>
                  </div>

                </div>
              </div>

            </div>
			
            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">TOTAL SUPPLIERS</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $totalsuppliers;?></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div>

			<div class="col-xxl-4 col-xl-12">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">TOTAL SALESMAN</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $totalsalesman;?></h6>

                    </div>
                  </div>

                </div>
              </div>

            </div>

    
          </div>
        </div>
      </div>
    </section>

  </main>
<?php include('footer.php');?>