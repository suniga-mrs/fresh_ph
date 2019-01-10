	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Catalog";
		echo $page_title;

	} ?>

	<?php function get_page_content() { 

			global $conn;
	?>
			
	<?php
		// QUERIES
		$sql1 = "SELECT * FROM categories";
		$sql2 = "SELECT * FROM items";
		$categories = mysqli_query($conn, $sql1);
		$items = mysqli_query($conn, $sql2);

	 ?>
		<!-- HTML CONTENT HERE  -->
		<section id="products_list" >
			<div class="container">
				<div class="row pt-5">
					<div class="col-12">
						<h2 class="text-center">Products</h2>
					</div>
				</div>
				<div class="row py-1">
					<div class="col-md-3">
						<div class="box red">
							<div id="categories_list">
								<ul class="list-group">
									<?php foreach ($categories as $category) { ?>
									<li class="list-group-item"><?php echo $category['name']; ?></li>
									<?php } ?>
								</ul>
							</div>							
						</div>
					</div>
					<div class="col-md-9">
						<div class="box green">
							<div class="row flex-row flex-wrap">
								<?php foreach ($items as $item) { ?>
								<div class="col-3">
									<div class="card">
										<div class="card-body">
											<div class="card-title">
												<h5><?php echo $item['name']; ?></h5>
											</div>
											<div class="card-text">
												<p class="text-muted">
												<?php echo $item['description']; ?>
												</p>
											</div>
											<h6>P<?php echo $item['price']; ?></h6>
										</div>
									</div>
								</div>								
							
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


	<?php } ?>

