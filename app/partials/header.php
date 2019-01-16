	<header>	
		<nav class="navbar navbar-expand-sm bg-success navbar-dark">
			<div class="container">
				<a class="navbar-brand" href="index.php"><h1>Fresh&trade;</h1></a>
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content">
				    <span class="navbar-toggler-icon"></span>
				</button>
			  	
				<div class="collapse navbar-collapse" id="nav-content">
				  	<ul class="navbar-nav mr-auto">
					    <li class="nav-item">
					      <a class="nav-link" href="catalog.php">Catalog</a>
					    </li>
					    <?php if (!isset($_SESSION['user'])) { ?>
					    <li class="nav-item">
					      <a class="nav-link" href="register.php">Register</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link" href="login.php">Login</a>
					    </li>					    	
					    <?php } ?>
				  	</ul>
				 </div>
			  	<div class="collapse navbar-collapse">
				  	<ul class="navbar-nav ml-auto">
					    <li class="nav-item">
					    	<?php if(isset($_SESSION['cart'])) { ?>
								<button id="empty_cart"type="button" class="btn btn-success"><a href="../controllers/empty_cart.php">Empty Cart</a></button>
					    	<?php } ?>
					     		<button type="button" class="btn btn-success"> <a href="cart.php"><i class="fas fa-shopping-cart"></i> &nbsp;<span id="cart-count" class="badge badge-warning"><?php if (isset($_SESSION['cart'])) { echo array_sum($_SESSION['cart']); } else { echo "0"; } ?></span></a></button>					    		
					    	
					    </li>
					<?php if (isset($_SESSION['user'])) { ?>
					    <li class="nav-item">
						    <div class="dropdown">
							    <button type="button" class="btn btn-success dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"><?php echo $_SESSION['user']['username']; ?></button>
						      	<div class="dropdown-menu">
							    <a class="dropdown-item py-2" href="profile.php">Profile</a>
							    <a class="dropdown-item py-2" href="new_item.php">Add Item</a>
							    <hr class="my-2">
							    <a class="dropdown-item py-2" href="../controllers/logout.php">Logout</a>
						  		</div>
						  		
						    </div>
					    </li>

					    
				  	</ul>
				 </div>
			 </div><?php }?>
		</nav>
	</header>
