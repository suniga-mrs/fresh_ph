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
		$sql2 = "SELECT items.price, items.description, items.name AS item_name, categories.name AS category_name FROM items JOIN categories ON (categories.id = items.category_id)";

		if(isset($_GET['category'])){
			$category = $_GET['category'];
			$sql2 = "SELECT items.price, items.description, items.name AS item_name, categories.name AS category_name FROM items JOIN categories ON (categories.id = items.category_id) WHERE category_id=$category";
		}

		$categories = mysqli_query($conn, $sql1);
		$items = mysqli_query($conn, $sql2);

	 ?>
		<!-- HTML CONTENT HERE  -->
		<section id="products_list" class="pt-5" >
			<div class="container">
				<div class="row py-1">
					<div class="col-md-3">
						<div class="col-12">
							<h2>Categories</h2>
						</div>
						<div class="box red">
							<div id="categories_list">
								<ul class="list-group">
					<?php foreach ($categories as $category) { ?>
					<li class="list-group-item"><a href="catalog.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
					<?php } ?>
			</ul>
							</div>							
						</div>
					</div>
					<div class="col-md-9">
						<div class="col-12">
							<h2>Products</h2>
						</div>
						<div class="box green">
							<div class="row flex-row flex-wrap">
								<?php foreach ($items as $item) { ?>
								<div class="col-3">
									<div class="card">
										<div class="card-body">
											<div class="card-title">
												<h5><?php echo $item['item_name']; ?></h5>
											</div>
											<div class="card-subtitle">
												<p class="text-muted"><?php echo $item['category_name']; ?></p>
											</div>
											<div class="card-text">
												<p class="">
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

