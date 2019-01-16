	<?php require_once "../partials/layout.php" ?>
	<?php function page_title() {		
		$page_title = "Login Page";
		echo $page_title;
	} ?>
	<?php function get_page_content() { ?>
		<section id="login_page">
			<div class="container">
				<h1 class="text-center">Welcome!</h1>
				<div class="row">
					<div class="col-md-6 offset-md-3">
						<form method="POST" class="bg-light p-4">
							<p class="label">Username:</p>
							<div class="form-group">
								<input id="username" type="text" name="username" class="form-control" placeholder="Username">
							</div><p class="label">Password:</p>
							<div class="form-group">
								<input id="password" type="password" name="password" class="form-control" placeholder="Password">
							</div>
							<button id="loginBtn" type="button" class="btn btn-warning">Login</button>
						</form>
					</div>
				</div>
			</div>
		</section>
	<?php } ?>
