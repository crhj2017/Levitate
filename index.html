<!DOCTYPE html>
<?php
session_start();
#Loads JQuery
echo '<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>';
#Functions for register/login
include_once 'core/functions.php';
	try{
		if(isset($_POST['signup'])){
			$obj = new loginValidation;
			$obj->createUser($_POST['name'],$_POST['pass']);
		}elseif(isset($_POST['signin'])){
			$obj = new loginValidation;
			$obj->passVal($_POST['name'],$_POST['pass']);
		 }
	}
	catch(PDOException $e){
		echo "error".$e->getMessage();
	}

include_once 'core/routing.php';
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Levitate OLP / Auth</title>
		<link rel="stylesheet" type="text/css" href="assets/css/lg-styles.css">
		<link rel="stylesheet" type="text/css" href="assets/css/semantic.min.css">
		<script src="assets/js/semantic.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>
		<div class="lg-topbox ffbox">
			<img src="assets/img/logo.png">
			<h1>Levitate O.L.P.</h1>
			<h2>Online Learning Platform</h2>
		</div>
		<br><br>
		<!-- Login/Register boxes -->
		<div class="login-wrapper ffbox">
				<form method="post" class="si-box">
					<div class="ui input fluid lg-input">
						<input type="text" name="name" placeholder="username" required>
					</div>
					<br>
					<div class="ui input fluid lg-input">
						<input type="text" name="pass" placeholder="password" required>
					</div>
					<br>
					<div class="ui fluid buttons">
						<input class="ui positive button " type="submit" name="signin" >Sign In
						<div class="or"></div>
						<button class="ui button" onclick="registration()" type="button">Register</button>
					</div>
				</form>
			<br>
			<p>If you are not a levitate O.L.P user and click the register button, you will be registered and you will agree to Levitate-Education's <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.</p>
		</div>
		<!-- Incorrect details modal -->
		<div class="ui modal" id="auth-modal">
			<div class="header negative fail-modal-header">
				<i class="warning sign icon"></i> Authentication Error
			</div>
			<div class="image content">
				<div class="description">
					<div class="ui header">Incorrect username and/or password.</div>
					<p>Password is case sensitive, please check your caps lock before retrying.</p>
					<p><i class="notched circle loading icon"></i> Page refreshing in 3 seconds.</p>
				</div>
			</div>
		</div>
		<!-- Success modal -->
		<div class="ui modal" id="success-modal">
			<div class="header success-modal-header">
				<i class="checkmark icon"></i> Success
			</div>
			<div class="image content">
				<div class="description">
					<div class="ui header">You have been successfully registered</div>
					<p><i class="notched circle loading icon"></i> Page refreshing in 3 seconds.</p>
				</div>
			</div>
		</div>
		<!-- Registration modal -->
		<div class="ui modal" id="reg-modal">
			<div class="header negative">
				<i class="add user icon"></i> Registration
			</div>
			<div class="image content">
				<div class="description">
					<div class="ui header">Enter all details to gain access to Levitate O.L.P.</div>
					<p>Password is case sensitive, please check your caps lock before retrying.</p>
					<form method="post">
						<div class="ui input fluid lg-input">
							<input type="text" name="name" placeholder="username" required>
						</div>
						<br>
						<div class="ui input fluid lg-input">
							<input type="text" name="pass" placeholder="password" required>
						</div>
						<br>
						<button class="ui secondary button" type="submit" name="signup">Sign Up Now</button>
					</form>
				</div>
			</div>
		</div>

		<script>
			//Function to open reg modal
			function registration() {
				$('#reg-modal')
					.modal({
						blurring: true
					})
					.modal('show')
				;
			}
		</script>
	</body>
</html>
