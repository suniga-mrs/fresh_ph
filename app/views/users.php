	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "User Admin";
		echo $page_title;

	} ?>

	<?php 
		function get_page_content() { 

			if((isset($_SESSION['user'])) && $_SESSION['user']['roles_id'] == 1) {
			
			global $conn;

			$get_users_sql = "SELECT u.id, u.username, u.firstname, u.lastname, u.email, r.name AS role FROM users u JOIN roles r ON (u.roles_id = r.id)";
			$user_lists = mysqli_query($conn, $get_users_sql);
	?>
	

	<div class="container">
		<div class="row pt-3">
			<div class="col">
				<h1 class="text-center">User Admin Page</h1>
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
							<th >Username</th>
							<th >First Name</th>
							<th >Last Name</th>
							<th >Email</th>
							<th class="width-15">Account Type</th>
							<th class="width-25">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($user_lists as $user) { ?>
						<tr>
							<td ><?php echo $user['username']; ?></td>
							<td ><?php echo $user['firstname']; ?></td>
							<td ><?php echo $user['lastname']; ?></td>
							<td ><?php echo $user['email']; ?></td>
							<td class="width-15"><?php echo $user['role']; ?></td>
							<td class="width-25">
								<?php if ($user['role'] == "admin"): ?>
								<button class="btn btn-info admin_user_ctrl" data-user-id="<?php echo $user['id']; ?>" data-user-role="<?php echo $user['role']; ?>"></i> Revoke Admin</button>
								<?php elseif ($user['role'] == "user"): ?>
								<button class="btn btn-danger admin_user_ctrl" data-user-id="<?php echo $user['id']; ?>" data-user-role="<?php echo $user['role']; ?>" ></i> Make Admin</button>
								<?php endif; ?>
								<a data-user-id="<?php echo $user['id']; ?>" class="btn btn-secondary admin_user_del text-light"><i class="fas fa-trash-alt"></i></a>
							</td>
						</tr>
						<?php } ?>						
					</tbody>
				</table>
			</div>
		</div>
	</div>


		
	

		<!-- HTML CONTENT HERE  -->


	<?php 

		} else { 
			header("Location: ./error.php");

		}?>

	<?php }?>

