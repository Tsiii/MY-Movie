<?php
	include("server.php");
	session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title> | MyMovie | </title>
	<!--------- CSS --------- -->
	<link rel="stylesheet" href="../font awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/basic.css">
	<link rel="stylesheet" href="../css/registration.css">

	<!--------- SCRIPT ------  -->
	<script src="../js/popper.min.css"></script>
	<script src="../jquery/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>



</head>

<section class="login_wrapper">

	<div class="col-lg-12 text-center ">
		<h1 style="font-family:Lucida Console"> | MyMovie | </h1>
	</div>

	<form class=" form-signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="col-lg-12 text-center ">
			<h2>Registration Form</h2><br>
		</div>

		<div class="form-label-group">
			<input type="text" class="form-control" placeholder="FirstName" name="firstname" value="" required="" />
		</div>

		<div class="form-label-group">
			<input type="text" class="form-control" placeholder="LastName" name="lastname" value="" required="" />
		</div>

		<div class="form-label-group">
			<input type="text" class="form-control" placeholder="Username" name="username" value="" required="" />
		</div>

		<div class="form-label-group">
			<input type="email" class="form-control" placeholder="email" name="email" value="" required="" />
		</div>

		<div class="form-label-group">
			<input type="password" class="form-control" placeholder="Password" name="password" required="" />
		</div>

		<div class="col-lg-push-3">
			<input class="btn btn-lg btn-primary btn-block " type="submit" name="signup" value="Register">
		</div>

		<div class="separator">
			<p class="mt-3 text-muted">Already A User?
				<a href="login.php"> Login </a>
			</p>

			<div class="clearfix"></div>
			<br />
		</div>

	</form>
</section>

<?php
	if (isset($_POST["signup"])) { 
					
		$firstname = mysqli_real_escape_string($db,$_POST['firstname']);
		$lastname = mysqli_real_escape_string($db,$_POST['lastname']);
		$username = mysqli_real_escape_string($db,$_POST['username']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$password = mysqli_real_escape_string($db,$_POST['password']); 
		$date = date('Y-m-d H:i:s');

	
		//check if input character are valid
		if (!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname) ||
			!preg_match("/^[a-zA-Z]*$/", $username)) {
				echo '<div class= "alert alert-warning  col-lg-6" id= "alertmsg" > 
						<h1>Invalid First Or Last Name</h1> 
					</div>	';  
		}else {  
			$sql = "SELECT * FROM user_registration WHERE user_username='$username'";
			$result = mysqli_query($db, $sql);
			$resultCheck = mysqli_num_rows($result);

			if ($resultCheck > 0) {
				echo '<div class= "alert alert-warning col-lg-6" id= "alertmsg"> 
						<h1>Username Taken</h1> 
					</div>	'; 
				 
			} else { 
				$password = md5($password);
				$sql = "INSERT INTO user_registration (user_firstname, user_lastname, user_username, user_email, user_password, register_date) 
						VALUES ('$firstname', '$lastname', '$username', '$email', '$password',  '$date')";
				mysqli_query($db, $sql); 
				$_SESSION["username"]=$username; 
				echo '<div class= "alert alert-warning alert-dismissible fade show col-lg-6" id= "alertmsg" >  
						<h2>Registered successfully,' .$username. ' 
						You will get email when your account is approved</h2> <link href="login.php">
					</div>';   
			}
		}
	}
?>


</body>

</html>