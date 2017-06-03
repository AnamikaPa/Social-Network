<?php  
	$host='localhost';
	$user='root';
	$pass='';
	$db='social_network';

	// Create connection
	$connect = new mysqli($host,$user,$pass,$db);
	// Check connection
	if ($connect->connect_error) {
		die("Connection failed: " . $connect->connect_error);
	} 
	$a = mysqli_query($connect,"select * from posts where ID='$_POST[post_id]'");
	
	$row=mysqli_fetch_array($a);
	$comment = $row['num_comment'] +1;
	$b = mysqli_query($connect,"update posts set num_comment = '$comment' where ID='$_POST[post_id]'");

	$query = mysqli_query($connect,"Insert into comments(post_id,content,author_id,date_time) values('$_POST[post_id]','$_POST[Message]','$_POST[author_id]',now())");
	
	if($query && $b){
		echo "done";
	}
	else echo "Error";
?>