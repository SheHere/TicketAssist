<?php

include 'linksConfig.php';
require($_SERVER["DOCUMENT_ROOT"] . '/loginutils/connectdb.php');
echo '<link rel="stylesheet" href="' . $_SERVER["SERVER_ROOT"] . '/styles/font-awesome-4.7.0/css/font-awesome.min.css">';
$ret = "";

$username = $_SESSION['username'];
$usrstatus = $_SESSION['admin_status'];

//The following finds the links the user has specified for their MegaLink.
$sql = "SELECT *
FROM megalink
WHERE username LIKE '$username'
";
$link1 = "";
$link2 = "";
$link3 = "";
$link4 = "";
$link5 = "";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$link1url = $row['link1'];
	$link2url = $row['link2'];
	$link3url = $row['link3'];
	$link4url = $row['link4'];
	$link5url = $row['link5'];

	if(strcmp("", $link1url) != 0){$link1 = 'window.open("' . $link1url . '"); ';}
	if(strcmp("", $link2url) != 0){$link2 = 'window.open("' . $link2url . '"); ';}
	if(strcmp("", $link3url) != 0){$link3 = 'window.open("' . $link3url . '"); ';}
	if(strcmp("", $link4url) != 0){$link4 = 'window.open("' . $link4url . '"); ';}
	if(strcmp("", $link5url) != 0){$link5 = 'window.open("' . $link5url . '"); ';}
	} else {
	$link1 = 'window.open("https://whd.stthomas.edu"); ';
	$link2 = 'window.open("https://www.stthomas.edu/its"); ';
	}

$ret .= '
<link rel="stylesheet" href="' . $_SERVER["SERVER_ROOT"] . '/styles/navbar.css">
<iframe name="TimeoutCheat" src="../hostedpages/cheat.php" style="display:none;"></iframe>

<nav id="main-navbar" class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="' . $_SERVER["SERVER_ROOT"] . '/assistant/assistant.php"><div class="home_link">&nbsp<span class="glyphicon glyphicon-home"></span>&nbsp</div></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
	  <ul class="nav navbar-nav">
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<span class="glyphicon glyphicon-option-vertical"></span>
				&nbspInternal Links
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu ">
				<li><a href="' . $_SERVER["SERVER_ROOT"] . '/logs/logIndex.php" ><span class="glyphicon glyphicon-folder-open"></span>&nbsp&nbspLogs</a></li>
				<li><a href="' . $_SERVER["SERVER_ROOT"] . '/guides/GuideIndex.php" ><span class="glyphicon glyphicon-road"></span>&nbsp&nbspGuides</a></li>
				<li><a href="' . $_SERVER["SERVER_ROOT"] . '/training/TrainingHome.php" ><i class="glyphicon glyphicon-apple" aria-hidden="true"></i>&nbsp&nbsp Training</a></li>
				<hr>
				<li><a href="' . $_SERVER["SERVER_ROOT"] . '/StudentRoster/studentbios.php" ><span class="glyphicon glyphicon-list"></span>&nbsp&nbspStudent Roster</a></li>
				<li><a href="' . $_SERVER["SERVER_ROOT"] . '/badges/badge_index.php" ><span class="glyphicon glyphicon-certificate"></span>&nbsp&nbspBadges</a></li>
				<hr>
				<li><a href="' . $_SERVER["SERVER_ROOT"] . '/dev/SubmitFeedback.php" ><i class="fa fa-bug" aria-hidden="true"></i>&nbsp&nbspSubmit Feedback</a></li>


			</ul>
		</li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<span class="glyphicon glyphicon-option-vertical"></span>
				&nbspExternal Links
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu ">
				<!-- Glyphcons found on http://getbootstrap.com/components/. They are provided for free from http://glyphicons.com/-->
				<!-- The code "&nbsp" is a forced space, which adds white space inbetween the glyphcon and the words following them.-->
				<li><a href="' . WHD_LINK . '" target="_blank"><span class="glyphicon glyphicon-pencil"></span>&nbsp&nbspWeb Help Desk</a></li>
				<li><a href="' . CHAT_LINK . '" target="_blank"><i class="fa fa-terminal" aria-hidden="true"></i>&nbsp&nbspChat Login</a></li>
				<li><a href="' . SHAREPOINT_LINK . '" target="_blank"><span class="glyphicon glyphicon-globe"></span>&nbsp&nbspSharepoint Site</a></li>
				<li><a href="' . FIM_LINK . '" target="_blank"><span class="glyphicon glyphicon-list-alt"></span>&nbsp&nbspForefront Identity Manager</a></li>
				<li><a href="' . CHECKOUT_LINK . '" target="_blank"><span class="glyphicon glyphicon-barcode"></span>&nbsp&nbspCheckout System</a></li>
				<li><a href="' . ITS_HOME_LINK . '" target="_blank"><span class="glyphicon glyphicon-education"></span>&nbsp&nbspITS Homepage</a></li>
				<li><a href="' . CALENDAR_LINK . '" target="_blank"><span class="glyphicon glyphicon-calendar"></span>&nbsp&nbspCalendar</a></li>
				<li><a href="' . PAYROLL_LINK . '" target="_blank"><span class="glyphicon glyphicon-time"></span>&nbsp&nbspTime Keeping</a></li>
				
			</ul>
		</li>'
		;

	if($usrstatus == 2 || $usrstatus == 3) {
		/*Below are links seen by Superusers and Admins.*/
		$ret .=  '
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="glyphicon glyphicon-king"></span>
					&nbspAdmin Links
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu ">
					<!-- Glyphcons found on http://getbootstrap.com/components/. They are provided for free from http://glyphicons.com/-->
					<!-- The code "&nbsp" is a forced space, which adds white space inbetween the glyphcon and the words following them.-->
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/guides/NewGuide.php" ><span class=" glyphicon glyphicon-open-file"></span>&nbsp&nbspNew Guide</a></li>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/contacts/ContactInfoFullView.php" ><span class="glyphicon glyphicon-phone"></span>&nbsp&nbspEmployee Contacts</a></li>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/documentation/Documentation.php"><span class="glyphicon glyphicon-book"></span>&nbsp&nbspSite Documentation</a></li>
					';

		/*Below are links seen by Admins only */
		if($usrstatus == 3){
			$ret .= '
					<hr>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/announcements/Announcements.php" ><span class="glyphicon glyphicon-bullhorn"></span>&nbsp&nbspAnnouncements</a></li>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/AccountAccess/ViewPermissions.php" ><span class="glyphicon glyphicon-lock"></span>&nbsp&nbspUser Permissions</a></li>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/settings/admin/UserRoster.php" ><span class="glyphicon glyphicon-list"></span>&nbsp&nbspUser Roster</a></li>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/settings/admin/AddOrRemoveUser.php" ><span class="glyphicon glyphicon-user"></span>&nbsp&nbspAdd or Remove User</a></li>';
		}

		$ret .= '
				</ul>
			</li>';
	}
	if(strcmp('sche0210',$_SESSION['username'])==0 ||strcmp('inge0019',$_SESSION['username'])==0){
		$ret .= '
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="glyphicon glyphicon-sunglasses"></span>
					&nbspDeveloper Links
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<!-- The code "&nbsp" is a forced space, which adds white space inbetween the glyphcon and the words following them.-->
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/dev/ViewFeedback.php" ><span class="glyphicon glyphicon-thumbs-down"></span>&nbsp&nbspView Feedback</a></li>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/assistant/TestAssistant.php" ><span class="glyphicon glyphicon-warning-sign"></span>&nbsp&nbspTest Assistant</a></li>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/changelog/changelog.php" ><i class="fa fa-code-fork fa-1x" aria-hidden="true"></i>&nbsp&nbspEdit Changelog</a></li>
					<hr>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/calendar/CalendarIndex.php"><span class="glyphicon glyphicon-calendar"></span>&nbsp&nbspCalendar BETA</a></li>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/guides/encyclopedia/Encyclopedia.php" ><span class="glyphicon glyphicon-book"></span>&nbsp&nbspEncyclopedia</a></li>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/guides/encyclopedia/EntryApproval.php" ><span class="glyphicon glyphicon-ok"></span>&nbsp&nbspApprove Encyclopedia Entry</a></li>
				</ul>
			</li>';
	}

	$ret .= '
			<li class="dropdown">
				<a href="#" id="megalink" class="megalink btn btn-secondary" role="button" title="If not functioning, allow pop-ups for this page."><span class="glyphicon glyphicon-triangle-right"></span>&nbsp&nbspMega Link</a>
			</li>
			<li class="dropdown">
				<a href="#" id="passwordgen" class="megalink btn btn-secondary" role="button" onclick="generatePassword();"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp&nbspGenerate Passwords</a>
			</li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
			<!-- The following line creates the logout button. The nested Div forces the text and glyphcon to be white instead of black.-->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="glyphicon glyphicon-cog"></span>
					&nbsp&nbsp' . $_SESSION['username'] . '
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/settings/user/PasswordUpdate.php" ><span class="glyphicon glyphicon-triangle-right"></span>&nbsp&nbspChange Password</a></li>
					<li><a href="' . $_SERVER["SERVER_ROOT"] . '/settings/user/UserSettings.php"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp&nbspUser Settings</a></li>
				</ul>
			</li>
			<li><a href="/loginutils/logout.php"><div class="logout_link">&nbsp&nbsp<span class="glyphicon glyphicon-log-out"></span>&nbsp&nbspLog Out</div></a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<script>
	$("#megalink").click(function(e) {
		e.preventDefault();
		' . $link1 . $link2 . $link3 . $link4 . $link5 . '

	});
	</script>';

echo $ret;

?>
