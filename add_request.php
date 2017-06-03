<?php
	session_start();
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
	$request = mysql_real_escape_string($data->request);
	$o_id = mysql_real_escape_string($data->o_id);
	$d_id = mysql_real_escape_string($data->d_id);
	
	
	if($request == 'send'){
		//echo $o_id;
		//echo $d_id;
		$abc = mysqli_query($conn,"insert into friend_request(sender_id,receiver_id) values('$o_id','$d_id')");
	
		if($abc){
			echo "done";
		}else{
			echo "Error!";
		}
	}
	else if($request=='cancel') {
		$abc = mysqli_query($conn,"delete from friend_request where sender_id='$o_id' and receiver_id='$d_id'");
		if($abc){
			echo "done";
		}else{
			echo "Error!";
		}
	}
	else if($request=='accept'){
		$a = mysqli_query($conn,"delete from friend_request where sender_id='$d_id' and receiver_id='$o_id'");
		$b = mysqli_query($conn,"insert into friends(user_id,friend_id) values('$o_id','$d_id')");
		$c = mysqli_query($conn,"insert into friends(user_id,friend_id) values('$d_id','$o_id')");
		
		if($a && $b && $c){
			echo "done";
		}
		else{
			echo "Error!";
		}
	}
	else if($request=='reject'){
		$a = mysqli_query($conn,"delete from friend_request where sender_id='$d_id' and receiver_id='$o_id'");
		if($a){
			echo "done";
		}
		else{
			echo "Error!";
		}
	}
	else{
		$a = mysqli_query($conn,"delete from friends where user_id='$d_id' and friend_id='$o_id'");
		$b = mysqli_query($conn,"delete from friends where friend_id='$d_id' and user_id='$o_id'");
		if($a && $b){
			echo "done";
		}
		else{
			echo "Error!";
		}
	}
?>