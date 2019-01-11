	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Home";
		echo $page_title;

	} ?>

	<?php function get_page_content() { ?>

		<section id="masthead">			
			<div class="container-fluid">
				<div class="row text-center justify-content-center">
					<div class="col-12">
						<?php if (isset($_SESSION['user'])) { ?>
						<h1>Hello! <?php echo $_SESSION['user']; ?></h1>
						<?php } else {?>
						<h1>Hello!</h1>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>


	<?php } ?>
