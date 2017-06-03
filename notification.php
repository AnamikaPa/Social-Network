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
	
	$search_id = mysql_real_escape_string($data->search_id);
	
	echo $search_id;
	
	
	echo "Hello pagal"
	
	
	if(!isset($data->search_page)){
		$page=1;
	}
	else{
		$page=mysql_real_escape_string($data->search_page);
	}
	
		$record_per_page= 3;
		$start_from = ($page - 1)*$record_per_page;
		
		$query ="select * from notifications join (SELECT * FROM friend_request WHERE receiver_id='$search_id') as p where p.sender_id = UserId LIMIT $start_from,$record_per_page";
		$query1 ="select * from users notifications (SELECT * FROM friend_request WHERE receiver_id='$search_id') as p where p.sender_id = UserId";
		
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
			echo json_encode(array('',0));
		}
		
?>