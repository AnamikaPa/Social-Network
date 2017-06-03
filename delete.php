<?php
	$host='localhost';
	$user='root';
	$pass='';
	$db='social_network';
	session_start();

	// Create connection
	$conn = new mysqli($host,$user,$pass,$db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$id = $_GET['text2'];
	
	$query = mysqli_query($conn,"delete from comments where post_id = '$id'");
	$query2 = mysqli_query($conn,"delete from posts where ID = '$id'");
	$query3 = mysqli_query($conn,"delete from like_unlike where post_id = '$id'");
	
	if($query && $query2){
		echo "Successfully Deleted";
		header("Location: user_page.php?text1=".$_GET['text1']."&text2=1");
	}
	else{
		echo "Error";
		header("Location: user_page.php?text1=".$_GET['text1']."&text2=2");
	}
?>