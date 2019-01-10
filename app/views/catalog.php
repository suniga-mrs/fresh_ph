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
		$sql2 = "SELECT items.price, items.description, items.image_path, items.name AS item_name, categories.name AS category_name FROM items JOIN categories ON (categories.id = items.category_id)";

		if(isset($_GET['category'])){
			$category = $_GET['category'];
			$sql2 .= " WHERE category_id=$category ";
		}

		if(isset($_SESSION['sort'])) {
			$sql2 .= $_SESSION['sort'];
		}

		// print_r($sql2);

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
						<div class="">
							<div id="categories_list">
								<ul class="list-group">
					<?php foreach ($categories as $category) { ?>
						<a href="catalog.php?category=<?php echo $category['id']; ?>">
					<li class="list-group-item"><?php echo $category['name']; ?></li></a>
					<?php } ?>
			</ul>
							</div>							
						</div>
					</div>
					<div class="col-md-9">
						<div class="col-4">
							<h2 >Products</h2>
						</div>
						<div class="col-2">
							<a class="btn" href="../controllers/item_sort.php?sort=asc">v to ^</a>
							<a class="btn" href="../controllers/item_sort.php?sort=dsc">^ to v</a>
						</div>
						<div class="">
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
										<div class="card-footer flex-row flex-wrap">
											<!-- <select class="custom-select">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
											<div class="btn btn-primary">Add to Cart</div> -->

											<div class="d-flex flex-row">
											  <select class="custom-select">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												</select>
											  <div class="btn btn-primary add-to-cart"><i class="fas fa-plus"></i></div>
											</div>
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

