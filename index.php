
<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<title>Ticket Assist Login</title>

	<link rel="stylesheet" href="styles/index.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="tours/bootstrap-tour-0.11.0/build/css/bootstrap-tour.min.css">
	<link rel="stylesheet" href="styles/font-awesome-4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="tours/bootstrap-tour-0.11.0/build/js/bootstrap-tour.min.js"></script>
	<script src="tours/loginTour.js"></script>
</head>

<body>
<?php
require('loginutils/connectdb.php');

session_start();

if(isset($_SESSION["username"])){
	header("Location: assistant.php");
}

// If form submitted, insert values into the database.
if (isset($_POST['username'])){
	// removes backslashes
	$username = stripslashes($_REQUEST['username']);

	//escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);

	//Checking is user existing in the database or not
	$query = "SELECT *
			  FROM `login` INNER JOIN `users` USING(username)
			  WHERE username='$username';";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	$ret = mysqli_fetch_assoc($result);
	if(password_verify($password, $ret['password'])){
		if($ret['role'] == 0){
			echo "<img src='https://i.imgur.com/MPdUNpN.png' style='z-index: -1;'/>
			<div class='form' name='login_failed'>
				<ul>
					<li>
		        		<div class='alert alert-warning' role='alert'><strong>Warning.</strong> You do not have access to this site. Please contact an administrator.</div>
					</li>
		         </ul>
			</div>
			Don't have an account? <a href='RequestAccess.php'>Request Access</a>";
		}else if($ret['new_user'] == 0 || strcmp('',$ret['fname'])==0){
			$_SESSION['username'] = $username;
			$_SESSION['admin_status'] = $ret['admin_status'];
			header("Location: settings/user/firstTimeSetup.php");
		}else{
			$_SESSION['username'] = $username;
			$_SESSION['admin_status'] = $ret['admin_status'];
			header("Location: assistant.php");
		}
	} else {
		echo "<img src='https://i.imgur.com/MPdUNpN.png' style='z-index: -1;'/>\
			<h1 id='main-header-failed'>Ticket Assist</h1>
			<div class='form' name='login_failed'>
				<form name='login' action='' method='post'>
				<ul class='login_failed'>
					<li>
		        		<input type='text' name='username' placeholder='Username' maxlength='20' autofocus required/>
					</li>
		        	<li>
		            	<input type='password' name='password' id='password' placeholder='Password' required/>
		            </li>
		            <li>
		            	<input type='submit' name='submit' value='Login' />
		            </li>
		         	<li id='request_access_container'>
						<a id='request_access' class='request_access' href='RequestAccess.php'>Request Access</a>
					</li>
		         </ul>
		        </form>
			</div>";
		}
	} else {
	?>
		<img src="https://i.imgur.com/MPdUNpN.png" style="z-index: -1;"/>
		<h1 id="main-header">Ticket Assist</h1>
		<div class="form" name="login">
			<form  name="login" action="" method="post">
			<ul>
				<li>
	        		<input type="text" name="username" placeholder="Username" maxlength="20" autofocus required/>
	        	</li>
	        	<li>
	            	<input type="password" name="password" id="password" placeholder="Password" required/>
	            </li>
	            <li>
	            	<input type="submit" name="submit" value="Login" />
	            </li>
	            <li id='request_access_container'>
		         	<a id='request_access' class='request_access' href='RequestAccess.php'>Request Access</a>
		        </li>
	         </ul>
	        </form>
		</div>
		<?php } ?>
		<button id="start-tour" type="button" class="btn btn-link" onclick="startTour();"><i class="fa fa-question-circle fa-2x" aria-hidden="true"></i></button>
	</body>
</html>
