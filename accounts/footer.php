
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>POS SYSTEM</span></strong>. All Rights Reserved 2022
    </div>
    <div class="credits">
    
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/moment.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/datatable/datatables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>

  <?php
    $salechart = $mysqli->query("SELECT a.* , b.* , (sum(a.qty)* b.item_price) total from pos_order a LEFT JOIN pos_items b on b.item_code = a.item_code where a.status = 1 GROUP BY DATE_FORMAT(created_at, '%y-%m-%d')");
	


	while($valchart = $salechart->fetch_object()){ 
					$chartprice =  $valchart->item_price;
					$chartprice =  $valchart->qty * $valchart->item_price;
					$dt = new DateTime($valchart->created_at);
				    $test[] = array($dt->format('Y-m-d'), $chartprice);
  
	}
  ?>
   <script>
   Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Daily Sales'
    },
    subtitle: {
        text: 'Source: POS DATABASE'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Amount (Sales)'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: ' <b>{point.y} </b>'
    },
    series: [{
        name: 'Population',
        data: <?php echo json_encode($test);?> ,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
   </script>
    <?php
    $salechart1 = $mysqli->query("SELECT a.* , b.* , (sum(a.qty)* b.item_price) total from pos_order a LEFT JOIN pos_items b on b.item_code = a.item_code where a.status = 1 GROUP BY a.item_code");
	


	while($valchart1 = $salechart1->fetch_object()){ 
					$chartprice1 =  $valchart1->qty * $valchart1->item_price;
				    $test1[] = array($valchart1->item_name, $chartprice1);
  
	}
  ?>
   <script>
   Highcharts.chart('container-1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Inventory Sales'
    },
    subtitle: {
        text: 'Source: POS DATABASE'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Amount (Sales)'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: ' <b>{point.y} </b>'
    },
    series: [{
        name: 'Population',
        data: <?php echo json_encode($test1);?> ,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
   </script>
    <?php
    $autocomplete = $mysqli->query("SELECT * from pos_items");

	while($valac = $autocomplete->fetch_object()){ 
				    $test2[] = $valac->item_code;
  
	}
  ?>
  
    <script>
    $( function() {
		var availableTags = [<?php echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($test2, JSON_NUMERIC_CHECK), ENT_NOQUOTES));?>]
		$( "#item_code" ).autocomplete({
		  source: availableTags
		});
    } );
	$(".item_code").on("change", function(e) {
		e.preventDefault();

		var item = $(".item_code").val();
		if(item !=""){
		 $.ajax({
             type: "POST",
             url:  'https://unipeak.online/controller/get-items.php',
             data : {'item' : item , 'search' : 'search'},
                    success: function(result)
                    {
					if(result !=""){
					$.each(JSON.parse(result), function(i, item) {
							$("#item_name").val(item.item_name);
							$("#item_unit").val(item.item_unit);
							$("#item_price").val(item.item_price);
							$("#item_critical_level").val(item.item_critical_level);
							$("#add_status").val(1);
							if(item.item_supplier_id !=""){
								
								$("#item-supplier-1").show();
								$("#item-supplier").hide();
								$('#item_supplier_id').removeAttr('required',false);
								
								$.ajax({
									 type: "POST",
									 // url:  'http://localhost/7thPOS/controller/get-supplier.php',
									 url:  'https://unipeak.online/controller/get-supplier.php',
									 data : {'item_supplier_id' : item.item_supplier_id , 'search' : 'search'},
											success: function(result)
											{
												$("#item_supplier_id_1").val(result);
											}
								});
							}
							
							if(item.item_category_id !=""){
								
								$("#item-category-1").show();
								$("#item-category").hide();
								$('#item_category_id').prop('required',false);
								
								$.ajax({
									 type: "POST",
									 url:  'https://unipeak.online/controller/get-category.php',
									 data : {'item_category_id' : item.item_category_id , 'search' : 'search'},
											success: function(result)
											{
												$("#item_category_id_1").val(result);
											}
								});
							}
					});
                    } else {
							$("#item_name").val("");
							$("#item_unit").val("");
							$("#item_price").val("");
							$("#item_critical_level").val("");
							$("#add_status").val("");
							$("#item-supplier-1").hide();
							$("#item-supplier").show();
							$("#item-category-1").hide();
							$("#item-category").show();
							$('#item_supplier_id').prop('required',true);
							$('#item_category_id').prop('required',true);
							$('#item_supplier_id_1').prop('required',false);
							$('#item_category_id_1').prop('required',false);

					}
					}
            });
			} else {
							$("#item_name").val("");
							$("#item_unit").val("");
							$("#item_price").val("");
							$("#item_critical_level").val("");
							$("#add_status").val("");
							$("#item-supplier-1").hide();
							$("#item-supplier").show();
							$("#item-category-1").hide();
							$("#item-category").show();
							$('#item_supplier_id').prop('required',true);
							$('#item_category_id').prop('required',true);
							$('#item_supplier_id_1').prop('required',false);
							$('#item_category_id_1').prop('required',false);

			}
		});
	$(document).ready(function() {
		$('#inventory-report').DataTable({

		dom: 'Bfrtip',
        pageLength: 25,
			buttons: [
			   'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
		
		$('#sales-report').DataTable({

		dom: 'Bfrtip',
        pageLength: 25,
			buttons: [
			   'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
		
		$('#reject-reports').DataTable({

		dom: 'Bfrtip',
        pageLength: 25,
			buttons: [
			   'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
	});
	$("#update_price").change(function(){
	  if ($(this).is(':checked')){
		$("#item-price").prop("readonly", false); 
		$("#item-price-change").val(1); 
	  } else {
         $("#item-price").prop("readonly", true); 
		$("#item-price-change").val(0); 
	  }
	});
	
 
  </script>
</body>

</html>