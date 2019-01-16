	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Add Item";
		echo $page_title;

	} ?>

	<?php function get_page_content() { 
			global $conn;
		?>

		<div class="container">
			<div class="row pt-4">
				<div class="col-md-12 text-center">
					<h2>Add a New Item</h2>
				</div>
			</div>
			<div class="row">
				<div class="offset-md-2 col-md-8">
					<form id="add_item_form" method="POST">
						<div class="form-group">
							<label for="item_name" class="form-control-label">Name:</label>
							<input id="item_name" type="text" name="item_name" class="form-control" required>
							<div class="form-row">
								<div class="col">
									<label for="item_price" class="form-control-label">Price:</label>
									<input id="item_price" type="number" name="item_price" step="0.01" class="form-control" required>									
								</div>
								<div class="col">
									<label for="item_category" class="form-control-label">Category:</label>
									<select id="item_category" name="item_category" class="form-control">
										<?php 
										$sql = "SELECT * FROM categories";
										$categories = mysqli_query($conn, $sql);

										foreach ($categories as $category) { ?>
													
										<option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>

										<?php } ?>

									</select>
								</div>
							</div>

							<label for="item_description" class="form-control-label" >Description:</label>
							<textarea id="item_description" type="text" name="item_description" class="form-control" required></textarea>				
						</div>
						<label for="item_description" class="form-control-label">Image:</label>
						<input id="item_image" type="file" name="item_image" class="form-control-file" required>
						<div class="form-group pt-4">
							<button id="addItemBtn" type="button" class="btn btn-primary">Add Item</button>
						</div>
					</form>
				</div>
			</div>
		</div>


	<?php } ?>
