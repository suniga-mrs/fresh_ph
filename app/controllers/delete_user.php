<?php
	session_start();
	require_once './connect.php';

	$user_id = $_POST['user_id'];

	if ($user_id == $_SESSION['user']['id']) {
		die("failed");
	}

	$sql = "DELETE FROM users WHERE id='$user_id'";
	mysqli_query($conn, $sql);

	mysqli_close($conn);

?>