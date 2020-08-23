<?php 

    include("server.php");
	session_start(); 

	$result = "";
	
	$movie_id = $_POST['movie_id'];
    $username = $_SESSION["username"];


	$sql = "SELECT * FROM favorite_list WHERE movie_id ='$movie_id' AND user_username='$username'";
	$result = mysqli_query($db, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	
	if ($resultCheck > 0) {
		$sql = "DELETE FROM favorite_list WHERE user_username = '$username' AND movie_id = '$movie_id' ";

	}elseif ($resultCheck == 0) { 
		$result = 2; 
	}
	else{
		echo "An Error Has Occurred";
	}
	
	if ($db->query($sql) === TRUE) { 
		$result = 1; 
	}
	elseif ($db->query($sql) === FALSE) { 
		$result = 3; 
	}  

	echo $result;
$db ->close();
?>