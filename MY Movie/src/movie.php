<?php 
session_start();
include ('server.php');   

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Movie Final</title>

	<!--------- CSS --------- -->
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/basic.css">
	<link rel="stylesheet" href="../css/movieDetail.css">

	<!--------- SCRIPT ------  -->
	<script src="../jquery/jquery-3.1.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</head>

<body>

	<nav class="navbar navbar-inverse " style="background-color: rgba(0.5, 0.5, 0.5, 0.5)" id="nav-custom">
		<ul class=" nav justify-content-start">

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">
					<?php if(isset($_SESSION['username'])) {
						echo'<img src="../images/user_profile.jpg" style: height=30; width=30;>';}
						else{ echo'<img src="../images/logo1.png" style: height=30; width=30;>'; } ?>
				</span>
			</button>

			<li class="nav-item">
				<a class="nav-link active" href="#">
					<?php if(isset($_SESSION['username'])) { echo $_SESSION['username'] ;}?></a>
			</li>
		</ul>

		<ul class="nav justify-content-end">
			<li class="nav-item">
				<a class="navbar-brand text-light" style="margin-left:165px; font-size: 2rem;" href=" index.php">
					Movie</a>
			</li>
		</ul>

		<ul class="nav justify-content-end">
			<?php if(isset($_SESSION['username'])) { ?>
			<li class="nav-item">
				<a class="nav-link" href=" index.php">Home</a>
			</li>

			<li class="nav-item active">
				<a class="nav-link" href="fav.php">My Favorite<span class=" sr-only">(current)</span></a>
			</li>

			<a href="logout.php" type="submit" name="logout" class="btn btn-danger navbar-btn">Logout </a>

			<?php }else{  ?>

			<li class="nav-item">
				<a class="nav-link" href="index.php">Home</a>
			</li>

			<a href="login.php" type="submit" name="login" class="btn btn-success navbar-btn">Login</a>

			<?php } ?>
		</ul>
	</nav>

	<section id="container">
		<div class="container" id="movie" style=" margin-top: 100px; ">

			<h2 class='text-center mt-4' id='movie_title' style='margin: 10px;'>Movie_title</h2>
			<div class='col-md-5' style="margin-bottom: 15px;" width='350' height='400'>
				<img id='movie_image' width='350' height='400' class='thumbnail'>
			</div>

		</div>

	</section>

	<?php include 'footer.php';?>

	<!--------- SCRIPT ------  -->
	<script>
	function goBack() {
		window.history.back()
	}
	</script>

	<script src="../ajax/jquery-1.11.2.min.js"></script>

	<script src="../axios/dist/axios.min.js"></script>
	<script src="../js/main.js"></script>

	<script>
	getMovie();
	</script>
</body>

</html>