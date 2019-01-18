	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Orders";
		echo $page_title;

	} ?>

	<?php 
		function get_page_content() { 

			if((isset($_SESSION['user'])) && $_SESSION['user']['roles_id'] == 1) {			
			global $conn;

			$get_orders_sql = "SELECT o.id, u.username, o.transaction_code, o.total, s.name AS status FROM orders o JOIN statuses s ON (o.status_id = s.id) JOIN users u ON (o.user_id = u.id)";
			$order_lists = mysqli_query($conn, $get_orders_sql);
			// $order_lists = mysqli_query($conn, $get_users_sql);
	?>

	<div class="container">
		<div class="row pt-3">
			<div class="col">
				<h1 class="text-center">Orders Admin Page</h1>
			</div>
		</div>
	</div>	

	<hr>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-bordered te">
					<thead>
						<tr class="text-center">
							<th >ID</th>
							<th >Username</th>
							<th >Transcation Code</th>
							<th >Total</th>
							<th class="width-15">Status</th>
							<th class="width-25">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($order_lists as $order) { ?>
						<tr class="text-center">
							<td ><?php echo $order['id']; ?></td>
							<td ><?php echo $order['username']; ?></td>
							<td ><?php echo $order['transaction_code']; ?></td>
							<td ><?php echo $order['total']; ?></td>
							<td ><?php echo $order['status']; ?></td>
							<td class="width-25">
								<?php if ($order['status'] == "pending"): ?>
								<button class="btn btn-success order_ctrl" data-order-id="<?php echo $order['id']; ?>" data-status="complete">Complete</button>
								<button class="btn btn-danger order_ctrl" data-order-id="<?php echo $order['id']; ?>" data-status="cancel">Cancel</button>
								<?php else: ?>
								<span class="text-muted">No actions to make</span>
								<?php endif; ?>
							</td>
						</tr>
						<?php } ?>						
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<?php 

		} else { 
			header("Location: ./error.php");
		}?>

	<?php }?>
