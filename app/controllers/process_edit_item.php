<?php

require_once './connect.php';
	
	$id = $_POST['id'];
	$name = $_POST['item_name'];
	$price = $_POST['item_price'];
	$desc = $_POST['item_description'];
	$category_id = $_POST['item_category'];

	$sql = "UPDATE items SET name='$name', price='$price', description='$desc', category_id='$category_id' WHERE id=$id";
	$result = mysqli_query($conn, $sql);

	if(!$result) {
		echo "edit_failed";
	} else {
		header("Location: ../views/items.php");
	}

	mysqli_close($conn);

?>