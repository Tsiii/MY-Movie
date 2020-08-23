<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>index</title>

	<!--------- CSS --------- -->
	<link rel="stylesheet" href="../font awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/basic.css">
	<link rel="stylesheet" href="../css/index.css">

	<!--------- SCRIPT ------  -->
	<script src="../js/pace.min.js"></script>
	<script src="../jquery/jquery-3.1.1.min.js"></script>
</head>

<body>
	<?php 
session_start();

include ('server.php');  
include('header.php');

?>
	<div class="container">
		<h1 class="text-center mt-5">Movie Info App</h1>
		<div>
			<form id="movieForm" autocomplete="on" name="form3" action="" method="post">

				<div class="input-group mb-3">

					<input class="form-control" id="movie" type="text" placeholder="Type Your movie here..."
						onfocus="this.placeholder = ''" onblur="this.placeholder =' Type Your movie here...'"
						name=" movieinput" required>

					<div class="input-group-append ">

						<input class="single-input" id="year" type="number" min="1900" max="2099" step="1"
							placeholder="2015" />
						<input class="single-input" id="page" type="number" min="1" max="5" step="1"
							placeholder="page #" />
					</div>
				</div>

				<div class="form-group text-center">
					<button class="btn btn-outline-dark my-2 my-sm-0"> Search Movie </button>
					<button class="btn btn-outline-danger my-2 my-sm-0 " type="reset">Reset</button>
				</div>

			</form>
		</div>

		<div class="clearfix"></div>

		<section class="main">
			<div class="row">

				<div style="display:none;" id="load" class="spinner-border text-secondary"></div>

				<div style="text-align: center" class="row equal-cols animate-bottom" id="show">

				</div>
				<div class="details"> </div>
			</div>
		</section>

	</div>


	<!--------- SCRIPT ------  -->
	<script src="../axios/dist/axios.min.js"></script>
	<script src="../js/main.js"></script>

</body>

</html>