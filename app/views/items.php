	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Catalog";
		echo $page_title;

	} ?>

	<?php 
		function get_page_content() { 

			if((isset($_SESSION['user'])) && $_SESSION['user']['roles_id'] == 1) {
					
			global $conn;
			// print_r($_SESSION['user']);
	?>
			
	<?php
		// QUERIES
		$sql1 = "SELECT * FROM categories";
		$sql2 = "SELECT items.id, items.price, items.description, items.image_path, items.name AS item_name, categories.name AS category_name FROM items JOIN categories ON (categories.id = items.category_id)";

		if(isset($_GET['category'])){
			$category = $_GET['category'];
				// $sql2 .= " WHERE category_id=$category ";				
			if($category !== "all") {
				$sql2 .= " WHERE category_id=$category ";				
			}
		}
		// print_r($sql2);

		if(isset($_SESSION['sort'])) {
			$sql2 .= $_SESSION['sort'];
		}

		$categories = mysqli_query($conn, $sql1);
		$items = mysqli_query($conn, $sql2);

	 ?>
		<!-- HTML CONTENT HERE  -->
		<section id="products_list" class="pt-4" >
			<div class="container">
				<div class="row"> 
					<div class="col-12 text-center">
						<h1>Admin Page</h1>
					</div>
				</div>
				<hr>
				<div class="row py-1">
					<div class="col-md-3">
						<div class="col-12">
							<a id="addItemBtn" href="./new_item.php" class="btn btn-warning py-2 mb-4">Add Item</a>
						</div>	

						<div class="col-12">
							<h2>Categories</h2>
						</div>
						<div class="col-12">
							<div id="categories_list">
								<ul class="list-group">
									<a href="items.php?category=all">
										<li class="list-group-item">All</li>
									</a>
									<?php foreach ($categories as $category) { ?>
										<a href="items.php?category=<?php echo $category['id']; ?>">
									<li class="list-group-item"><?php echo $category['name']; ?></li></a>
									<?php } ?>
								</ul>
							</div>				
						</div>
<!-- 						<div class="col-12 mt-3">
							<h2>Sort</h2>
						</div> -->
						
					</div>
					<div class="col-md-9">	
		<!-- 				<div class="col-4">
							<h2 >Products</h2>
						</div> -->
						<div class="">
							<div class="row flex-row flex-wrap">
								<?php foreach ($items as $item) { ?>
								<div class="col-6 col-md-3">
									<div class="card">
										<img src="../assets/images/<?php echo $item['image_path']; ?>" alt="<?php echo $item['item_name']; ?>" class="card-img-top">
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
										<div class="card-footer">
											<form id="admin_controls" class="d-flex flex-row">
												<a href="edit_item.php?id=<?php echo $item['id']; ?>" class="btn btn-primary"><i class="fas fa-pen"></i> Edit</a>
												<a href="#" class="btn btn-secondary delete_item" data-id="<?php echo $item['id']; ?>"><i class="fas fa-trash-alt"></i> Remove</a>
											</form>
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


	<?php 

	} else { 
		header("Location: ./error.php");

	}?>

<?php }?>

