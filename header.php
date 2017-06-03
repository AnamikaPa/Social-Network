<html>

<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" /><!-- fontawesome -->     
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" /><!-- Bootstrap stylesheet -->
<link href="css/style1.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />

 <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script src="js/angular.min.js"></script>

<!-- stylesheet -->
</html>

<?php
	$host='localhost';
	$user='root';
	$pass='';
	$db='social_network';

	// Create connection
	$con = new mysqli($host,$user,$pass,$db);
	// Check connection
	if ($con->connect_error) {
		die("Connection failed: " . $cnn->connect_error);
	} 

?>