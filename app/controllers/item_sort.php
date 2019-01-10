<?php 
session_start();

// print_r($_SERVER);

if(isset($_GET['sort'])) {

	$sort_order = $_GET['sort'];

	if ($sort_order === "asc") {
		$_SESSION['sort'] = "ORDER BY price ASC";
		
	} else if ($sort_order === "dsc") {
		$_SESSION['sort'] = "ORDER BY price DESC";
	}

	header("Location: ".$_SERVER['HTTP_REFERER']);
}


?>