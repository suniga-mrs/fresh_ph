	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Checkout";
		echo $page_title;

	} ?>

	<?php function get_page_content() { 
			global $conn;
		?>
		
		<?php if(!isset($_SESSION['user'])) {
			header("Location: ./login.php");
		} else {

		}
		?>
		<div class="container">
			<div class="row pt-5">
				<div class="col-md-12">
					<h2>Checkout page</h2>					
				</div>
			</div>
			<hr>
			<form id="checkout_form" method="POST" action="../controllers/placeorder.php">
				<div class="row">
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12">
									<h5>Shipping Address</h5>
								</div>
								<div class="col-md-12">
									<input type="text" class="form-control" name="addressLine1" value="<?php echo $_SESSION['user']['address'];?>">
								</div>
								<div class="col-md-12">
									<h5 class="pt-2">Order Summary</h5>
								</div>
								<div class="col-md-12">
									<table class="table table-bordered text-center">
										<thead>
											<th>Item Name</th>
											<th>Item Price</th>
											<th>Item Quantity</th>
											<th>Item Subtotal</th>
										</thead>
										<tbody>
										<?php foreach ($_SESSION['cart'] as $id => $qty) {
											$sql2 = "SELECT * FROM items WHERE id=$id";
											$result = mysqli_query($conn, $sql2);

											$item = mysqli_fetch_assoc($result);
										?>
										<tr>
											<td><?php echo $item['name'] ?></td>
											<td><?php echo $item['price'] ?></td>
											<td><?php echo $qty ?></td>
											<td><?php echo $qty * $item['price'] ?></td>
										</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>


						</div>
						<div class="col-md-4 text-left">
							<div class="col-md-12 pt-1">
								<p>TOTAL:</p>
							</div>
							<div class="col-md-12" id="total_price">
								<p>P<?php
									$cart_total = 0;
									 foreach ($_SESSION['cart'] as $id => $qty) {
									  	$sql =  "SELECT * FROM items WHERE id=$id";
									  	$result = mysqli_query($conn, $sql);
									  	$item = mysqli_fetch_assoc($result);

									  	$subtotal = $qty * $item['price'];
									  	$cart_total += $subtotal;
									  } 
									  echo $cart_total;
								?>
								</p>
							</div>
							<hr class="mt-5">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary ">Place Order</button>
							</div>
						</div>
				</div>
			</form>
	
		
		</div>

	<?php } ?>
