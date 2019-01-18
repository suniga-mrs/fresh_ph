<?php 

session_start();
require_once './connect.php';


$user_id = $_SESSION['user']['id'];
	$purchase_date = date("Y-m-d G:i:s");
	$total_amt = $_POST['total'];
	$status_id = 1;
	$payment_mode_id = $_POST['payment_mode'];
	$address = $_POST['addressLine1'];

	echo $payment_mode_id;





mysqli_close($conn);









?>