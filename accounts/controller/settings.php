<?php
include('../controller/database.php');


$settings = $mysqli->query("SELECT * from pos_settings");



if(isset($_POST['update-settings'])){
	
	$title       = $_POST['title'];
	$contact     = $_POST['contact'];
	$address     = $_POST['address'];



	$mysqli->query("UPDATE  pos_settings SET title ='$title' ,contact ='$contact' ,address ='$address'
					");
		
	echo '  <script>
					Swal.fire({
							title: "Success! ",
							text: "Settings Details is Successfully Updated",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "system-settings.php";
							});
			</script>';
	
}