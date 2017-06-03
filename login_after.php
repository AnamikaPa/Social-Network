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
	
	
	if($_POST['action'] == "Registration"){
		if($_POST['radio']=="female") $gender = "Female";
		else $gender = 'Male';
		
		$encryp = sha1(md5($_POST['Password']));
		
		//$abc = mysqli_query($conn,"SELECT * FROM users WHERE BINARY Username='$_POST[Username]'");
		$def = mysqli_query($conn,"SELECT * FROM users WHERE BINARY Email='$_POST[Email]'");
		
		/*if(mysqli_num_rows($def)!=0){
			echo "This Username is already in use<br>";
		}*/
		if(mysqli_num_rows($def)!=0){
			echo "This Email is already in use";
		}
		else{
			$a = $_POST['Username']." ".$_POST['Email']." ".$gender;
			if($gender == 'Male')
				$sql = "INSERT INTO users(Username,Email,Password,Content,Gender,CreationDate,UpdatedDate,IsAdmin,Profile_Pic,Cover_Pic) 
				VALUES('$_POST[Username]','$_POST[Email]','$encryp','$a','$gender',CURDATE(),CURDATE(),0,'default_pic.jpg','default-cover.png')";
			else
				$sql = "INSERT INTO users(Username,Email,Password,Content,Gender,CreationDate,UpdatedDate,IsAdmin,Profile_Pic,Cover_Pic) 
				VALUES('$_POST[Username]','$_POST[Email]','$encryp','$a','$gender',CURDATE(),CURDATE(),0,'default_pic_girl.jpg','default-cover.png')";
			
			if ($conn->query($sql) === TRUE) {
				$_SESSION['register']="yes";
				$_SESSION['email'] = $_POST['Email'];
				echo "done";
			} else {
				echo "Error in Registration";
			}
		}
		
	}
	else{
			
			$encryp = sha1(md5($_POST['Password']));
			$abc = mysqli_query($conn,"SELECT * FROM users WHERE BINARY Email='$_POST[Email]' and BINARY Password = '$encryp'");
					
			if(mysqli_num_rows($abc)!=0){
				$row = mysqli_fetch_array($abc);
				$_SESSION['email'] = $_POST['Email'];
				echo "done";
			}
			else echo "Username and Password does not match";
	}
	$conn->close();
?>