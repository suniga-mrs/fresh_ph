	<?php require_once "../partials/layout.php" ?>

	<?php function page_title() {
		
		$page_title = "Register";
		echo $page_title;

	} ?>

	<?php function get_page_content() { ?>

		<!-- HTML CONTENT HERE  -->

		<section id="leading">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-12">
						<div class="text-light text-center">
							<h1>Fresh&trade;</h1>
							<h3>Register Page</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 offset-md-3 px-5 pt-2">
						<form action="" class="bg-light">
							<div class="form-group">
								<input type="text" name="username" class="form-control" placeholder="Username">
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="Enter Password">
							</div>
							
							<div class="form-group">
								<div class="form-row">
									<div class="col">
										<input type="text" name="firstname" class="form-control" placeholder="First Name">
									</div>
									<div class="col">
										<input type="text" name="lastname" class="form-control" placeholder="Last Name">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<input type="email" name="email" class="form-control" placeholder="Email">
							</div>
							<div class="form-group">
								<input type="text" name="address" class="form-control" placeholder="Address">
							</div>
							<div class="">
								<button id="registrBtn" type="button" class="btn btn-warning ">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>


	<?php } ?>