	<?php 
session_start();

include ('server.php');  
include('header.php');

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Login Form</title>

		<!--------- CSS --------- -->
		<link rel="stylesheet" href="../font awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/basic.css">
		<link rel="stylesheet" href="../css/login.css">

		<!--------- SCRIPT ------  -->
		<script src="../ajax/jquery-1.11.2.min.js"> </script>
		<script src="../js/bootstrap.min.js"></script>


	<body style="padding-top: 0px;padding-bottom: 0px;">

		<div class="container">

			<section id="login-id" style="align:center;">
				<div class="col-lg-12 text-center ">
					<h1 style="font-family:Lucida Console">Login</h1>
				</div>


				<div id="movie"> </div>



				<?php 
			/*
			include("server.php");
			session_start();

			if(isset($_POST['login'])){

				$username = mysqli_real_escape_string($db,$_POST['username']);
				$password = mysqli_real_escape_string($db,$_POST['password']);
				
				$password = md5($password);

				$count = 0;
				$result = mysqli_query($db, "SELECT * FROM user_registration WHERE user_username='$username' AND user_password='$password' ");
				
				$count = mysqli_num_rows($result); 

				$countStatus = 0;
				$resultStatus = mysqli_query($db, "SELECT user_status FROM user_registration WHERE user_username='$username' AND user_password='$password' ");
				$countStatus = mysqli_num_rows($resultStatus); 
				$row = mysqli_fetch_assoc($resultStatus);
				
			
				if ($count==0)  {	
					echo '<div class="alert alert-danger col-lg-6 col-lg-push-3">
							<p>Invalid Username Or Password.</p>
						</div>';
				}
				elseif  ($row['user_status'] == "ACCEPTED") {  
					$_SESSION["username"]=$username; 
					$user_status = $row['user_status'] ;   

				}
				elseif ($row['user_status'] == "PENDING") {
					echo '<div class="alert alert-success col-lg-12 col-lg-push-0">
							<h1>your account is not approved</h1> 
						</div>';
				} 
				elseif($row['user_status'] == "REJECTED") {
					echo '<div class="alert alert-success col-lg-12 col-lg-push-0">
							<h1>Your ACCOUNT HAS Been REJECTED!!</h1>
						</div>';
				} 
				else{
					echo '<div class="alert alert-success col-lg-12 col-lg-push-0">
							<h1>UNKNOWN ERROR HAS OCCURRED PLEASE TRY AGAIN.</h1>
						</div>';	 
				} 	
			}*/
			?>

			</section>
		</div>
		<script src="../ajax/jquery-1.11.2.min.js"></script>
		<script src="../js/ma.js"></script>

		<script>
		display();
		</script>
	</body>

	</html>