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
	
	$info = getimagesize($_FILES['file']['tmp_name']);
		if ($info === FALSE) {
			die("Unable to determine image type of uploaded file");
		}

		if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
			die("Not a gif/jpeg/png");
		}
		
				$image_name=$_FILES['file']['name'];
				$image_type=$_FILES['file']['type'];
				$image_size=$_FILES['file']['size'];
				$image_tmp_name=$_FILES['file']['tmp_name'];
				
				if($image_name=='' && $image_size==false){
					echo "Error";
				}
				else{
					move_uploaded_file($image_tmp_name,"images/$image_name");
				}
	if($_POST['pic_type'] == 'profile_pic'){
		$rslt = mysqli_query($conn,"update users set profile_pic = '$image_name' where email='$_POST[email]'");
		if($rslt){
			echo "image uploaded... :)";
		}
		else{
			echo "Error";
		}
	}
	else{
		$rslt = mysqli_query($conn,"update users set cover_pic = '$image_name' where email='$_POST[email]'");
		if($rslt){
			echo "image uploaded... :)";
		}
		else{
			echo "Error";
		}
	}
	//header("Location: user_page.php?text1=".$_POST['email']);

?>