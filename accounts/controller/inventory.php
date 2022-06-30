<?php
include('../controller/database.php');


$customer = $mysqli->query("SELECT a.* , b.name as category, c.name as supplier from pos_items a 
							LEFT JOIN pos_item_category b on b.category_id  = a.item_category_id
							LEFT JOIN pos_supplier c on c.supplier_id   = a.item_supplier_id");


if(isset($_POST['search'])){
	$item_code = $_POST['item_code'];
	$mysqli->query("select *  FROM  pos_items where item_code ='$item_code' ");
    $row = $mysqli->fetch_row();
	echo json_encode($row);
}

if(isset($_POST['add-item'])){
	
	$item_code           = $_POST['item_code'];
	$item_name           = $_POST['item_name'];
	$item_price          = $_POST['item_price'];
	$item_qty            = $_POST['item_qty'];
	$item_unit           = $_POST['item_unit'];
	$item_critical_level = $_POST['item_critical_level'];
	$item_supplier_id    = $_POST['item_supplier_id'];
	$item_category_id    = $_POST['item_category_id'];
	$item_status         = $_POST['item_status'];
	$add_status          = $_POST['add_status'];
	
	if($add_status == 1){
		
		if($item_status == 1){
		$mysqli->query("UPDATE  pos_items set item_qty =item_qty +  '$item_qty' where item_code = '$item_code'");
		$mysqli->query("INSERT INTO pos_inventory_reports (item_code , item_name ,item_price,item_qty,item_unit,item_critical_level,item_supplier_id,item_category_id, status) 
						VALUES ('$item_code','$item_name','$item_price','$item_qty','$item_unit','$item_critical_level','$item_supplier_id','$item_category_id' , '$item_status')");
		} else {
		$mysqli->query("INSERT INTO pos_inventory_reports (item_code , item_name ,item_price,item_qty,item_unit,item_critical_level,item_supplier_id,item_category_id, status) 
						VALUES ('$item_code','$item_name','$item_price','$item_qty','$item_unit','$item_critical_level','$item_supplier_id','$item_category_id' , '$item_status')");
		}
		
	} else {
	
		if($item_status == 1){
		$mysqli->query("INSERT INTO pos_items (item_code , item_name ,item_price,item_qty,item_unit,item_critical_level,item_supplier_id,item_category_id, is_status) 
						VALUES ('$item_code','$item_name','$item_price','$item_qty','$item_unit','$item_critical_level','$item_supplier_id','$item_category_id' , '$item_status')");
		$mysqli->query("INSERT INTO pos_inventory_reports (item_code , item_name ,item_price,item_qty,item_unit,item_critical_level,item_supplier_id,item_category_id, status) 
						VALUES ('$item_code','$item_name','$item_price','$item_qty','$item_unit','$item_critical_level','$item_supplier_id','$item_category_id' , '$item_status')");
		} else {
		$mysqli->query("INSERT INTO pos_inventory_reports (item_code , item_name ,item_price,item_qty,item_unit,item_critical_level,item_supplier_id,item_category_id, status) 
						VALUES ('$item_code','$item_name','$item_price','$item_qty','$item_unit','$item_critical_level','$item_supplier_id','$item_category_id' , '$item_status')");
		}
	
	}
  	        echo '<script>
					Swal.fire({
							title: "Success! ",
							text: "Item Data Successfully Added",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "inventory.php";
							});
			</script>';
	
}

if(isset($_POST['delete-item'])){
	
	$id       = $_POST['id'];

	$mysqli->query("DELETE FROM  pos_items where item_id ='$id' ");
	
	
	echo '  <script>
					Swal.fire({
							title: "Success! ",
							text: " Item is Successfully Deleted",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "inventory.php";
							});
			</script>';
	
}

if(isset($_POST['update-item'])){
	
	$id            		 = $_POST['id'];
	$item_code           = $_POST['item_code'];
	$item_name           = $_POST['item_name'];
	$item_price          = $_POST['item_price'];
	$item_qty            = $_POST['item_qty'];
	$item_unit           = $_POST['item_unit'];
	$item_critical_level = $_POST['item_critical_level'];
	$item_supplier_id    = $_POST['item_supplier_id'];
	$item_category_id    = $_POST['item_category_id'];

	$mysqli->query("UPDATE pos_items  SET item_code           = '$item_code' , 
										  item_name           = '$item_name',
										  item_price          = '$item_price',
										  item_qty            = '$item_qty',
										  item_unit           = '$item_unit',
										  item_critical_level = '$item_critical_level',
										  item_supplier_id    = '$item_supplier_id',
										  item_category_id    = '$item_category_id'
					WHERE item_id = '$id'");

		
	echo '  <script>
					Swal.fire({
							title: "Success! ",
							text: "Item Details is Successfully Updated",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "inventory.php";
							});
			</script>';
	
}