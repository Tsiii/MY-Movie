<?php 	
		if(isset($_SESSION['username'])) { 
	
			echo '<nav class="navbar navbar-inverse bg-dark">
				<ul class="nav justify-content-start">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon">
							<img src="../images/user_profile.jpg" style: height=30; width=30;>
						</span>
					</button>
					<li class="nav-item">
						<a class="nav-link active" href="#">Hi ' .$_SESSION['username'].'</a>
					</li>
				</ul>

				<ul class="nav justify-content-end">
					<li class="nav-item">
						<a class="navbar-brand text-light" href="index.php" class="danger">Movie</a>
					</li>
				</ul>

				<ul class="nav justify-content-end">
					<li class="nav-item">
						<a class="nav-link" href="index.php" class="danger">Home</a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="fav.php">My Favorite<span class=" sr-only">(current)</span></a>
					</li>

					<a href="logout.php" type="submit" name="logout" class="btn btn-danger navbar-btn" >Logout </a>
				</ul>
			</nav>';
 
		}else{

			echo '<nav class="navbar navbar-inverse bg-dark">
				<ul class="nav justify-content-start">
				 
				</ul>

				<ul class="nav justify-content-end">
					<li class="nav-item active">
						<a class="navbar-brand text-light" href="index.php" class="danger">Movie Name</a>
					</li>
				</ul>

				<ul class="nav justify-content-end">
					<li class="nav-item"> 
						<a class="btn btn-light navbar-btn" href="registration.php" type="submit" name="register" style="margin-right:25px;" >Register </a>
					</li> 
 

					<li class="nav-item">
						<a href="login.php" type="submit" name="login" class="btn btn-danger navbar-btn " >Login </a>
					</li>
				</ul>
				
			</nav>';
		}
	?>