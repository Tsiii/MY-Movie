<?php

    include("server.php");
	session_start(); 
	
	$result = "";
		if(isset($_SESSION['username'])) { 
			$movie_title = mysqli_real_escape_string($db,$_POST['movie_title']);
			$movie_image = $_POST['movie_image'];
			$movie_id = $_POST['movie_id'];
			$username = $_SESSION['username']; 
			$date = date('Y-m-d H:i:s'); 
			
			$sql = "SELECT * FROM favorite_list WHERE movie_id ='$movie_id' AND user_username='$username'";
			$result = mysqli_query($db, $sql);
			$resultCheck = mysqli_num_rows($result);  
			
			if ($resultCheck > 0) {  
				$result = 3;  
			} 
			elseif ($resultCheck == 0 ){  
				
				$sql = "INSERT INTO favorite_list (user_username, movie_title, movie_image, movie_id, inserted_date)  
				VALUES ('$username', '$movie_title', '$movie_image', '$movie_id','$date')"; 
   
				if ($db->query($sql) === TRUE) { 
					$result = 1; 
				}
				elseif ($db->query($sql) === FALSE) {
					//echo "Data is Still On AIR"; 
					$result = 2;
				} 
			}
			else{
				$result = 4;  
				echo "Unknown Error Has Occurred ";
			}  
		}else {
			$result = 5;
		}
		
echo $result;
$db ->close();
?>