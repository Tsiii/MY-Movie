<?php

    include("server.php");
	session_start(); 
	
	$result = "";
		if(isset($_SESSION['username'])) {  
			$movieId = $_POST['movieId'];
			$username = $_SESSION['username'];  
			
			$sql = "SELECT * FROM favorite_list WHERE movie_id ='$movieId' AND user_username='$username'";
			$result = mysqli_query($db, $sql);
			$resultCheck = mysqli_num_rows($result);  

			if($resultCheck > 0){ 
				echo "exists";  
			} 
			else{
				echo "doesn't exits";
			} 
		}else {
			echo "error checking";
		}
		 
$db ->close();
?>