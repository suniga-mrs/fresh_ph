	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Profile";
		echo $page_title;

	} ?>

	<?php function get_page_content() { ?>

<?php 
	global $conn;

	$user = $_SESSION['user']; 
	$id = $_SESSION['user']['id'];
?>
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="list-group" id="list-tab" role="tablist">
					<a class="list-group-item" href="#profile" data-toggle="list" role="tab">
						User Information
					</a>
					<a class="list-group-item" href="#history" data-toggle="list" role="tab">
						Order History
					</a>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="tab-content">
					<div class="tab-pane" id="profile" role="tabpanel">
						<h3>User Information</h3>
						<?php if (isset($_SESSION['user'])) { ?>
						<form id="update_user_details" action="../controllers/update_profile.php" method="POST">
							<div class="container">
								<input type="text" class="form-control" name="user_id" value="<?php echo $user['id'] ?>" hidden>
								<label for="username">Username:</label>
								<input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username'] ?>" disabled>
								<span class="validation"></span><br>
								<label for="firstname">First Name</label>
								<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname'] ?>">
								<span class="validation"></span><br>
								<label for="lastname">Last Name</label>
								<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname'] ?>">
								<span class="validation"></span><br>
								<label for="email">E-mail Address</label>
								<input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?>">
								<span class="validation"></span><br>
								<label for="address">Address</label>
								<input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address'] ?>">
								<span class="validation"></span><br>
								<br>
								<button type="button" class="btn btn-primary mb-5" id="update_info">Update Info</button>
							</div>
						</form>
						<?php } ?>
					</div>
					<div class="tab-pane" id="history" role="tabpanel">
						<div class="row">
							<div class="col-md-12">
								<h3>Order History</h3>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr class="text-center">
										<th>Transaction Number</th>
										<th>Purchase Date</th>
										<th>Status</th>
										<th>Payment Mode</th>
									</tr>
								</thead>
								<tbody>
									<?php

									//get user's order history
									$sql = "SELECT o.transaction_code, o.purchase_date, s.name AS status, pm.name AS payment FROM orders o JOIN statuses s ON (o.status_id = s.id) JOIN payment_modes pm ON (o.payment_mode_id = pm.id) WHERE user_id=$id";

									$transactions = mysqli_query($conn, $sql);

									// echo (mysqli_num_rows($result));
									// print_r($transactions);
									foreach ($transactions as $list) {?>
									<tr>
										<td><?php echo $list['transaction_code'] ?></td>
										<td><?php echo $list['purchase_date'] ?></td>
										<td><?php echo $list['status'] ?></td>
										<td><?php echo $list['payment'] ?></td>
									</tr>

								
                                        <?php }	?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

