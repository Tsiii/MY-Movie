<?php 
    include("server.php");
    session_start();
    if(isset($_SESSION['username'])&&!empty($_SESSION['username'])){ 
        echo "<script type='text/javascript'>alert(' Already Logged In');</script>";
        header( "location: index.php" );  
    } 
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
	<script src="../js/popper.min.css"></script>
	<script src="../jquery/jquery-3.1.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">

		<section id="login-id" style="align:center;">
			<form class="form-signin" name="form1" action="" method="post">
				<div class="col-lg-12 text-center ">
					<h1 style="font-family:Lucida Console">Login</h1>
				</div>

				<div class="form-label-group">
					<input type="text" class="form-control" placeholder="Username" name="username" value="" required
						autofocus />
				</div>

				<div class="form-label-group">
					<input type="password" class="form-control" placeholder="Password" name="password" required="" />
				</div>

				<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>

				<p class="mt-4 text-muted"> New to site?
					<a href="registration.php"> Create Account </a>
				</p>
			</form>
		</section>

		<?php
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
				echo '<div class= "alert alert-danger alert-dismissible fade show col-lg-6 " id= "alertmsg" >   
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h3><strong>Error:</strong> Invalid Username Or Password.  </h3>
				</div>	';	 
			}
			elseif  ($row['user_status'] == "ACCEPTED") { 
				$_SESSION["username"]=$username; 
				$user_status = $row['user_status'] ;
				echo '<div class= "alert alert-success col-lg-6" id= "alertmsg" >  
							<h1>Hi ' . $_SESSION['username'].' Welcome Back <i class="fa-smile"></i></h1>
					</div>	';   
				header("Refresh:3; url=index.php" ); 
			}
			elseif ($row['user_status'] == "PENDING") { 
				$_SESSION["status"]="Pending"; 
				echo '<div class= "alert alert-warning alert-dismissible fade show col-lg-6" id= "alertmsg" >   
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h3><strong>Error:</strong>your account is not approved</h3>
				</div>	'; 
			} 
			elseif($row['user_status'] == "REJECTED") {
						$_SESSION["status"]="Rejected"; 
				echo '<div class= "alert alert-danger alert-dismissible fade show col-lg-6" id= "alertmsg" >   
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h3><strong>Error:</strong> Your ACCOUNT HAS Been REJECTED!! </h3>
				</div>	'; 
			} 
			else{ 
				echo '<div class= "alert alert-danger alert-dismissible fade show col-lg-6" id= "alertmsg" >   
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h3><strong>Error:</strong> UNKNOWN ERROR HAS OCCURRED PLEASE TRY AGAIN.  </h3>
				</div>	';	  
			}		
		}
		?>
	</div>

</body>

</html>