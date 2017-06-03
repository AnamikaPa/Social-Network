<!DOCTYPE html>
<html lang="en" ng-app = "myApp">
<head>
<title>Social Network</title>   

<?php include "header.php"; 
session_start();
if(isset($_SESSION['email']) && $_SESSION['email']!=''){

?>

<script src="js/main.js"></script>
<!-- Required-js -->

<script>
var app = angular.module('myApp',[]);
	app.controller('cntrl',function($scope,$http,$window){
		$scope.search = function(){
				$http.post("search_page_ajax.php",{'search_id':$scope.search_id,'search_text':$scope.keywords,'search_category':$scope.search_category})
				.success(function(data){
					$scope.data1='';
					if(data!=''){	
						var range = [];
						for(var i=1;i<=data[1];i++) {
							range.push(i);
						}
						$scope.range = range;
						$scope.data1 = data;
					}
					else{
						$scope.data1 = '';
						$scope.range = '';
					}
				});
		};
		$scope.search1 = function(data){
				$http.post("search_page_ajax.php",{'search_page':data,'search_id':$scope.search_id,'search_text':$scope.keywords,'search_category':$scope.search_category})
				.success(function(data){
					$scope.data1='';
					if(data!=''){	
						var range = [];
						for(var i=1;i<=data[1];i++) {
							range.push(i);
						}
						$scope.range = range;
						$scope.data1 = data;
					}
					else{
						$scope.data1 = '';
						$scope.range = '';
					}
				});
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
	  
	
</script>

<style>
	#search_profile{
		display:inline-block;
	}
</style>

<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		var s = document.URL;
		var email,idx = s.indexOf('?text1=');
		if (idx !== -1) {
			email = s.substring(50,s.length);
		}
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
						
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});
		});
</script>	

<?php
	$email = $_SESSION['email'];
	$query = " SELECT * FROM users WHERE Email = '$email' limit 1"; 
	$result = mysqli_query($con,$query);
	$num= mysqli_num_rows($result);
	
	$row = mysqli_fetch_array($result);
?>

<!-- //main slider-banner --> 
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
<!-- //script for smooth drop down-nav -->
<style>
	#line{
		display: inline-block;
	}
</style>

</head>
<body ng-controller="cntrl">

<?php
	$search_id = $_GET['text1'];
	$search_category = $_GET['text2'];
	$search_text = $_GET['text3'];
?>


<!-- header -->
	<header ng-init="search_id='<?php echo $_GET['text1']; ?>';search_category='<?php echo $_GET['text2'];?>';keywords='<?php echo $_GET['text3'];?>'; search();"  style="height:65px; background-color:#00008B">
		
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
	
	<!-- //top-header and slider -->
	<div style="z-index=0;"class="container" >
		<div style="margin-top:50px;" class="col-md-9 btm-wthree-left">
				
			
			<div  ng-if="search_category == 'Posts'">
				<div style=" margin-top:100px;" ng-repeat ="doc in data1[0]" class="wthree-top">
					<div class="w3agile-top">
						<div style="height:450px; background-color:#d9d9db;"  class="w3agile_special_deals_grid_left_grid">
							<a ng-href="singlepage.php?text1={{ doc.Email }}&text2={{ doc.ID }}">
								<img style=" height:100%; margin:auto; z-index:0;" ng-src="images/{{ doc.image }}" class="img-responsive" alt="" />
							</a>
						</div>
						<div class="w3agile-middle">
						<ul>
							<li><i class="fa fa-calendar" aria-hidden="true"></i>{{ doc.date_time }}</li>
							<li><a ng-href="singlepage.php?text1={{ doc.Email }}&text2={{ doc.ID }}"><i class="fa fa-thumbs-up" aria-hidden="true"></i>{{ doc.num_likes }} LIKES</a></li>
							<li><a ng-href="singlepage.php?text1={{ doc.Email }}&text2={{ doc.ID }}"><i class="fa fa-comment" aria-hidden="true"></i>{{ doc.num_comment }} COMMENTS</a></li>
						</ul>
					</div>
					</div>
					
					<div  class="w3agile-bottom">
					<a ng-href="user_page.php?text1={{ doc.Email }}">
						<div class="col-md-3 w3agile-left">
							<h5>{{ doc.Username }}</h5>
							<div class="comments-grid-left">
								<img style="height:80px; width:80px;" ng-src="images/{{ doc.Profile_Pic }}" alt=" " />
							</div>
						</div>
					</a>
						
						<div style="word-wrap: break-word;" class="col-md-9 w3agile-right">
							<p ng-if="doc.Content.length >100">
								{{ doc.post_Content.substr(0,100) }}...
							</p>
							<p ng-if="doc.Content.length <=100">
								{{ doc.post_Content }}
							</p> 
							<a class="agileits w3layouts" ng-href="singlepage.php?text1={{ doc.Email }}&text2={{ doc.ID }}">Read More </a>
						</div>
							<div class="clearfix"></div>
					</div>
				</div>
				
				<form ng-init="page=1;"style="display:inline-block; margin-left:3px;" id="page" ng-repeat="n in range" method="post" >
					<input type="Submit" ng-model="page" ng-value='{{ n }}' name="page" ng-click="search1(n)" />
				</form>
			</div>
			
			
			<div ng-if="search_category != 'Posts'">
			<div>
				<div style="display:inline-block; margin-top:0px;" ng-repeat ="doc in data1[0]" class="wthree-top">
					<div  class="w3agile-bottom">
					<a ng-href="user_page.php?text1={{ doc.Email }}">
						<div class="col-md-3 w3agile-left">
							<div class="comments-grid-left">
								
									<img style="height:80px; width:80px;" ng-src="images/{{ doc.Profile_Pic }}" alt=" " />
								
							</div>
							<div>
								<h5>{{ doc.Username }}</h5>
							</div>
						</div>
					</a>
						<div class="col-md-9 w3agile-right">
						</div>
							<div class="clearfix"></div>
					</div>
				</div>
			</div>
				<form  ng-init="page=1;" style="display:inline-block; margin-left:3px;" id="page" ng-repeat="n in range" method="post" >
					<input type="Submit" ng-model="page" ng-value='{{ n }}' name="page" ng-click="search1(n)"/>
				</form>
				
			</div>
		</div>
		
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
			$("#send_frnd_reqst").submit(function(){
				var data = $("#send_frnd_reqst").serialize();
				$.ajax({
					method:"post",
					url:"add_friend_request.php",
					data: data,
					success:function(data){
						if(data=="done"){
							location.reload();
						}else alert(data);
					}
				});
			});
			$("#send_frnd_reqst1").submit(function(){
				var data = $("#send_frnd_reqst1").serialize();
				$.ajax({
					method:"post",
					url:"add_friend_request.php",
					data: data,
					success:function(data){
						if(data=="done"){
							location.reload();
						}else alert(data);
					}
				});
			});
		</script>
		
		
		
		<div class="banner-btm-agile">
		<!-- //btm-wthree-left -->
			
			<!-- //btm-wthree-left -->
				<!-- btm-wthree-right -->
			<div class="col-md-3 w3agile_blog_left">
				
				<div class="w3ls_popular_posts">
					<h3>Popular Posts</h3>
					
				<?php 
					$result = mysqli_query($con,"Select date_time,Username,image,Email,ID from posts join users where author_id = UserId order by num_likes desc limit 5");
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