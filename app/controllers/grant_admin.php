<?php
	session_start();
	require_once './connect.php';

	$user_id = $_POST['user_id'];
	$user_role = $_POST['user_role'];
	$new_role = 2;

	if ($user_id == $_SESSION['user']['id']) {
		die("failed");
	}


	if ($user_role == "user") {
		$new_role = 1;
	} else if ($user_role == "admin") {
		$new_role = 2;
	}

	$sql = "UPDATE users SET roles_id='$new_role' WHERE id='$user_id'";
	mysqli_query($conn, $sql);

	mysqli_close($conn);





?>