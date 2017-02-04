
<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>Ticket Assist Login</title>
	<link rel="stylesheet" href="styles/index.css">
	<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	reducedHeader();
	?> 
</head>
</head>

<body>
<?php
	require('loginutils/connectdb.php');

	// If form submitted, insert values into the database.
	if (isset($_POST['username'])){
		// removes backslashes
		$username = stripslashes($_REQUEST['username']);

		//escapes special characters in a string
		$username = mysqli_real_escape_string($con,$username);
		$password1 = stripslashes($_REQUEST['password1']);
		$password1 = mysqli_real_escape_string($con,$password1);
		$password2 = stripslashes($_REQUEST['password2']);
		$password2 = mysqli_real_escape_string($con,$password2);
		if(strcmp($password1,$password2)==0){
			$query = "INSERT into `login` (username, password, admin_status, role)
			VALUES ('$username', '".password_hash($password2, PASSWORD_DEFAULT)."', 1, 0);";
			$result = mysqli_query($con,$query);
			if(!$result){
				echo "<img src='https://i.imgur.com/MPdUNpN.png' style='z-index: -1;'/>
				<div class='form' name='login_failed'>
					<ul>
						<li>
							<div class='alert alert-warning' role='alert'>Username already exists.</div>
						</li>
					 </ul>
				</div>";
			}else{
				$multiquery = "
					INSERT INTO `users` (`username`, `fname`, `lname`, `bio`, `img_path`) VALUES ('$username', '', '', '', 'StudentRosterImages/PlaceholderImg.png');

					INSERT into `megalink` (username, link1, link2, link3, link4, link5)
					VALUES ('$username', 'https://whd.stthomas.edu', 'http://www.stthomas.edu/its/', 'https://www.random.org/passwords/', '', '');
					
					INSERT INTO `genericResponse` (`id`, `username`, `title`, `msg_body`) VALUES (NULL, '$username', 'General Resolved', '<p>Thank you for contacting the Tech Desk. I’m glad I was able to help you today!</p></p>If you have any further questions or concerns, feel free to email us at techdesk@stthomas.edu or give us a call at the number above</p><p>Have a nice day!</p>');
					
					INSERT INTO `genericResponse` (`id`, `username`, `title`, `msg_body`) VALUES (NULL, '$username', 'General Unresolved', '<p>Thank you for contacting the Tech Desk. We have submitted a ticket regarding your issue and will have someone in contact with you shortly.</p></p>If you have any further questions or concerns, feel free to reply directly to this email.</p><p>Have a nice day!</p>');
					";
				$notification_message1 = 'User: <strong>'.$username.'</strong> has requested access. Please visit the <a target="_top" href="https://140.209.47.120/settings/admin/UserRoster.php">User Roster</a> to set them as active.';
				$notification_message2 = htmlentities($notification_message1, ENT_QUOTES, 'UTF-8');
				$multiquery .= '
					INSERT INTO `notifications` (id, date_created, viewed, dismissed, username, title, message, all_admin) VALUES(NULL, NULL, 1, 1, "all admin", "Access Request", "'.$notification_message2.'", 3)';
				$multiresult = mysqli_multi_query($con,$multiquery);
				if(!multiresult){
					echo "<img src='https://i.imgur.com/MPdUNpN.png' style='z-index: -1;'/>
						<div class='form' name='login_failed'>
							<ul>
								<li>
									<div class='alert alert-warning' role='alert'>User account creation failed.</div>
								</li>
							 </ul>
						</div>";
				}else{
					echo "<img src='https://i.imgur.com/MPdUNpN.png' style='z-index: -1;'/>
						<div class='form' name='login_failed'>
							<ul>
								<li>
									<div class='well well-lg' role='alert'>User account creation successful. Please wait for administative approval. <br> <a href='https://140.209.47.120/index.php'>Return to Log In</a></div>
								</li>
							 </ul>
						</div>";
					$query2 = 'INSERT INTO `notifications` (id, date_created, viewed, username, title, message, all_admin) VALUES(NULL, NULL, 1, "all admin", "Access Request", "User: '.$username.' has requested access. Please visit the <a href="https://140.209.47.120/settings/admin/UserRoster.php">User Roster</a> to set them as active.", 3);';
				}
			}

		} else {
			echo "<img src='https://i.imgur.com/MPdUNpN.png' style='z-index: -1;'/>
				<div class='form' name='login_failed'>
					<form name='login' action='' method='post'>
					<ul class='login_failed'>
						<li>
							<input type='text' name='username' placeholder='Username' maxlength='20' autofocus required/>
						</li>
						<li>
							<input type='password' name='password1' id='password' placeholder='Password' required/>
						</li>
						<li>
							<input type='password' name='password2' id='password' placeholder='Repeat Password' required/>
						</li>
						<li>
							<input type='submit' name='submit' value='Login' />
						</li>
					 </ul>
					</form>
				</div>";
			}
	} else {
	?>
		<img src="https://i.imgur.com/MPdUNpN.png" style="z-index: -1;"/>
		<div class="form" name="login">
			<form  name="login" action="" method="post">
			<ul class='login_failed'>
				<li>
	        		<input type="text" name="username" placeholder="Username" maxlength="20" autofocus required/>
	        	</li>
	        	<li>
					<input type='password' name='password1' id='password' placeholder='Password' required/>
				</li>
				<li>
					<input type='password' name='password2' id='password' placeholder='Repeat Password' required/>
				</li>
	            <li>
	            	<input type="submit" name="submit" value="Login" />
	            </li>
	         </ul>
	        </form>
		</div>
		<?php } ?>
	</body>
</html>
