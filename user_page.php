<!DOCTYPE html>
<html lang="en" ng-app = "myApp">
<head>
<title>Social Network</title>    

<?php include "header.php";
	session_start();
	if(isset($_SESSION['email']) && $_SESSION['email']!=''){

 ?>
 
<style>
	#line{
		display: inline-block;
	}
	.line{
		display:inline-block;
	}
	
	#page{
		display :inline-block;
	}
</style>

<script>
var app = angular.module('myApp',[]);
	app.controller('cntrl',function($scope,$http,$window){
		
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
		$scope.uploadFile = function(){  
			
			var form_data = new FormData();  
			angular.forEach($scope.files, function(file){  
                form_data.append('file', file);  
			});  
			form_data.append('author_id',$scope.author_id);
			form_data.append('content',$scope.content);
			$http.post('upload.php', form_data,  
			{  
                transformRequest: angular.identity,  
                headers: {'Content-Type': undefined,'Process-Data': false}  
			}).success(function(response){  
                alert(response);  
				$window.location.reload();
			});
		};

		$scope.uploadImage = function(){  
			
			var form_data = new FormData();  
			angular.forEach($scope.files, function(file){  
                form_data.append('file', file);  
			});  
			form_data.append('email',$scope.email);
			form_data.append('pic_type','profile_pic');
			$http.post('image_upload.php', form_data,  
			{  
                transformRequest: angular.identity,  
                headers: {'Content-Type': undefined,'Process-Data': false}  
			}).success(function(response){  
                alert(response);  
				$window.location.reload();
			});
		};

		$scope.uploadImage2 = function(){  
			
			var form_data = new FormData();  
			angular.forEach($scope.files, function(file){  
                form_data.append('file', file);  
			});  
			form_data.append('email',$scope.email);
			form_data.append('pic_type','cover_pic');
			$http.post('image_upload.php', form_data,  
			{  
                transformRequest: angular.identity,  
                headers: {'Content-Type': undefined,'Process-Data': false}  
			}).success(function(response){  
                alert(response);
				$window.location.reload();
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
 
<script src="js/main.js"></script>
<!-- Required-js -->

<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
						
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});
			
		});
</script>	
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
<?php
	$email = $_GET['text1'];
	
	$query = " SELECT * FROM users WHERE Email = '$_SESSION[email]' limit 1"; 
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);

	$query = " SELECT * FROM users WHERE Email = '$email' limit 1"; 
	$result = mysqli_query($con,$query);
	$row2 = mysqli_fetch_array($result);

?>
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


</head>
<body ng-controller="cntrl">
<!-- header -->
	<header style="height:65px; background-color:#00008B">
		
			<div class="container">
				<div style="margin-left:0px;  width:30%; margin-bottom:20px; dsplay:inline;" class="logo">
					<a href=<?php echo "main.php?text1=".$_SESSION['email']; ?>><img style="height:65px; width:65px;"src="images/logo.png" /></a>
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
	<h1 align="center"; style="margin-top:10px; margin-bottom:-5px;"> <?php echo $row2['Username']; ?> </h1>
	<hr />
	
	
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
	
	<?php if($_SESSION['email'] == $email){ ?>
	<div style="background-color:grey; width:50%; margin:10px auto; padding:10px; border-radius:5px; z-index:0;">
		<form style="margin:auto; " >
			<textarea ng-init="author_id='<?php echo $row['UserId']; ?>'" ng-model="content" style="width:100%; border-radius:5px; height:100px;" type="text" name="desc" placeholder="What's on your mind?" required></textarea>			
			<label>Upload Document </label>
			<input file-input="files" type="file" name="file" accept="image/jpeg,image/png,image/gif" id="image" required>
			<button type="submit" style="margin: 10px 45% 0px;" class="btn btn-default"  ng-click="uploadFile()" >Submit</button>
		</form>
	</div>
	<?php } ?>
	
	<!-- //top-header and slider -->
	<div style="margin-top:-40px;" class="container" >
		
		<div class="banner-btm-agile" >
		
		<div style="height:500px;  margin-top:-20px" >
			<div style="width:100px;" class="ctn">
				<?php $a = $row2['Profile_Pic'];
				echo "<img style='position:absolute; margin-left:-10px; height:300px; width:300px; border:solid black 1px;' id='cover-image' src='images/$a' alt='Profile Pic'>";
				
				if($_SESSION['email'] == $email){ ?>
				<form id="image_form" style="position:absolute; margin-left:-10px; height:30px; width:300px;" >
					<input  ng-init="email='<?php echo $email; ?>'; " file-input="files" id="def" type="file" name="file" accept="image/png,image/jpg,image/jpeg,image/gif" required>
					<input type="submit" value="Upload" ng-click="uploadImage()">
				</form>
				<?php } ?>
			</div>
			
			<div style="width:700px;" class="ctn">
				<?php $a = $row2['Cover_Pic'];
				echo "<img style='position:absolute; margin-left:20%;  height:400px; border:solid black 1px;' id='cover-image' src='images/$a' alt='Cover Pic' >";
				if($_SESSION['email'] == $email){ ?>
				<form id="image_form2" style="position:absolute; margin-left:20%; width:60%; height:400px;"  >
					<input ng-init="email='<?php echo $email; ?>';" file-input="files" id="abc" type="file" name="file" accept="image/png,image/jpg,image/jpeg,image/gif" required>
					<input type="submit" value="Upload" ng-click="uploadImage2()">
				</form>
				 <?php } ?>
			</div>
			
		</div>
		
		<div id="frnd_request">
		<?php 
			if($_SESSION['email'] != $email){
			$abc = mysqli_query($con,"select * from friend_request where sender_id='$row[UserId]' AND receiver_id = '$row2[UserId]'");
			$num = mysqli_num_rows($abc);
			
			$abc = mysqli_query($con,"select * from friend_request where sender_id='$row2[UserId]' AND receiver_id = '$row[UserId]'");
			$num2 = mysqli_num_rows($abc);
			
			$abc = mysqli_query($con,"select * from friends where user_id='$row[UserId]' AND friend_id = '$row2[UserId]'");
			$num3 = mysqli_num_rows($abc);
			
			if($num2!=0){
			?>
				<form class="line" id="send_frnd_reqst2" style='width:50px; margin-left:50px; margin-top:-200px; position:relative;'>
					<input type="hidden" value="accept" name="request" />
					<input type="hidden" value=<?php echo $row['UserId']; ?> name="o_id" />
					<input type="hidden" value=<?php echo $row2['UserId']; ?> name="d_id" />
					<input name="send_frnd_reqst_submit" style="background-color:#191970; width:100px; border-radius:8px; color:white; padding:10px; margin-top:-50px;" type="submit" value="Accept" />
				</form>
				<form class="line" id="send_frnd_reqst3" style='width:50px; margin-left:50px; margin-top:-200px; position:relative;'>
					<input type="hidden" value="reject" name="request" />
					<input type="hidden" value=<?php echo $row['UserId']; ?> name="o_id" />
					<input type="hidden" value=<?php echo $row2['UserId']; ?> name="d_id" />
					<input name="send_frnd_reqst_submit" style="background-color:#898b8c; width:100px; border-radius:8px; color:white; padding:10px; margin-top:-50px;" type="submit" value="Reject" />
				</form>
			<?php
			}
			else if($num3!=0){
			?>
				<form id="send_frnd_reqst" style='width:500px; margin-left:50px; margin-top:-130px; position:relative;'>
					<input type="hidden" value="unfriend" name="request" />
					<input type="hidden" value=<?php echo $row['UserId']; ?> name="o_id" />
					<input type="hidden" value=<?php echo $row2['UserId']; ?> name="d_id" />
					<input name="send_frnd_reqst_submit" style="background-color:#898b8c; width:100px;  border-radius:8px; color:white; padding:10px; margin-top:-0px;" type="submit" value="Friends" title="Unfriend" />
				</form>
			<?php
			}
			else if($num==0){
		?>
			<form id="send_frnd_reqst" style='width:500px; margin-left:50px; margin-top:-130px; position:relative;'>
				<input type="hidden" value="send" name="request" />
				<input type="hidden" value=<?php echo $row['UserId']; ?> name="o_id" />
				<input type="hidden" value=<?php echo $row2['UserId']; ?> name="d_id" />
				<input name="send_frnd_reqst_submit" style="background-color:#191970;  border-radius:8px; color:white; padding:10px; margin-top:-0px;" type="submit" value="Send Friend Request" />
			</form>
			
		<?php } else{ ?>
			<form id="send_frnd_reqst" style='width:500px; margin-left:50px; margin-top:-130px; position:relative;'>
				<input type="hidden" value="cancel" name="request" />
				<input type="hidden" value=<?php echo $row['UserId']; ?> name="o_id" />
				<input type="hidden" value=<?php echo $row2['UserId']; ?> name="d_id" />
				<input name="send_frnd_reqst_submit" style="background-color:#898b8c;  border-radius:8px; color:white; padding:10px; margin-top:-0px;" type="submit" value="Friend Request Sent" title="Want to cancel the request?" />
			</form>
			<?php } } ?>
		</div>

		<script>
			$("#send_frnd_reqst").submit(function(){
				friendRequest("#send_frnd_reqst");
			});
			$("#send_frnd_reqst1").submit(function(){
				friendRequest("#send_frnd_reqst1");
			});
			$("#send_frnd_reqst2").submit(function(){
				friendRequest("#send_frnd_reqst2");
			});
			$("#send_frnd_reqst3").submit(function(){
				friendRequest("#send_frnd_reqst3");
			});
			$("#send_frnd_reqst4").submit(function(){
				friendRequest("#send_frnd_reqst4");
			});
			
			function friendRequest(data1){
				var data = $(data1).serialize();
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
			}
		</script>
	
		<!-- //btm-wthree-left -->
			<div style="margin-top:50px;" class="col-md-9 btm-wthree-left">
			<div id="post_data">
				<?php
					$record_per_page =4;
					if(isset($_POST["page"])){  
						$page = $_POST["page"];  
					}  
					else{  
						$page = 1;  
					}
					
					$start_from = ($page - 1)*$record_per_page;  
				
					$query = "SELECT posts.post_content as con,num_comment,num_likes,ID,Username,Profile_Pic,image,date_time,email FROM posts join users WHERE author_id=userid and author_id = '$row2[UserId]' order by date_time desc LIMIT $start_from,$record_per_page"; 
					$result = mysqli_query($con,$query);
					$post_num = mysqli_num_rows($result);
					
					while($post_num>0 && $post = mysqli_fetch_array($result)){
				?>
				
				<div class="wthree-top">
					<div class="w3agile-top">
						<div style="height:450px; background-color:#d9d9db;"  class="w3agile_special_deals_grid_left_grid">
							<a href=<?php echo "singlepage.php?text1=".$email."&text2=".$post['ID']; ?>>
								<img style=" height:100%; margin:auto;" src=<?php echo "images/".$post['image']; ?> class="img-responsive" alt="" />
							</a>
						</div>
						<div class="w3agile-middle">
						<ul>
							<li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $post['date_time']; ?></li>
							<li><a href=<?php echo "singlepage.php?text1=".$email."&text2=".$post['ID']; ?>><i class="fa fa-thumbs-up" aria-hidden="true"></i><?php echo $post['num_likes'];?> LIKES</a></li>
							<li><a href=<?php echo "singlepage.php?text1=".$email."&text2=".$post['ID']; ?>><i class="fa fa-comment" aria-hidden="true"></i><?php echo $post['num_comment'];?> COMMENTS</a></li>
						</ul>
					</div>
					</div>
					
					<div class="w3agile-bottom">
						<div class="col-md-3 w3agile-left">
							<h5><?php echo $post['Username']; ?></h5>
							<div class="comments-grid-left">
								<a href=<?php echo 'user_page.php?text1='.$post['email']; ?>>
									<img style="height:80px; width:80px;" src=<?php echo "images/".$post['Profile_Pic']; ?> alt=" " />
								</a>
							</div>
						</div>
						<div class="col-md-9 w3agile-right">
							<p><?php echo $post['con']; ?></p>
							<a class="agileits w3layouts" href=<?php echo "singlepage.php?text1=".$email."&text2=".$post['ID']; ?>>Read More </a>
							
							<?php if($_SESSION['email']==$email){ ?>
								<a style="margin-left:30px;" class="agileits w3layouts" href=<?php echo "delete.php?text1=".$email."&text2=".$post['ID']; ?>>Delete </span></a>
							<?php } ?>
						</div>
							<div class="clearfix"></div>
					</div>
				</div>
				
				<?php }
 					$page_query = "SELECT * FROM posts WHERE author_id = '$row2[UserId]'";  
					$page_result = mysqli_query($con, $page_query);  
					$total_records = mysqli_num_rows($page_result);  
					$total_pages = ceil($total_records/$record_per_page);
					for($i=1; $i<=$total_pages; $i++){  
						?>
							<form id="page" method="post" action=<?php echo "user_page.php?text1=".$email; ?>>
								<input type="Submit" value=<?php echo $i; ?> name="page"/>
							</form>
						<?php
					}  
				?>
			</div>
		</div>
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