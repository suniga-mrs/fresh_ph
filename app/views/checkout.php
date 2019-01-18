	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Checkout";
		echo $page_title;

	} ?>

	<?php function get_page_content() { 

		if((isset($_SESSION['user'])) && $_SESSION['user']['roles_id'] == 2) {
			global $conn;
		?>
		
		<?php if(!isset($_SESSION['user'])) {
			header("Location: ./login.php");
		}

		$pm_sql = "SELECT * FROM payment_modes";
		$pm_results = mysqli_query($conn, $pm_sql);

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
							<div class="row no">
								<div class="col-md-6">
									<div class="row no-gutters">
										<div class="col-md-12">
											<h5>Shipping Address</h5>
										</div>
										<div class="col-md-12">
											<input type="text" class="form-control" name="addressLine1" value="<?php echo $_SESSION['user']['address'];?>">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-12">
											<h5>Payment Options</h5>
										</div>
										<div class="col-md-12">
											<select name="payment_mode" id="payment_mode" class="form-control">
												<?php foreach ($pm_results as $payment_mode) {
														extract($payment_mode);
														echo "<option value='$id'>$name</option>";
												} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<h5 class="pt-4">Order Summary</h5>
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
								<input type="hidden" name="total" value="<?php echo $cart_total ?>">
								<button type="submit" class="btn btn-primary ">Place Order</button>
							</div>
						</div>
				</div>
			</form>
	
		
		</div>

	<?php 

		} else { 

			header("Location: ./error.php");

		}

	}?>
