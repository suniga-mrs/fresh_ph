<?php 

session_start();
require_once "./connect.php";

if (!isset($_SESSION['user'])) { 
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM users WHERE username='$username'";

	$result = mysqli_query($conn, $sql);
	$user_info = mysqli_fetch_assoc($result);

	if (!password_verify($password, $user_info['password'])) {
		die("login_failed");
	} else {
		$_SESSION['user'] = $user_info['username'];
		header("Location: ../views/index.php");
	}
} else {
	header("Location: ../views/index.php");
}


mysqli_close($conn);

?>