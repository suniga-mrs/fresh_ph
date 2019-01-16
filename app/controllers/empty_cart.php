<?php

session_start();
	
unset($_SESSION['cart']);
// print_r($_SERVER);
header("Location:" . $_SERVER['HTTP_REFERER']);


?>