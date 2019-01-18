<?php

require_once './connect.php';

$order_id = $_POST['order_id'];
$new_status = $_POST['new_status'];

if ($new_status == "complete") {
	$new_status = 2;	
} else if ($new_status == "cancel") {
	$new_status = 3;
} else {
	die("failed");
}

$sql = "UPDATE orders SET status_id='$new_status' WHERE id='$order_id'";
mysqli_query($conn, $sql);

mysqli_close($conn);

?>