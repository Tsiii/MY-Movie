<?php 
    include("server.php");
	session_start();

	$result = "";  
	
    if(isset($_SESSION['username'])&&!empty($_SESSION['username'])){ 
        echo "<script type='text/javascript'>alert(' Already Logged In');</script>";
        header( "location: index.php" );  
	}  
	else{ 
		
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
			$result = 0;	 
		}
		elseif  ($row['user_status'] == "ACCEPTED") { 
			$_SESSION["username"]=$username; 
			$user_status = $row['user_status'] ;
			$result = $user_status;    
		}
		elseif ($row['user_status'] == "PENDING") { 
			$_SESSION["status"]="Pending"; 
			$result = 2; 
		} 
		elseif($row['user_status'] == "REJECTED") {
					$_SESSION["status"]="Rejected"; 
			$result = 3; 
		} 
		else{ 
			$result = 4;	  
		}		
	} 
	
	echo $result; 
	$db ->close();
?>