	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Edit Item";
		echo $page_title;

	} ?>

	<?php function get_page_content() { 

		if((isset($_SESSION['user'])) && $_SESSION['user']['roles_id'] == 1) {
			
			global $conn;

			if (isset($_GET['id'])) {
				$item_id = $_GET['id'];
				$sql = "SELECT * FROM items WHERE id='$item_id'";
				$result = mysqli_query($conn, $sql);
				$item = mysqli_fetch_assoc($result);
				
			} else {
				header("Location: " . $_SERVER['HTTP_REFERER']);
			}
		?>

		<div class="container">
			<div class="row pt-4">
				<div class="col-md-12 text-center">
					<h2>Edit Item</h2>
				</div>
			</div>

			<div class="row">
				<div class="offset-md-2 col-md-8">
					<form id="edit_item_form" method="POST" action="../controllers/process_edit_item.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="item_name" class="form-control-label">Name:</label>
							<input id="item_name" type="text" name="item_name" class="form-control" value="<?php echo $item['name'] ?>" required>
							<div class="form-row">
								<div class="col">
									<label for="item_price" class="form-control-label">Price:</label>
									<input id="item_price" type="number" name="item_price" step="0.01" class="form-control" value="<?php echo $item['price'] ?>" required>									
								</div>
								<div class="col">
									<label for="item_category" class="form-control-label">Category:</label>
									<select id="item_category" name="item_category" class="form-control" required>
										<?php 
										$sql2 = "SELECT * FROM categories";
										$categories = mysqli_query($conn, $sql2);

										foreach ($categories as $category) { ?>
													
											<?php  extract($category);
												$selected = $item['category_id'] == $id ? 'selected': '';
												echo "<option value='$id' $selected>$name</option>" ?><

										<?php } ?>
									</select>
								</div>
							</div>

							<label for="item_description" class="form-control-label" >Description:</label>
							<textarea id="item_description" type="text" name="item_description" class="form-control" required><?php echo $item['description'] ?></textarea>				
						</div>
				<!-- 		<label for="item_description" class="form-control-label">Image:</label>
						<input id="item_image" type="file" name="item_image" class="form-control-file" required> -->
						<div class="form-group pt-4">
							<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
							<button id="editItemBtn" type="submit" class="btn btn-primary">Update Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		


	<?php 

	} else { 

		header("Location: ./error.php");

	}

}?>
