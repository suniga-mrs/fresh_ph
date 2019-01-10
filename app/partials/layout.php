<?php  /*$pageTitle = "Home"*/ ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>Sandbox Template - <?php page_title(); ?> <?php /*echo $pageTitle;*/ ?></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="	sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<!-- google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700" rel="stylesheet">
	
	<!-- external css -->
	<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
	<?php require_once "../partials/header.php" ?>
	<main>
	<?php require_once "../controllers/connect.php" ?>
	<?php get_page_content(); ?>
	</main>
	<?php mysqli_close($conn); ?>
    <?php require_once "../partials/footer.php" ?>
</body>
</html>