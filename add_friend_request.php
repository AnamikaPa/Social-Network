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
	
	if($_POST['request'] == 'send'){
		//echo $_POST['o_id'];
		//echo $_POST['d_id'];
		$abc = mysqli_query($conn,"insert into friend_request(sender_id,receiver_id) values('$_POST[o_id]','$_POST[d_id]')");
	
		if($abc){
			echo "done";
		}else{
			echo "Error!";
		}
	}
	else if($_POST['request']=='cancel') {
		$abc = mysqli_query($conn,"delete from friend_request where sender_id='$_POST[o_id]' and receiver_id='$_POST[d_id]'");
		if($abc){
			echo "done";
		}else{
			echo "Error!";
		}
	}
	else if($_POST['request']=='accept'){
		$a = mysqli_query($conn,"delete from friend_request where sender_id='$_POST[d_id]' and receiver_id='$_POST[o_id]'");
		$b = mysqli_query($conn,"insert into friends(user_id,friend_id) values('$_POST[o_id]','$_POST[d_id]')");
		$c = mysqli_query($conn,"insert into friends(user_id,friend_id) values('$_POST[d_id]','$_POST[o_id]')");
		
		if($a && $b && $c){
			echo "done";
		}
		else{
			echo "Error!";
		}
	}
	else if($_POST['request']=='reject'){
		$a = mysqli_query($conn,"delete from friend_request where sender_id='$_POST[d_id]' and receiver_id='$_POST[o_id]'");
		if($a){
			echo "done";
		}
		else{
			echo "Error!";
		}
	}
	else{
		$a = mysqli_query($conn,"delete from friends where user_id='$_POST[d_id]' and friend_id='$_POST[o_id]'");
		$b = mysqli_query($conn,"delete from friends where friend_id='$_POST[d_id]' and user_id='$_POST[o_id]'");
		if($a && $b){
			echo "done";
		}
		else{
			echo "Error!";
		}
	}
?>