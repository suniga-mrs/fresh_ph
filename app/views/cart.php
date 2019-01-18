	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Cart";
		echo $page_title;

	} ?>

	<?php function get_page_content() { 
		
		if((!isset($_SESSION['user'])) || $_SESSION['user']['roles_id'] == 2) {

			global $conn;
	?>

		<!-- HTML CONTENT HERE  -->
		
		<div class="container">
			<div class="row pt-5 pb-2">
				<h3 class="text-center">My Cart</h3>
			</div>
			<div class="row">
				<table class="table table-striped table-bordered text-center">
					<thead>
						<tr>
							<th scope="col">Item Name</th>
							<th scope="col">Item Price</th>
							<th scope="col">Item Quantity</th>
							<th scope="col">Subtotal</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody >


						<?php 
							if(isset($_SESSION['cart']) && count($_SESSION['cart']) !== 0) {
								// echo 'may laman';
								// var_dump($_SESSION['cart']);
								$cart_total = 0;
								foreach ($_SESSION['cart'] as $id => $qty) {
									$sql = "SELECT * FROM items WHERE id ='$id' ";
									$result = mysqli_query($conn, $sql);
									$item = mysqli_fetch_assoc($result);
									$subtotal = $_SESSION['cart'][$id] * $item['price'];
									$cart_total += $subtotal;							
						?>

						<tr>
						    <td class="item_name"> <?php echo $item['name']; ?></td>
							<td class="item_price"> <?php echo $item['price']; ?></td>
							<td class="item_quantity"> 
								<input type="number" value="<?php echo $qty; ?>" class="form-control" data-id="<?php echo $id; ?>" min="1" >
							</td>
							<td class="item_subtotal"> <?php echo $subtotal; ?></td>
							<td class="item_action text-center">
								<button class="btn btn-danger item-remove" data-id="<?php echo $id; ?>">Remove from cart</button>
							</td>

						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3" class="text-right font-weight-bold">Total</td>
							<td colspan="1" class="font-weight-bold" id="total_price"><?php echo $cart_total; ?></td>
							<td colspan="1" class="font-weight-bold" id="total_price"><a href="checkout.php"><button class="btn btn-primary">Proceed to Checkout</button></a></td>
						</tr>
					</tfoot>

					<?php } else {
						echo '<tr><td class="text-center" colspan="5">No items in the cart</td></tr>';
					} ?>
				</table>	
			</div>	

		</div>

	<?php 

		} else { 

			header("Location: ./error.php");

		}

	}?>
