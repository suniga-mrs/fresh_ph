<?php

	require_once './connect.php';
	session_start();

	$id = $_POST['user_id'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$address = $_POST['address'];

	$sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', address='$address' WHERE id=$id";
	mysqli_query($conn, $sql);

	$sql = "SELECT * FROM users WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	$_SESSION['user'] = mysqli_fetch_assoc($result);


	print_r($_SESSION['user']);
	header('Location: ../views/profile.php');

?>