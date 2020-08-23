<?php  
    include("server.php");
    session_start();

     

        $result_array = array();  

    	$movie_title = mysqli_real_escape_string($db,$_POST['movie_title']); 
     
        $username = $_SESSION["username"];
        
        $sql = "SELECT movie_title, movie_image, movie_id FROM favorite_list WHERE movie_title LIKE '%$movie_title%' AND user_username='$username'  ";
        
        $result = $db->query($sql);
         
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($result_array, $row);
            }
        } 
        echo json_encode($result_array); 
    
    $db->close();

   