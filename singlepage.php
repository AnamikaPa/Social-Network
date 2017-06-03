
<!DOCTYPE html>
<html lang="en" ng-app = "myApp">
<head>
<title>Social Network</title>    


<?php include "header.php";
	session_start();
	if(isset($_SESSION['email']) && $_SESSION['email']!=''){
 ?>
 
<script>
var app = angular.module('myApp',[]);
	app.controller('cntrl',function($scope,$http){
		$scope.search = function(){
			if($scope.search_category!='Posts'){
				$http.post("search.php",{'search_id':$scope.search_id,'search_text':$scope.keywords,'search_category':$scope.search_category})
				.success(function(data){
					$scope.data1='';
					$scope.data2='';
					if(data!=''){
						$scope.data1 = data;
					}
					else $scope.data1 = '';
				});
			}
			else{
				$http.post("search.php",{'search_id':$scope.search_id,'search_text':$scope.keywords,'search_category':$scope.search_category})
				.success(function(data){
					$scope.data1='';
					$scope.data2='';
					if(data!=''){
						$scope.data2 = data;
					}
					else $scope.data2 = '';
				});
			}
		};
		
		
		$scope.find_frnd_reqst = function(){
			$http.post("find_friend_request.php",{'search_id':$scope.search_id})
			.success(function(data){
				$scope.data3='';
				if(data!=''){
					var range = [];
						for(var i=1;i<=data[1];i++) {
							range.push(i);
						}
						$scope.range = range;
					$scope.data3 = data;
				}
				else $scope.data3 = '';
			});
		}
		$scope.find_frnd_reqst1 = function(data){
			$http.post("find_friend_request.php",{'search_page':data,'search_id':$scope.search_id})
			.success(function(data){
				$scope.data3='';
				if(data!=''){
					var range = [];
						for(var i=1;i<=data[1];i++) {
							range.push(i);
						}
						$scope.range = range;
					$scope.data3 = data;
				}
				else $scope.data3 = '';
			});
		}
		
		$scope.friend_request = function(data1,data2,data3){
			$http.post("add_request.php",{'request':data1,'o_id':data2,'d_id':data3})
			.success(function(data){
				if(data=="done") {
					$scope.find_frnd_reqst();
				}else{
					alert(data);
				}
			});
		}
	});
	
	app.directive("fileInput", function($parse){  
      return{  
           link: function($scope, element, attrs){  
                element.on("change", function(event){  
                     var files = event.target.files;  
                     //console.log(files[0].name);  
                     $parse(attrs.fileInput).assign($scope, element[0].files);  
                     $scope.$apply();  
                });  
           }  
      }  
 });

</script>
 
 <style>
	#line{
		display:inline-block;
	}
 </style>
 
 
<!-- stylesheet -->
<!-- meta tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Blog Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //meta tags -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script src="js/main.js"></script>
<!-- Required-js -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->

<!-- scriptfor smooth drop down-nav -->
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>

<?php
	$email= $_GET['text1'];
	$post_id =$_GET['text2'];

	//echo $email;
	$query = " SELECT * FROM users WHERE Email = '$_SESSION[email]' limit 1"; 
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);

	$query = " SELECT * FROM users WHERE Email = '$email' limit 1"; 
	$result = mysqli_query($con,$query);
	$row2 = mysqli_fetch_array($result);

?>
<!-- //script for smooth drop down-nav -->
</head>
<body ng-controller="cntrl">
	<header style="height:65px; background-color:#00008B">
		
			<div class="container">
				<div style="margin-left:0px;  width:30%; margin-bottom:20px; dsplay:inline;" class="logo">
					<a href=<?php echo "main.php?text1=".$_SESSION['email']; ?>><img style="height:65px; width:65px;" src="images/logo.png" /></a>
						<div style="margin-left:80px; width:200px;" >
							<div style="width:40px; margin-left:80%; margin-top:-50px;" class="cd-main-header">
								<a class="cd-search-trigger" href="#cd-search"> <span></span></a>
							</div>
							<div id="cd-search" class="cd-search">
								<form action="{{ 'search_page.php?text1='+search_id+'&text2='+search_category+'&text3='+keywords }}" method="post">
									<div id="cd-search-category">
										<div> <input ng-change="search()" ng-model="search_category" ng-value="'Friends'" type="radio" name="search-category"  checked required> Friends</div>
										<div> <input ng-change="search()" ng-model="search_category" ng-value="'Users'" type="radio" name="search-category" > Users<br> </div>
									    <div> <input ng-change="search()" ng-model="search_category" ng-value="'Posts'" type="radio" name="search-category" > Posts </div>
									</div>
									<input type="hidden" ng-init="search_id='<?php echo $row['UserId']; ?>'" />
									<input style="color:white;" id="cd-search-bar" name="Search" ng-minlength="1" ng-model="keywords" ng-change="search()" type="text" placeholder="Is it me you’re looking for?" required />
								</form>
							</div>
						</div>
						<script>
						$(".cd-search-trigger").click(function(){
							if( $("#after-search").is(':visible') == false){
								$("#after-search").show();
							}else{
								$("#after-search").hide();
							}
						});
						</script>
						
						<div class="dropdown">
				<button class="dropbtn">v</button>
				<div class="dropdown-content">
					<a href="logout.php">Log Out</a>
				</div>
			</div>
		
			<div style="margin-left:260%; margin-top:-230px; color:white; margin-bottom:-15px;"> 
				<input id="email" type="hidden" value=<?php echo $_SESSION['email']; ?> />
				<img id="rb" style="height:65px; width:65px;" src=<?php echo "images/".$row['Profile_Pic']; ?> alt=" " />
			</div>
			
			<input  ng-init="search_id='<?php echo $row['UserId']; ?>'" ng-click="find_frnd_reqst()" id="frnd_request" style="margin-top:-100px; margin-left:237%; width:50px; height:50px;" type="image" src="images/request.jpg" alt="Submit" />
		
		<script>
			$("#rb").click(function(){
				var email = $("#email").val();
				window.location.href="user_page.php?text1="+email;
			});		
		</script>
	</header>
	<div id="frnd_request_dialog" style="z-index:1000; padding:5px 10px; position:absolute; background-color:#111b63; width:40%; margin-left:30%; margin-top:50px; min-height: 30%; ">
		<div style="text-align:center; border-radius:5px; width:30%; margin:10px auto; background-color:white; height:30px; padding:5px; color:black;">
			Friend Requests
		</div>
		<div ng-if="data3[1]==0" style="background-color:#021f91; opacity:0.8; color:white; margin:auto; width:40%; padding:10px;"> No Friend Request Pending </div> 
		<div ng-if="data3[1]!=0">
					<div ng-repeat="doc in data3[0]"   style="border-top: solid 1px white; border-bottom: solid 1px white; height: 50px;">
						<div id="line" style="width:60%;">
							<a style=" display:block; padding:15px 30px; color:white; width:60%; " ng-href="user_page.php?text1={{ doc.Email }}" >
								{{ doc.Username }}
							</a>
						</div>
						<div id="line" style="width:0px" ng-init="o_id=doc.receiver_id;d_id={{ doc.sender_id }}"></div>
						<div id="line" style="width:15%; margin-left:-20px;">
							<form ng-submit="friend_request('accept',doc.receiver_id,doc.sender_id)" style='width:500px; margin-left:50px; margin-top:-130px; position:relative;'>
								<input name="send_frnd_reqst_submit" style="margin-left:5px; width:80px; background-color:white; color:black; padding:5px; border-radius:4px;" type="submit" value="Accept" title="Accept" />
							</form>
						</div>
						
						<div id="line" style="width:15%;">
							<form ng-submit="friend_request('reject',doc.receiver_id,doc.sender_id)" style='width:500px; margin-left:50px; margin-top:-130px; position:relative;'>
								<input name="send_frnd_reqst_submit" style="margin-left:5px; width:80px; background-color:white; color:black; padding:5px; border-radius:4px;" type="submit" value="Reject" title="Reject" />
							</form>
						</div>
					</div>
				<form ng-init="page=1;"style="display:inline-block; margin-left:3px;" id="page" ng-repeat="n in range" method="post" >
					<input type="Submit" ng-model="page" ng-value='{{ n }}' name="page" ng-click="find_frnd_reqst1(n)" />
				</form>
		</div>			
	</div>
	
	<script>
			$("#frnd_request_dialog").hide();
			$("#frnd_request").click(function(){
				if( $("#frnd_request_dialog").is(':visible') == false){
					$("#frnd_request_dialog").show();
				}else{
					$("#frnd_request_dialog").hide();
				}
			});
	</script>
	
	<div id="after-search">
		<div id="search-result"  ng-if="keywords!=''" ng-repeat ="doc in data1.slice(0,5)" >
			<a style="background-color:white; border-radius:5px;" ng-href="user_page.php?text1={{ doc.Email }}">
				<button style="width:100%; border-radius:5px; padding:5px; background-color:white;">{{ doc.Username }}</button>
			</a>
		</div>
		<div id="search-result"  ng-if="keywords!=''" ng-repeat ="doc in data2.slice(0,5)" >
			<a style="background-color:white; border-radius:5px;" ng-href="singlepage.php?text1={{ doc.Email }}&text2={{ doc.ID }}">
				<button style="width:100%; border-radius:5px; padding:5px; background-color:white;">{{ doc.post_Content.substr(0,40); }}</button>
			</a>
		</div>
	</div>
	
	<script>
			$("#after-search").hide();
	</script>
	
	<?php
		$query = mysqli_query($con,"select * from posts where id='$post_id'");
		$post = mysqli_fetch_array($query);
		
		$query = mysqli_query($con,"select * from users where userid = '$post[author_id]'");
		$author = mysqli_fetch_array($query);
		
		$type = -1;

    // Checking user status
    $status_query = "SELECT count(*) as cntStatus,type FROM like_unlike WHERE userid=".$row['UserId']." and postid=".$post['ID'];
    $status_result = mysqli_query($con,$status_query);
    $status_row = mysqli_fetch_array($status_result);
    $count_status = $status_row['cntStatus'];
    if($count_status > 0){
      $type = $status_row['type'];
    }

    // Count post total likes and unlikes
    $like_query = "SELECT COUNT(*) AS cntLikes FROM like_unlike WHERE type=1 and postid=".$post['ID'];
    $like_result = mysqli_query($con,$like_query);
    $like_row = mysqli_fetch_array($like_result);
    $total_likes = $like_row['cntLikes'];

    $unlike_query = "SELECT COUNT(*) AS cntUnlikes FROM like_unlike WHERE type=0 and postid=".$post['ID'];
    $unlike_result = mysqli_query($con,$unlike_query);
    $unlike_row = mysqli_fetch_array($unlike_result);
    $total_unlikes = $unlike_row['cntUnlikes'];
		
		
	?>
	
	<script>
	$(document).ready(function(){

    // like and unlike click
    $(".like, .unlike").click(function(){
        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var postid = split_id[1];  // postid
		var userid = split_id[2];

        // Finding click type
        var type = 0;
        if(text == "like"){
            type = 1;
        }else{
            type = 0;
        }

        // AJAX Request
        $.ajax({
            url: 'like_unlike.php',
            type: 'post',
            data: {userid:userid,postid:postid,type:type},
            success: function(data){
				data = JSON.parse(data);
                var likes = data['likes'];
                var unlikes = data['unlikes'];
				var status = data['status'];

				if(status == 1){
					$("#liked").text("You Liked this Post");
				}else{
					$("#liked").text("You Unliked this Post");
				}
				
                $(".a").text(likes);        // setting likes
                $(".b").text(unlikes);    // setting unlikes

                if(type == 1){
                    $("#like_"+postid+"_"+userid).css("background-color","grey");
					$("#like_"+postid+"_"+userid).css("color","white");
					$("#unlike_"+postid+"_"+userid).css("background-color","white");
					$("#unlike_"+postid+"_"+userid).css("color","black");
                }

                if(type == 0){ 
					$("#unlike_"+postid+"_"+userid).css("background-color","grey");
					$("#unlike_"+postid+"_"+userid).css("color","white");
					$("#like_"+postid+"_"+userid).css("background-color","white");
					$("#like_"+postid+"_"+userid).css("color","black");
                }
            }
        });

    });

});
	</script>
	
	
	
<!-- //breadcrumbs -->
	<div class="container">
		<div class="banner-btm-agile">
		<!-- //btm-wthree-left -->
			<div class="col-md-9 btm-wthree-left">
				<div class="single-left">
				<div class="single-left1">
					<div style="margin-left:-80px;" class="comments-grid-left">
						<a style="margin:auto;"href=<?php echo "user_page.php?text1=".$author['Email']; ?>><?php echo $author['Username']; ?></a>
						<a href=<?php echo "user_page.php?text1=".$author['Email']; ?>>
							<img style="height:80px; width:80px;"src=<?php echo "images/".$author['Profile_Pic']; ?> alt=" " class="img-responsive" />
						</a>
					</div>
								
					<div style=" height:450px; background-color:#d9d9db;"  class="w3agile_special_deals_grid_left_grid">
						<img style=" height:100%; margin:auto;" src=<?php echo "images/".$post['image']; ?> class="img-responsive" alt="" />
					</div>
					<p><?php echo $post['post_Content']; ?></p>
				</div>
				
				<?php 
					$result = mysqli_query($con,"select * from like_unlike where userid='$row[UserId]' and postid='$post[ID]'");
					$like_unlike = mysqli_fetch_array($result);
					$num = mysqli_num_rows($result);
					$liked =  $like_unlike['type'];
					
					if($liked ==1 && $num!=0){
				?> <div id="liked" style="margin:auto; width:20%; padding:5px;"> You Liked this post </div>
				<?php }else if($liked == 0 && $num!=0){ ?>
					<div id="liked" style="margin:auto; width:20%; padding:5px;"> You Unliked this post </div>
				<?php } ?>
				
				<div  style="width:27%; margin:auto; margin-bottom:5px;"class="post-action">
					
					<input style="<?php if($liked == 1 && $num!=0){ echo "background-color:grey;"; } else{ echo "background-color:white;"; }  ?> padding:5px; width:70px; border-radius:5px;" type="button" value="Like" id="like_<?php echo $post['ID']; ?>_<?php echo $row['UserId']; ?>" class="like" style="<?php if($type == 1){ echo "color: #ffa449;"; } ?>" />
						&nbsp;(<span class="a"><?php echo $total_likes; ?></span>)&nbsp;
					<input style="<?php if($liked == 0 && $num!=0){ echo "background-color:grey;"; } else{ echo "background-color:white;"; } ?> padding:5px; width:70px; border-radius:5px;" type="button" value="Unlike" id="unlike_<?php echo $post['ID']; ?>_<?php echo $row['UserId']; ?>" class="unlike" style="<?php if($type == 0){ echo "color: #ffa449;"; } ?>" />
						&nbsp;(<span class="b"><?php echo $total_unlikes; ?></span>)
				</div
				
				<div class="comments">
					<h3>Our Recent Comments</h3>
					<div  class="comments-grids">
							
							<?php 
								$record_per_page =5;
								if(isset($_POST["page"])){  
									$page = $_POST["page"];  
								}  
								else{  
									$page = 1;  
								}
					
								$start_from = ($page - 1)*$record_per_page;  
											
								$query = mysqli_query($con,"SELECT * FROM `comments` JOIN users where author_id = userid and post_id = '$post[ID]' order by date_time asc LIMIT $start_from,$record_per_page");
								$num = mysqli_num_rows($query);
							
								if($num==0){
									?> <p align="center"> No Comments till now </p> <?php
								}
								else{
									while($comment = mysqli_fetch_array($query)){
								?>
									<div style="margin-top:10px;" class="comments-grid">
										<div class="comments-grid-left">
											<a href=<?php echo "user_page.php?text1=".$comment['Email']; ?>>
												<img style="height:80px; width:80px;"src=<?php echo "images/".$comment['Profile_Pic']; ?> alt=" " class="img-responsive" />
											</a>
										</div>
										<div class="comments-grid-right">
											<h4><a href=<?php echo "user_page.php?text1=".$comment['Email']; ?>>
												<?php echo $comment['Username']; ?></a>
											</h4>
											<ul>
												<li><?php echo $comment['date_time']; ?> </li>
											</ul>
											<p><?php echo $comment['content']; ?></p>
										</div>
										<div class="clearfix"> </div>
									</div>
							<?php } }
								$page_query = "SELECT * FROM `comments` JOIN users where author_id = userid and post_id = '$post[ID]'";  
								$page_result = mysqli_query($con, $page_query);  
								$total_records = mysqli_num_rows($page_result);  
								$total_pages = ceil($total_records/$record_per_page);
								for($i=1; $i<=$total_pages; $i++){  
								?>
									<form style="display:inline-block;" id="page" method="post" action=<?php echo "singlepage.php?text1=".$email."&text2=".$_GET['text2']; ?>>
										<input type="Submit" value=<?php echo $i; ?> name="page"/>
									</form>
								<?php
								}
							?>
					</div>
				</div>
				<div class="leave-coment-form">
					<h3>Leave Your Comment</h3>
					<form id="comment_form">
						<input type="hidden" value=<?php echo $row['UserId']; ?> name="author_id" >
						<input type="hidden" value=<?php echo $post['ID']; ?> name="post_id" >
						<textarea name="Message" placeholder="Your comment here..." required=""></textarea>
						<div class="w3_single_submit">
							<input name="submit" type="submit" value="Submit Comment" >
						</div>
					</form>
				</div>
				
				<script>
					$("#comment_form").submit(function(){
						var data = $("#comment_form").serialize();
						$.ajax({
							method:"post",
							url: "add_comment.php",
							data: data,
							success: function(data){
								if(data == "done"){
									location.reload();
								}
								else alert(data);
							}
						});
					});
				</script>
				
				
			</div>

			</div>
			<!-- //btm-wthree-left -->
				<!-- btm-wthree-right -->
			<div class="col-md-3 w3agile_blog_left">
				
				<div class="w3ls_popular_posts">
					<h3>Popular Posts</h3>
					
				<?php 
					$result = mysqli_query($con,"Select date_time,Username,image,Email,ID from posts join users where author_id = UserId order by num_likes desc limit 3");
					while($pop_re = mysqli_fetch_array($result)){
				?>
					<div class="agileits_popular_posts_grid">
						<div class="w3agile_special_deals_grid_left_grid">
							<a href=<?php echo "singlepage.php?text1=".$pop_re['Email']."&text2=".$pop_re['ID']; ?>>
								<img style=" height:150px; margin:auto;" src=<?php echo "images/".$pop_re['image']; ?> class="img-responsive" alt="" />
							</a>
						</div>
						<h4>
							<a href=<?php echo 'user_page.php?text1='.$pop_re['Email']; ?>>
								<?php echo $pop_re['Username']; ?>
							</a>
						</h4>
						<h5><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $pop_re['date_time']; ?></h5>
					</div>
				<?php } ?>
					
				</div>
				
			<div class="w3ls_recent_posts">
					<h3>Recent Posts</h3>
					
				<?php 
					$result = mysqli_query($con,"Select date_time,Username,image,Email,ID from posts join users where author_id = UserId and email!='$_SESSION[email]' order by date_time desc limit 3");
					while($pop_re = mysqli_fetch_array($result)){
				?>
					<div class="agileits_recent_posts_grid">
						<div class="agileits_recent_posts_gridl">
							<div class="w3agile_special_deals_grid_left_grid">
								<a href=<?php echo "singlepage.php?text1=".$pop_re['Email']."&text2=".$pop_re['ID']; ?>>
									<img style=" height:50px; margin:auto;" src=<?php echo "images/".$pop_re['image']; ?> class="img-responsive" alt="" />
								</a>
							</div>
						</div>
						<div class="agileits_recent_posts_gridr">
						<h4>
							<a href=<?php echo 'user_page.php?text1='.$pop_re['Email']; ?>>
								<?php echo $pop_re['Username']; ?>
							</a>
						</h4>

						<h5><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $pop_re['date_time']; ?></h5>
						</div>
						<div class="clearfix"> </div>
					</div>
				<?php } ?>
				</div>
			
			</div>
			<!-- //btm-wthree-right -->
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="footer-agile-info"></div>
	<div class="copyright">	</div>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/bootstrap.js"></script>
</body>
</html>
<?php }else {
	include "error_page.php";
}