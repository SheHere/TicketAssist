<?php
include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php");
$toprint = "error";
if (isset($_GET["page"])) {
	require_once($_SERVER['DOCUMENT_ROOT'] . "/third-party-packages/parsedown-master/Parsedown.php");

	$page = htmlspecialchars($_GET["page"]);

	$parsedown = new Parsedown();

	$text = file_get_contents("markdowns/$page.md");
	$toprint = '<br><a href="Documentation.php"><span class="glyphicon glyphicon-chevron-left"></span><b>Return to Documentation List</b></a>';
	$toprint .= $parsedown->text($text);
} else {
	$toprint = '                    
                    <h2>Documentation Topics</h2>
                    <table class="table">
                        <tr><td><a href="//tdta.stthomas.edu/documentation/Documentation.php?page=Accounts">Accounts</a></td></tr>
                        <tr><td><a href="//tdta.stthomas.edu/documentation/Documentation.php?page=Badges">Badges</a></td></tr>
                        <tr><td><a href="//tdta.stthomas.edu/documentation/Documentation.php?page=Database">Database</a></td></tr>
                        <tr><td><a href="//tdta.stthomas.edu/documentation/Documentation.php?page=Developer">Developer</a></td></tr>
                        <tr><td><a href="//tdta.stthomas.edu/documentation/Documentation.php?page=HomePage">HomePage</a></td></tr>
                        <tr><td><a href="//tdta.stthomas.edu/documentation/Documentation.php?page=Navbar">Navbar</a></td></tr>
                        <tr><td><a href="//tdta.stthomas.edu/documentation/Documentation.php?page=Other">Other</a></td></tr>
                        <tr><td><a href="//tdta.stthomas.edu/documentation/Documentation.php?page=PageLayout">PageLayout</a></td></tr>
                        <tr><td><a href="//tdta.stthomas.edu/documentation/Documentation.php?page=ThirdParty">ThirdParty</a></td></tr>
                        <tr><td><a href="//tdta.stthomas.edu/documentation/Documentation.php?page=Training">Training</a></td></tr>
                    </table>';
}
?>
<!--
<--- Created by Nick Scheel and Chase Ingebritson 2017
<---
<--- University of St. Thomas ITS Tech Desk
--->
<!DOCTYPE html>
<!--
---- Documentation - The documentation page for Ticket Assist
---- Written by Nick Scheel and Chase Ingebritson Fall 2016
----
---- Designed for internal use at the St. Thomas Tech Desk for
---- training and efficiency purposes.
----
---- This page was built using the Bootstrap framework (http://getbootstrap.com/)
---- and also uses JQuery (https://jquery.com/) in its Javascript.
----
---- This page utilizes GET requests to pull the specified markdown page.
--->
<html lang="en">
<head>
	<title>Ticket Assist</title>
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
	<style>
		tr:hover {
			background-color: #dddddd;
		}
	</style>
</head>
<body>
<?php include $_SERVER["DOCUMENT_ROOT"] . '/includes/navbar.php'; ?>
<div class="container-fluid text-left">
	<div class="col-xs-1 text-center"></div>
	<div class="col-xs-10">
		<?php echo $toprint; ?>
		<br><br><br>
	</div>
	<div class="col-xs-1"></div>
</div>
<?php include $_SERVER["DOCUMENT_ROOT"] . '/includes/footer.php'; ?>
</body>
</html>