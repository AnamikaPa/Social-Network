<!DOCTYPE html>
<html lang="en">
<head>
<title>Social Network</title>    
<?php include "header.php" ?>
<!-- stylesheet -->


<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script src="js/main.js"></script>

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

</head>
<body>
<!-- header -->
	<header>
			<div class="container">					
			
				<div style="margin-top:10px; margin-bottom:10px; margin-left:30px; width:50%"  class="logo">
					<h1><a  href="index.php"><image  src="logo.png"/></a></h1>
				</div>
			</div>
		
		<!-- navigation -->
		<hr />
			
		<a style="margin-left:90%; margin-top:-100px; margin-bottom:5px; width:70px; font-size:25px; display:block; padding:5px;" href="login.php">Login </a>
			
			
		<!-- //navigation -->
	</header>
	<!-- //header -->
	<!-- top-header and slider -->
	<div class="w3-slider">	
	<!-- main-slider -->
		<ul id="demo1">
			<li>
				<img src="images/slider1.jpg" alt="" />
				<!--Slider Description example-->
				<div style="background-color:black; opacity:0.7; width:65%; margin-left:17%;" class="slide-desc">
					<h3>Social Network</h3>
					<p>EVERYTHING you post on social media impacts your PERSONAL BRAND<BR> How do you want to be known?</p>
				</div>
			</li>
			<li>
				<img src="images/slider2.jpg" alt="" />
				  <div style="background-color:black; opacity:0.7; width:65%; margin-left:17%;" class="slide-desc">
					<h3>Social Network</h3>
					<p> Social Networking helps reach people EASIER and QUICKER </p>
				</div>
			</li>
			<li>
				<img src="images/slider3.jpg" alt="" />
				<div style="background-color:black; opacity:0.7; width:65%; margin-left:17%;" class="slide-desc">
					<h3>Social Network</h3>
					<p>We don't have a choice on whether we DO social media,<br> the question is how well we DO it.</p>
				</div>
			</li>
			
		</ul>
	</div>
</body>
</html>