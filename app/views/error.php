	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Error";
		echo $page_title;

	} ?>

	<?php function get_page_content() { ?>

		<div class="container pt-5 text-center">
			<h1>You don't have access to this page</h1>
			<a href="index.php" class="btn btn-primary">Go Back Home</a>
		</div>

	<?php } ?>
