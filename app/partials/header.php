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
					    <li class="nav-item">
					      <a class="nav-link" href="register.php">Register</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link" href="login.php">Login</a>
					    </li>
				  	</ul>
				 </div>
			  	<?php if (isset($_SESSION['user'])) { ?><div class="collapse navbar-collapse">
				  	<ul class="navbar-nav ml-auto">
					    <li class="nav-item">
					    	<div class="btn-group">
					      		<button type="button" class="btn btn-success">Empty Cart</button>
					     		 <button type="button" class="btn btn-success"><i class="fas fa-shopping-cart"></i> &nbsp;<span class="badge badge-warning">0</span></button>					    		
					    	</div>
					    </li>

					    <li class="nav-item">
						    <div class="dropdown">
						      <button type="button" class="btn btn-success dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"><?php echo $_SESSION['user']; ?></button>
						      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							    <a class="dropdown-item" href="../controllers/logout.php">Logout</a>
						  		</div>
						    </div>
					    </li>

					    
				  	</ul>
				 </div>
			 </div><?php }?>
		</nav>
	</header>
