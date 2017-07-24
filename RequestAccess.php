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
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
    reducedHeader();
    ?>
</head>
</head>

<body>
<?php
require('loginutils/connectdb.php');

// If form submitted, insert values into the database.
if (isset($_POST['username'])) {
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    $fname = stripslashes($_REQUEST['fname']);
	$lname = stripslashes($_REQUEST['lname']);

    //escapes special characters in a string
    $username = mysqli_real_escape_string($con, $username);
    $password1 = stripslashes($_REQUEST['password1']);
    $password1 = mysqli_real_escape_string($con, $password1);
    $password2 = stripslashes($_REQUEST['password2']);
    $password2 = mysqli_real_escape_string($con, $password2);
    if (strcmp($password1, $password2) == 0) {
        $query = "INSERT into `login` (username, password, admin_status, role)
			VALUES ('$username', '" . password_hash($password2, PASSWORD_DEFAULT) . "', 1, 0);";
        $result = mysqli_query($con, $query);
        if (!$result) {
            echo "<img src='https://i.imgur.com/MPdUNpN.png' style='z-index: -1;'/>
				<div class='form' name='login_failed'>
					<ul>
						<li>
							<div class='alert alert-warning' role='alert'>Username already exists.</div>
						</li>
					 </ul>
				</div>";
        } else {
            $multiquery = "
					INSERT INTO `users` (`username`, `fname`, `lname`, `bio`, `img_path`, `notes`, `phone_number`, `ust_id`) VALUES ('$username', '$fname', '$lname', '', 'StudentRosterImages/PlaceholderImg.png', '', '', '$ust_id');

					INSERT into `megalink` (username, link1, link2, link3, link4, link5)
					VALUES ('$username', 'https://whd.stthomas.edu', 'http://www.stthomas.edu/its/', '', '', '');
					";
            $notification_message1 = 'User: <strong>' . $username . '</strong> has requested access. Please visit the <a target="_top" href="https://tdta.stthomas.edu/settings/admin/UserRoster.php?show=inactive">User Roster</a> to set them as active.';
            $notification_message2 = htmlentities($notification_message1, ENT_QUOTES, 'UTF-8');
            $multiquery .= '
					INSERT INTO `notifications` (id, date_created, viewed, dismissed, username, title, message, all_admin) VALUES(NULL, NULL, 1, 1, "all admin", "Access Request", "' . $notification_message2 . '", 3)';
            $multiresult = mysqli_multi_query($con, $multiquery);
            if (!multiresult) {
                echo "<img src='https://i.imgur.com/MPdUNpN.png' style='z-index: -1;'/>
						<div class='form' name='login_failed'>
							<ul>
								<li>
									<div class='alert alert-warning' role='alert'>User account creation failed.</div>
								</li>
							 </ul>
						</div>";
            } else {
                echo "<img src='https://i.imgur.com/MPdUNpN.png' style='z-index: -1;'/>
						<div class='form' name='login_failed'>
							<ul>
								<li>
									<div class='well well-lg' role='alert'>User account creation successful. Please wait for administrative approval. <br> <a href='https://tdta.stthomas.edu/index.php'>Return to Log In</a></div>
								</li>
							 </ul>
						</div>";
            }
        }
    } else {
        echo "<img src='https://i.imgur.com/MPdUNpN.png' style='z-index: -1;'/>
				<div class='form' name='login_failed'>
					<form name='login' action='' method='post'>
					<ul class='login_failed'>
						<li>
							<input type='text' name='fname' placeholder='First name' maxlength='20' autofocus required/>
						</li>
						<li>
							<input type='text' name='lname' placeholder='Last name' maxlength='20' required/>
						</li>
						<li>
							<input type='text' name='username' placeholder='Username' maxlength='20'  required/>
						</li>
						<li>
							<input type='text' name='ust_id' placeholder='St. Thomas ID #' maxlength='9'  required/>
						</li>
						<li>
							<input type='password' name='password1' id='password' placeholder='Password' required/>
						</li>
						<li>
							<input type='password' name='password2' id='password' placeholder='Repeat Password' required/>
						</li>
						<li>
							<input type='submit' name='submit' value='Request Access' />
						</li>
						<li id='request_access_container'>
							<a id='request_access' class='request_access' href='index.php'>Return to Login</a>
						</li>
					 </ul>
					</form>
				</div>";
    }
} else {
    ?>
    <img src="https://i.imgur.com/MPdUNpN.png" style="z-index: -1;"/>
    <div class="form" name="login">
        <form name="login" action="" method="post">
            <ul class='login_failed'>
				<li>
					<input type='text' name='fname' placeholder='First name' maxlength='20' autofocus required/>
				</li>
				<li>
					<input type='text' name='lname' placeholder='Last name' maxlength='20' required/>
				</li>
				<li>
					<input type='text' name='username' placeholder='Username' maxlength='20'  required/>
				</li>
				<li>
					<input type='text' name='ust_id' placeholder='St. Thomas ID #' maxlength='9'  required/>
				</li>
                <li>
                    <input type='password' name='password1' id='password' placeholder='Password' required/>
                </li>
                <li>
                    <input type='password' name='password2' id='password' placeholder='Repeat Password' required/>
                </li>
                <li>
                    <input type="submit" name="submit" value="Request Access"/>
                </li>
				<li id='request_access_container'>
					<a id='request_access' class='request_access' href='index.php'>Return to Login</a>
				</li>
            </ul>
        </form>
    </div>
<?php } ?>
</body>
</html>
