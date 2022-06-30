<?php include('header-print.php');?>
<?php include('nav.php');?>
<?php include('controller/print-payment.php');?>
<?php include('controller/settings.php');?>
<?php $order = $pos_order->fetch_all(MYSQLI_ASSOC);  ?>
<?php $payment = $pos_payment->fetch_all(MYSQLI_ASSOC);  ?>
<?php $settings1 = $settings->fetch_all(MYSQLI_ASSOC);  ?>
<main id="main" class="main">

  

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title" style="text-align: right;position: fixed;"><button id="printPage" class="btn btn-info btn-md" data-bs-toggle="modal" data-bs-target="#add-item"> <i class="bi bi-printer"></i> Print </button></h6>
              <h6 style="text-align: center;font-weight: bold !important;"><?php echo $settings1[0]['title'];?></h6>
              <h6 style="text-align: center;font-weight: bold !important;"><?php echo $settings1[0]['address'];?></h6>
              <h6 style="text-align: center;font-weight: bold !important;">TEL.# <?php echo $settings1[0]['contact'];?></h6>
              <h6 style="text-align: center;font-weight: bold !important;">DELIVERY RECEIPT</h6>
              <hr>
              <div class="row">
  
              	<table>
              		<tr>
              			<td width="60%">
              				<h6 style="margin: 10px">CUSTOMER: <br><b><?php echo ($order[0]['firstname'].' '.$order[0]['lastname']) ?></b></h6>
              			</td>
              			<td width="20%">
              				<h6 style="margin: 10px">DR#: <br><b><?php echo ($order[0]['trans_code']) ?></b></h6>
              			</td>
              		</tr>
              		<tr>
              			<td width="60%">
              				<h6 style="margin: 10px">ADDRESS: <br><b><?php echo ($order[0]['address']) ?></b></h6>
              			</td>
              			<td width="20%">
              				<h6 style="margin: 10px;vertical-align: top">DATE: <br><b><?php echo date("m/d/Y") ?></b></h6>
              			</td>
              		</tr>
              		<tr>
              			<td width="60%">
              				&nbsp;
              			</td>
              			<td width="20%">
              				<h6 style="margin: 10px;vertical-align: top">SALESMAN: <br><b><?php echo ($order[0]['name']) ?></b></h6>
              			</td>
              		</tr>
              	</table>
              </div>

              
              
              <!-- Table with stripped rows -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">QTY</th>
                    <th scope="col"  class="text-center">UNIT</th>
                    <th scope="col"  class="text-center">DESCRIPTION</th>
                    <th scope="col"  class="text-center">UNIT PRICE</th>
                    <th scope="col"  class="text-center">TOTAL UNIT PRICE</th>

                  </tr>
                </thead>
                <tbody>
           		<?php $net_amnt = 0;$tot_net_amnt=0; ?>
				<?php foreach($order as $key => $value){ ?>

				  <tr>
		
                    <td class="text-center"><?php echo $value['qty'];?></td>
                    <td class="text-center"><?php echo $value['item_unit'];?></td>
                    <td class="text-center"><?php echo $value['item_name'];?></td>
                    <td class="text-center">
					<?php 
					if($value['item_price_change'] == 1){ 
						echo number_format($value['update_price'], 2, '.', ',');
					} else {
						echo number_format($value['item_price'], 2, '.', ',');
					}
					?>
					</td>
                    <td class="text-center">
					<?php
					if($value['item_price_change'] == 1){ 
						echo number_format((Float)$value['qty'] * (Float)$value['update_price'],2,'.',',');
					} else {
						echo number_format((Float)$value['qty'] * (Float)$value['item_price'],2,'.',',');
					}
					?>
					</td>
                  </tr>
				  
				  
					 
                    <?php  
					if($value['item_price_change'] == 1){ 
					$net_amnt = $net_amnt + ((Float)$value['qty'] * (Float)$value['update_price']);
					} else {
					$net_amnt = $net_amnt + ((Float)$value['qty'] * (Float)$value['item_price']);
					}
					
					}	
					$totaldiscount = $net_amnt * (($payment[0]['discount_1'] + $payment[0]['discount_2']) / 100);
					?>
                </tbody>
              </table>
              <div>
              	<h6 style="text-align: right;"><b>Discount 1: <?php echo $payment[0]['discount_1']; ?> % </b></h6>
              	<h6 style="text-align: right;"><b>Discount 2: <?php echo $payment[0]['discount_2']; ?> % </b></h6>
              	<h6 style="text-align: right;"><b>Total Discount : <?php echo number_format(($net_amnt * (($payment[0]['discount_1'] + $payment[0]['discount_2']) / 100)), 2, '.', ',') ?></b></h6>
              	<h6 style="text-align: right;"><b>Total Amount : <?php echo number_format($net_amnt, 2, '.', ','); ?></b></h6>
              	<h6 style="text-align: right;"><b>Total Net Amount : <?php echo number_format($net_amnt - $totaldiscount, 2, '.', ',') ?></b></h6>
              </div>
              <!-- End Table with stripped rows -->

              <div class="row">
  
              	<table>
              		<tr>
              			<td width="50%">
              				<h6 style="margin: 10px">Checked by:</h6>
              				
              			</td>
              			<td width="50%">
              				<h6 style="margin: 10px;text-align: right">Received the above good order and condition:</h6>
              				
              			</td>
              		</tr>

              		<tr>
              			<td width="50%">
              				
              				<div style="margin: 10px;width: 50%;border-bottom: 1px solid #000">&nbsp;</div>
              			</td>
              			<td width="50%" style="text-align: right;">
              				
              				<div style="margin: 10px;width: 70%;border-bottom: 1px solid #000;float: right;">&nbsp;</div>
              			</td>
              		</tr>
              		
              	</table>
              </div>
              <br>
              <h5><b><small>Strictly paid to <?php echo $settings1[0]['title'];?></small></b></h5>
              <H6><B><small>COMPLAINTS FOR LACKING ITEMS MUST BE DONW IMMEDIATELY WITHIN 15 DAYS UPON RECEIPT OF GOODS, COMPLAINTS MADE AFTER 15 DAYS WILL NOT BE HONORED. PRICES ARE SUBJECT TO CHANGE W/0 PRIOR NOTICE.</small></B></H6>
            </div>
          </div>

        </div>
      </div>
    </section>
	
	    
		
		
  </main><!-- End #main -->
<?php include('footer-print.php');?>
<script type="text/javascript">
	$('#printPage').click(function(){
			var beforePrint = function() {
		        $('#header').attr( "style", "display: none !important;" );
		        $('#printPage').hide()
		    };
		    var afterPrint = function() {
		        $('#header').attr( "style", "display: ;" );
		        $('#printPage').show()
		    };

		    

		    if (window.matchMedia) {
		        var mediaQueryList = window.matchMedia('print');
		        mediaQueryList.addListener(function(mql) {
		            if (mql.matches) {
		                beforePrint();
		            } else {
		                afterPrint();
		            }
		        });
		    }

		    window.onbeforeprint = beforePrint;
		    window.onafterprint = afterPrint;

			
           window.print();
           return false;
});
</script>
