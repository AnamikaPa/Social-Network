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
	
	if(!isset($data->search_text)){
		echo '';
		$page=0;
	}
	else{
	$search_text = mysql_real_escape_string($data->search_text);
	$search_category = mysql_real_escape_string($data->search_category);
	$search_id = mysql_real_escape_string($data->search_id);
	
	if(!isset($data->search_page)){
		$page=1;
	}
	else{
		$page=mysql_real_escape_string($data->search_page);
	}
	
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
		
		$record_per_page= 50;
		$start_from = ($page - 1)*$record_per_page;
		
		$query ="SELECT * FROM friends JOIN users where friend_id = userID and user_id = '$search_id' and $construct LIMIT $start_from,$record_per_page";
		$query1 ="SELECT * FROM friends JOIN users where friend_id = userID and user_id = '$search_id' and $construct";
		
		$result = mysqli_query($conn,$query);
		$result1 = mysqli_query($conn,$query1);
		
		$num= mysqli_num_rows($result);
		$num1 = mysqli_num_rows($result1);
		
		if($num>0){
			while($row = mysqli_fetch_array($result)){
				$output[] = $row;
			}
			echo json_encode(array($output,ceil($num1/$record_per_page)));
			
		}
		else{
			echo "";
		}
	}
	else if($search_category == 'Users'){
		
		$record_per_page= 50;
		$start_from = ($page - 1)*$record_per_page;
		
		$query ="SELECT * FROM users where $construct AND userId!='$search_id' LIMIT $start_from,$record_per_page";
		$query1 ="SELECT * FROM users where $construct AND userId!='$search_id'";
		
		$result = mysqli_query($conn,$query);
		$result1 = mysqli_query($conn,$query1);
		
		$num= mysqli_num_rows($result);
		$num1 = mysqli_num_rows($result1);
		
		if($num>0){
			while($row = mysqli_fetch_array($result)){
				$output[] = $row;
			}
			echo json_encode(array($output,ceil($num1/$record_per_page)));
			
		}
		else{
			echo "";
		}
	}
	else{
		
		$record_per_page= 3;
		$start_from = ($page - 1)*$record_per_page;
		
		$query="SELECT p.num_comment,p.num_likes,p.ID,p.post_Content,p.image,Profile_Pic,date_time,Username,Email from users join (select * from posts where $construct) as p where p.author_id = UserId LIMIT $start_from,$record_per_page";
		$query1 ="SELECT * from users join (select * from posts where $construct) as p where p.author_id = UserId";
		
		$result = mysqli_query($conn,$query);
		$result1 = mysqli_query($conn,$query1);
		
		$num= mysqli_num_rows($result);
		$num1 = mysqli_num_rows($result1);
		
		if($num>0){
			while($row = mysqli_fetch_array($result)){
				$output[] = $row;
			}
			echo json_encode(array($output,ceil($num1/$record_per_page)));
			
		}
		else{
			echo "";
		}
	}
	
	}
?>