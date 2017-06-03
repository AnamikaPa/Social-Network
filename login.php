
<html>
<head>
<title>Registration / Login form </title>
<link href="css/login1.css" rel='stylesheet' type='text/css' />

<!--font CSS-->
<script src="js/jquery2.0.3.min.js"></script>

</head>
<body>
		<div class="main-grid">
				<div class="grids">
					<div class="progressbar-heading grids-heading">
						<h2>registration / login form</h2>
					</div>
					
					<div class="forms-grids">
						<div class="forms3">
						<div class="w3agile-validation w3ls-validation">
							<div class="panel panel-widget agile-validation register-form">
								<div class="validation-grids widget-shadow" data-example-id="basic-forms"> 
									<div class="input-info">
										<h3>Register Form :</h3>
									</div>
									<div style="color:red; margin-bottom:10px; margin-left:20px;" id="Registration_Output"></div>
									<div class="form-body form-body-info">
										<form id="registration_form" data-toggle="validator" novalidate="" method="post">
											<div class="form-group valid-form">
												<input type="text" class="form-control required inputName" id="inputName" name="Username" placeholder="Name" required>
												<span style="color:red" class="help-block username_error"></span>
											</div>
											<div class="form-group has-feedback">
												<input type="email" class="form-control inputEmail" name="Email" placeholder="Email" data-error="That email address is invalid" required="">
												<span style="color:red" class="help-block email_error"></span>
											</div>
											<div class="form-group">
											  <input type="password" data-toggle="validator" data-minlength="6" class="form-control inputPassword" name="Password" placeholder="Password" required="">
											  <span class="help-block Password_error">Minimum of 6 characters</span>
											</div>
											<div class="form-group">
											  <input type="password" class="form-control inputPasswordConfirm" data-match=".inputPassword" data-match-error="Whoops, these don't match" name="Confirm password" placeholder="Confirm password" required="">
											  <span style="color:red" class="help-block c_password_error"></span>
											</div>
											<div class="form-group">
												<div class="radio">
													<label>
													  <input type="radio" class="female" name="radio" value="female" required="">
													  Female
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" class="male" name="radio" value="male" required="">
													Male
													</label>
												</div>
												<span style="color:red" class="help-block gender_error"></span>
											</div>
											<input name="action" type="hidden" value="Registration">
											<div class="form-group">
												<div class="checkbox">
													<label>
														<input class="checkbox" type="checkbox" data-error="Before you wreck yourself" required>
														I have read and accept terms of use.
													</label>
												</div>
												<span style="color:red" class="help-block check_box_error"></span>
											</div>
											<input value="abc" type="hidden"/>
											<div class="form-group">
												<button id="rb" class="btn-primary">Submit</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							
							<div class="panel panel-widget agile-validation">
								<div class="validation-grids validation-grids-right login-form">
									<div class="widget-shadow login-form-shadow" data-example-id="basic-forms"> 
										<div class="input-info" >
											<h3>Login Form :</h3>
										</div>
										<div class="form-body form-body-info">
											<form id="login_form" data-toggle="validator" novalidate="" method="post">
												<div style="color:red; margin-bottom:10px; margin-left:20px;" id="login_error"></div>
												<input name="action" type="hidden" value="Login">
												<div class="form-group has-feedback">
													<input type="email" id="LoginEmail" class="form-control loginEmail" name="Email" placeholder="Enter Your Email" data-error="Bruh, that email address is invalid" required="">
													<span style="color:red" class="help-block email_error_login"></span>
												</div>
												<div class="form-group">
													<input type="password" data-toggle="validator" data-minlength="6" class="form-control loginPassword" name="Password" placeholder="Password" required="">
													<span style="color:red" class="help-block password_error_login"></span>
												</div>
												<input type="submit" id="lb" class="btn-primary" value="login">
													
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="clear"> </div>
						</div>
					</div>
				</div>
		</div>		
		
		<script>
			$(function(){
				$(".username_error").hide();
				$(".email_error").hide();
				$(".c_password_error").hide();
				$(".gender_error").hide();
				$(".check_box_error").hide();
				
				var error_username = true;
				var error_email = true;
				var error_password = true;
				var error_cpassword = true;
				var error_gender = true;
				var error_check_box = true;
				
				
				$(".inputName").focusout(function(){
					var length = $(".inputName").val().length;
					
					if(length <5 || length >20){
						$(".username_error").html("Length of Username must be in between 5-20");
						$(".username_error").show();
						error_username = true;
					}else{
						$(".username_error").hide();
						error_username = false;
					}
				});
				
				$(".inputEmail").focusout(function(){
					var pattern = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
					
					if(pattern.test($(".inputEmail").val())){
						$(".email_error").hide();
						error_email = false;
					}
					else{
						$(".email_error").html("Email address is invalid");
						$(".email_error").show();
						error_email = true;
					}
					
				});
				
				$(".inputPassword").focusout(function(){
					var length = $(".inputPassword").val().length;

					if(length <6){
						$(".Password_error").css("color","red");
						$(".Password_error").show();
						error_password = true;
					}else{
						$(".Password_error").hide();
						error_password = false;
					}
				});
				
				$(".inputPasswordConfirm").focusout(function(){
					var pass = $(".inputPassword").val();
					var cpass = $(".inputPasswordConfirm").val();
					
					if(pass != cpass){
						$(".c_password_error").html("Whoops, these don't match");
						$(".c_password_error").show();
						error_cpassword = true;
					}else{
						$(".c_password_error").hide();
						error_cpassword = false;
					}
				});
				
				$(".female").focusout(function(){
					check_gender();
				});
				
				$(".male").focusout(function(){
					check_gender();
				});
				
				function check_gender(){
					if($('.female').is(':checked') || $('.male').is(':checked')){
						$(".gender_error").hide();
						error_gender = false;
					}
					else{
						$(".gender_error").html("This must be filled");
						$(".gender_error").show();
						error_gender = true;
					}
				}
				
				$(".checkbox").focusout(function(){
					
					if(!$('.checkbox').is(':checked')){
						$(".check_box_error").html("Plz accept this");
						$(".check_box_error").show();
						error_check_box = true;
					}else{
						$(".check_box_error").hide();
						error_check_box = false;
					}
				});
				
				
				
				$("#registration_form").submit(function(){
					
					var f=0;
					
					var length = $(".inputName").val().length;
					if(length <5 || length >20){
						f=1;
						$(".username_error").html("Length of Username must be in between 5-20");
						$(".username_error").show();
					}
					
					var pattern = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
					if(!pattern.test($(".inputEmail").val())){
						f=1;
						$(".email_error").html("Email address is invalid");
						$(".email_error").show();
					}
					
					var length = $(".inputPassword").val().length;
					if(length <6){
						f=1;
						$(".Password_error").css("color","red");
						$(".Password_error").show();
					}
					
					var pass = $(".inputPassword").val();
					var cpass = $(".inputPasswordConfirm").val();
					
					if(pass != cpass){
						f=1;
						$(".c_password_error").html("Whoops, these don't match");
						$(".c_password_error").show();
					}
					
						if(!($('.female').is(':checked') || $('.male').is(':checked'))){
							f=1;
							$(".gender_error").html("This must be filled");
							$(".gender_error").show();
						}
					
					
					if(!$('.checkbox').is(':checked')){
						f=1;
						$(".check_box_error").html("Plz accept this");
						$(".check_box_error").show();
					}
					
					if(f==0){
						$("#rb").click(function(){
						var data = $("#registration_form").serialize();
						var email = $(".inputEmail").val();
						
						$.ajax({
							method:"post",
							url: "login_after.php?",
							data: data,
							success: function(data){
								if(data == "done"){
									window.location.href="main.php?text1="+email;
								}
								$("#Registration_Output").html(data);
							}
						});
					});
					}
					return false;
					
				});
			
			});
			
			$(function(){
				$(".email_error_login").hide();
				$(".password_error_login").hide();
				
				var error_email_login = true;
				var error_password_login = true;
				
				$(".loginPassword").focusout(function(){
					var length = $(".loginPassword").val().length;
					
					if(length <6){
						$(".password_error_login").html("Minimum of 6 characters");
						$(".password_error_login").show();
						error_password_login = true;
					}else{
						$(".password_error_login").hide();
						error_password_login = false;
					}
				});
				
				$(".loginEmail").focusout(function(){
					var pattern = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
					
					if(pattern.test($(".loginEmail").val())){
						$(".email_error_login").hide();
						error_email_login = false;
					}
					else{
						$(".email_error_login").html("Email address is invalid");
						$(".email_error_login").show();
						error_email_login = true;
					}
					
				});
			
				$("#login_form").submit(function(){
					
					var f=0;
					
					var pattern = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
					if(!pattern.test($(".loginEmail").val())){
						f=1;
						$(".email_error_login").html("Email address is invalid");
						$(".email_error_login").show();
					}
					
					var length = $(".loginPassword").val().length;
					if(length <6){
						f=1;
						$(".password_error_login").html("Minimum of 6 characters");
						$(".password_error_login").show();
					}
					
					if(f==0){
						$("#lb").click(function(){
							var data = $("#login_form").serialize();
							var email = $("#LoginEmail").val();
							$.ajax({
								method:"post",
								url: "login_after.php?",
								data: data,
								success: function(data){
									if(data == "done"){
										window.location.href="main.php?text1="+email;
									}
									else $("#login_error").html(data);
								}
							});
						});
					}
					
					return false;
					
				});
				
			});
			
			
		</script>
</body>
</html>