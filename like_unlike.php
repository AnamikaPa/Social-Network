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

$userid = $_POST['userid'];
$postid = $_POST['postid'];
$type = $_POST['type'];

/*
$query = "SELECT * FROM like_unlike WHERE postid=".$postid." and userid=".$userid;
$result = mysqli_query($conn,$query);
$user = mysqli_fetch_array($result);
*/

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM like_unlike WHERE postid=".$postid." and userid=".$userid;
$result = mysqli_query($conn,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];

if($count == 0){
    $insertquery = "INSERT INTO like_unlike(userid,postid,type) values(".$userid.",".$postid.",".$type.")";
	$status = -1;
    mysqli_query($conn,$insertquery);
	
	$insertquery = "INSERT INTO like_unlike(userid,postid,type) values(".$userid.",".$postid.",".$type.")";
	$status = -1;
    mysqli_query($conn,$insertquery);
	
	
}else {
    $updatequery = "UPDATE like_unlike SET type=" . $type . " where userid=" . $userid . " and postid=" . $postid;
	$status=$type;
    mysqli_query($conn,$updatequery);
}

$updatequery = "SELECT COUNT(*) as c from like_unlike where type=1 and postid = '$postid'";
$result = mysqli_query($conn,$updatequery);
$row = mysqli_fetch_array($result);
 
mysqli_query($conn,"UPDATE posts set num_likes ='$row[c]' where ID ='$postid'");

// count numbers of like and unlike in post
$query = "SELECT COUNT(*) AS cntLike FROM like_unlike WHERE type=1 and postid=".$postid;
$result = mysqli_query($conn,$query);
$fetchlikes = mysqli_fetch_array($result);
$totalLikes = $fetchlikes['cntLike'];

$query = "SELECT COUNT(*) AS cntUnlike FROM like_unlike WHERE type=0 and postid=".$postid;
$result = mysqli_query($conn,$query);
$fetchunlikes = mysqli_fetch_array($result);
$totalUnlikes = $fetchunlikes['cntUnlike'];


// initalizing array
$return_arr = array("status"=>$status,"likes"=>$totalLikes,"unlikes"=>$totalUnlikes);

echo json_encode($return_arr);
?>