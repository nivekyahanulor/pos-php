<?php
include('../controller/database.php');


$customer = $mysqli->query("SELECT a.*, b.name as salesman from pos_customer a left join pos_salesman b on a.sm_id = b.sm_id ");

if(isset($_POST['add-customer'])){
	
	$fname          = $_POST['fname'];
	$lname          = $_POST['lname'];
	$address        = $_POST['address'];
	$contactnumber  = $_POST['contactnumber'];
	$area           = $_POST['area'];
	$salesman       = $_POST['salesman'];

	$mysqli->query("INSERT INTO pos_customer (firstname , lastname ,address,contact,sm_id,area ) VALUES ('$fname','$lname','$address','$contactnumber','$salesman','$area')");

  	        echo '<script>
					Swal.fire({
							title: "Success! ",
							text: "Customer Successfully Added",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "customer.php";
							});
			</script>';
	
}

if(isset($_POST['delete-customer'])){
	
	$id       = $_POST['id'];

	$mysqli->query("DELETE FROM  pos_customer where customer_id ='$id' ");
	
	
	echo '  <script>
					Swal.fire({
							title: "Success! ",
							text: " Customer is Successfully Deleted",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "customer.php";
							});
			</script>';
	
}

if(isset($_POST['update-customer'])){
	
	$id             = $_POST['id'];
	$fname          = $_POST['fname'];
	$lname          = $_POST['lname'];
	$address        = $_POST['address'];
	$contactnumber  = $_POST['contactnumber'];
	$area           = $_POST['area'];
	$salesman       = $_POST['salesman'];
	
	$mysqli->query("UPDATE  pos_customer set firstname  ='$fname' ,
										 lastname  ='$lname' ,
										 address  ='$address' ,
										 area  ='$area' ,
										 sm_id  ='$salesman' ,
										 contact  ='$contactnumber' 
										 WHERE customer_id ='$id'
					");
		
	echo '  <script>
					Swal.fire({
							title: "Success! ",
							text: "Customer Details is Successfully Updated",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "customer.php";
							});
			</script>';
	
}