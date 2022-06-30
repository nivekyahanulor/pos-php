<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PRINT RECEIPT</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <script src="../assets/js/extensions/sweetalert2.js"></script>
  <script src="../assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
  <?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("Location: ../index.php");
	}
	error_reporting(0);
	$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$uri_segments = explode('/', $uri_path);
	$page =  $uri_segments[2];
	if($page =='index.php')  { $a = 'active'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed';$i = 'collapsed'; }
	else if($page =='inventory.php'){ $a = 'collapsed'; $b = 'active'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $i = 'collapsed';$h = 'collapsed'; }
	else if($page =='orders.php' || $page=='print-payment.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'active'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed';$i = 'collapsed'; $k = 'collapsed';}
	else if($page =='history.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'active'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed';$i = 'collapsed'; }
	else if($page=='sales-report.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'active'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed';$i = 'collapsed'; }
	else if($page=='customer.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'active'; $g = 'collapsed'; $h = 'collapsed';$i = 'collapsed'; }
	else if($page =='supplier.php' ){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'active'; $h = 'collapsed'; $i = 'collapsed';}
	else if($page =='salesman.php' ){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'active';$i = 'collapsed'; }
	else if($page =='system-users.php' ){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed'; $i = 'active'; }
	else if($page =='system-settings.php' ){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed'; $i = 'collapsed';$k = 'collapsed';$l = 'active'; }
	?>
</head>
