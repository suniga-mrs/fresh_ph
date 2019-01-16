<?php 

	require_once "./connect.php";

	$name = $_POST['item_name'];
	$price = $_POST['item_price'];
	$desc = $_POST['item_description'];
	$category_id = $_POST['item_category'];
	$image = $_FILES['item_image']['name'];
	move_uploaded_file($_FILES['item_image']['tmp_name'], "../assets/images/".$image);

	echo $image;


	$sql = "INSERT INTO items(name, price, description, category_id, image_path) VALUES ('$name', '$price', '$desc', '$category_id', '$image')";

	mysqli_query($conn, $sql);
	header("Location: ../views/catalog.php");
	// print_r($_POST);
	// echo "<br>";
	// print_r($_FILES);

	mysqli_close($conn);















?>