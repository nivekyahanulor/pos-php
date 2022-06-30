<?php
include('../controller/database.php');


if(isset($_POST['datefrom'])){
	
	$datefrom = $_POST['datefrom'];
	$dateend  = $_POST['dateend'];
	
	$customer = $mysqli->query("SELECT * from pos_inventory_reports
							(DATE(created_at) between '$datefrom' and '$dateend')
							");

} else {
	$customer = $mysqli->query("SELECT * from pos_inventory_reports");
}