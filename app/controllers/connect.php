<?php 
// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ecom_db";

$host = "db4free.net";
$username = "mytest_mrs";
$password = "bayleaf1995";
$dbname = "ecom_db_mrs";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
	die('Connection Failed ' . mysqli_error($conn));
}
// echo "Connected Successfully";
?>