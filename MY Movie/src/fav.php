<?php 
	session_start();
	include("server.php"); 

	if(!isset($_SESSION['username'])&& empty($_SESSION['username'])&&  $_SESSION["status"]="Pending" && $_SESSION["status"]="Rejected"){ 
		header( "location: index.php" );  
	} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FAVORITE</title>
	<link rel="shortcut icon" href="logo1.png" type="image/x-icon">

	<!--------- CSS --------- -->
	<link rel="stylesheet" href="../font awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/basic.css">
	<link rel="stylesheet" href="../css/fav.css">

	<!--------- SCRIPT ------  -->
	<script src="../js/pace.min.js"></script>

</head>

<body style="background-color: #343a40;" class="animate-bottom">

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

		<ul class="nav justify-content-start">
			<a class="navbar-brand" href="#">
				<?php if(isset($_SESSION['username'])) { echo"Hi ".$_SESSION['username'] ;}?></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">
					<?php if(isset($_SESSION['username'])) {
						echo'<img src="../images/user_profile.jpg" style: height=30; width=30;>';} ?>
				</span>
			</button>
		</ul>
		<ul class="navbar-toggler nav justify-content-center ">
			<form id="movieminiSearch" class="form-inline" autocomplete="on" method="post">

				<input class="form-control mr-sm-2" id="movie_minititle" type="search" placeholder="Titanic..."
					required="" name="movie_title" aria-label="Search" style="max-width:150px; margin-right:3px">

				<button type="submit" class="btn btn-outline-success my-2 my-sm-0">Search
				</button>

			</form>

		</ul>


		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php"> Home <span class=" sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>


			<form id="movieSearch" class="form-inline" autocomplete="on" method="post">

				<input class="form-control mr-sm-2" id="movie_title" type="search" placeholder="Search..." required=""
					name="movie_title" aria-label="Search">

				<button type="submit" class="btn btn-outline-success my-2 my-sm-0">Search a Movie</button>

			</form>
		</div>
	</nav>

	<section id="main-on">
		<div class="container">
			<div id="load" style="display: none;" class="spinner-border ">
			</div>

			<div id="main">

				<h1 id="searchResult" style=" display:none; color: #fffaf0;">Search Result ...</h1>
				<div id="recordSearch" style="display:none;" class=" row equal-cols animate-bottom ">

					<div style="color:pink " id="message"></div>
					<div style="color:pink" id="messageD"></div>

				</div>

				<div style="margin: 15px;">
					<h1 style="text-align:center;">My Movies</h1>
					<div class="row equal-cols animate-bottom" id="records"></div>

				</div>
			</div>
		</div>
	</section>

	<?php include 'footer.php';?>

	<div class="go-top">
		<a title="Back to Top" class="smoothscroll " id="scrollUp" href="#top" aria-hidden="true">
			<i class="fa fa-angle-up"></i>
		</a>
	</div>

	<!-- preloader
    ================================================== -->
	<div id="preloader">
		<div id="loader">
			<div class="line-scale-pulse-out">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	</div>

	<!--------- SCRIPT ------  -->
	<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});

	var myVar;

	function myFav() {
		document.getElementById("load").style.display = "inline-block";
		myVar = setTimeout(showFav, 1000);
		console.log("hey");
	}

	function showFav() {
		document.getElementById("load").style.display = "none";
		document.getElementById("main").style.display = "block";
		console.log("heyuu");
	}
	</script>

	<script src="../jquery/jquery-3.1.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	<script src="../axios/dist/axios.min.js"></script>
	<script src="../js/main.js"></script>

	<script type="text/javascript">
	getFavMovies(), getFavMovie()
	</script>


</body>

</html>