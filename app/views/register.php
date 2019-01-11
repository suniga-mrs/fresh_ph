	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Register";
		echo $page_title;

	} ?>

	<?php function get_page_content() { ?>

		<!-- HTML CONTENT HERE  -->

		<section id="register-landing">
			<div class="container">
				<div class="row no-gutters pt-3 justify-content-center">
					<div class="col-md-4 align-self-center">
						<div class="row">
							<div class="text-light">
								<h1>Fresh&trade;</h1>
								<h3>Registration Page</h3>
							</div>
						</div>
						<div class="row ">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quidem, tempore placeat repudiandae quaerat, vitae qui hic. Deserunt doloribus, quidem nesciunt asperiores inventore, qui deleniti commodi eveniet et sit reiciendis.</p>
						</div>
					</div>
					<div class=" offset-md-1 col-md-7 align-self-end px-5">
						<!-- <h4 class="">Registration Page</h4> -->
						<form id="register_form" method="POST" class="bg-light" action="../controllers/create_user.php">
									
							<p class="label">Username:</p>
							<div class="form-group">
								<input id="username" type="text" name="username" class="form-control" placeholder="Username">
							</div>
							<div class="form-row">
								<div class="col">
									<p class="label">Password:</p>
									<div class="form-group">
										<input id="password" type="password" name="password" class="form-control" placeholder="Enter Password">
									</div>
								</div>
								<div class="col">
									<p class="label">Confirm Password:</p>
									<div class="form-group">
										<input id="confirm_password" type="password" name="password" class="form-control" placeholder="Confirm Password">
									</div>
								</div>
							</div>
							<hr class="mb-3 mt-2">
							<div class="form-row">
								<div class="col">
									<p class="label">First Name:</p>
									<div class="form-group">
										<input id="firstname" type="text" name="firstname" class="form-control" placeholder="First Name">
									</div>
								</div>
								<div class="col">
									<p class="label">Last Name:</p>
									<div class="form-group">
										<input id="lastname" type="text" name="lastname" class="form-control" placeholder="Last Name">
									</div>
								</div>
							</div>
					
							
							<p class="label">Email:</p>
							<div class="form-group">
								<input id="email" type="email" name="email" class="form-control" placeholder="Email">
							</div>
							<p class="label">Address:</p>
							<div class="form-group">
								<input id="address" type="text" name="address" class="form-control" placeholder="Address">
							</div>
							<!-- <p class="label">Notification message here</p> -->
							<div class="form-row pt-3">
								<div class="col">
									<button id="loginBtn" type="button" class="btn btn-secondary d-inline-block">Login</button>
								</div>
								<div class="col">
									<button id="registerBtn" type="button" class="btn btn-warning" disabled>Register</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
				</div>
			</div>
		</section>


	<?php } ?>