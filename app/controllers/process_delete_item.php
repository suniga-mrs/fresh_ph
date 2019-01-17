<?php 
session_start();
require_once './connect.php';

	$id = $_GET['id'];

	$sql = "SELECT * FROM items WHERE id='$id'";
	$result = mysqli_query($conn, $sql);
	$item = mysqli_fetch_assoc($result);

	// echo $item['image_path'];
	$sql2 = "DELETE FROM items WHERE id='$id'";

	if(mysqli_query($conn, $sql2)) {
		unlink('../assets/images/'.$item['image_path']);		
	} else {
		echo mysqli_error()
	}


	

mysqli_close($conn);

?>