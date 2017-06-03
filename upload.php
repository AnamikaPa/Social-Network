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
	
	if(!empty($_FILES))  
	{  
		$path = 'images/' . $_FILES['file']['name'];  
		
		$info = getimagesize($_FILES['file']['tmp_name']);
		if ($info === FALSE) {
			die("Unable to determine image type of uploaded file");
		}

		if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
			die("Not a gif/jpeg/png");
		}
		
		if(move_uploaded_file($_FILES['file']['tmp_name'], $path))  
		{  
	
			$query = mysqli_query($connect,"SELECT * from users where UserId ='$_POST[author_id]' limit 1");
			$row=mysqli_fetch_array($query);
			
			$con = $row['Username']." ".$row['Email']." ".$_POST['content']." ".$_FILES['file']['name']." ".'now()';
			
			$insertQuery = "INSERT INTO posts(Content,post_Content,image,author_id,date_time) VALUES ('$con','$_POST[content]','".$_FILES['file']['name']."','$_POST[author_id]',now())";  
			if(mysqli_query($connect, $insertQuery)){  
                echo 'File Uploaded';  
			}  
			else{  
                echo 'File Uploaded But not Saved';  
			}  
		}  
	}  
	else{  
		echo 'Some Error';  
	}  
	
	
 ?> 