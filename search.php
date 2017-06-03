<?php
	$host='localhost';
	$user='root';
	$pass='';
	$db='social_network';

	// Create connection
	$conn = new mysqli($host,$user,$pass,$db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$data = json_decode(file_get_contents("php://input"));
	
	if(!isset($data->search_text)|| !isset($data->search_category)){
		echo '';
	}
	else{
	$search_text = mysql_real_escape_string($data->search_text);
	$search_category = mysql_real_escape_string($data->search_category);
	$search_id = mysql_real_escape_string($data->search_id);
	
	//echo $search_text;
	//echo $search_category;
	//echo $search_id;
	
	$search_exploded = explode ( " ", $search_text );
	$x = 0; 
	$construct = "";
	foreach( $search_exploded as $search_each ){ 
			
		$x++; 
		if( $x == 1 ) 
			$construct .="content LIKE '%$search_each%'"; 
		else 
			$construct .="AND content LIKE '%$search_each%'"; 
	} 
	
	if($search_category == 'Friends'){
		$query ="SELECT * FROM friends JOIN users where friend_id = userID and user_id = '$search_id' and $construct";
		//echo "<br>".$query;
		$result = mysqli_query($conn,$query);
		$num= mysqli_num_rows($result);
		
		if($num>0){
			while($row = mysqli_fetch_array($result)){
				$output[] = $row;
			}
			echo json_encode($output);
		}
		else{
			echo "";
		}
	}
	else if($search_category == 'Users'){
		$query ="SELECT * FROM users where $construct AND userId!='$search_id'";
	
		$result = mysqli_query($conn,$query);
		$num= mysqli_num_rows($result);
		
		if($num>0){
			while($row = mysqli_fetch_array($result)){
				$output[] = $row;
			}
			echo json_encode($output);
		}
		else{
			echo "";
		}
	}
	else{
		$query="SELECT p.ID,p.post_Content,Email from users join (select * from posts where $construct) as p where p.author_id = UserId";
		
		$result = mysqli_query($conn,$query);
		$num= mysqli_num_rows($result);
		
		if($num>0){
			while($row = mysqli_fetch_array($result)){
				$output[] = $row;
			}
			echo json_encode($output);
		}
		else{
			echo "";
		}
	}
	}
?>