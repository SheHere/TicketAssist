<?php include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php"); ?>

<!--
---- Ticket Assist - Home page for Ticket Assist Project.
---- Written by Nick Scheel and Chase Ingebritson Fall 2016
----
---- Designed for internal use at the St. Thomas Tech Desk for
---- training and efficiency purposes.
----
---- This page was built using the Bootstrap framework (http://getbootstrap.com/)
---- and also uses JQuery (https://jquery.com/) in its Javascript.
--->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticket Assist</title>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
    fullHeader();
    ?>

    <script src="../js/selection.js"></script>
</head>
<body>

<!-- Creates the navbar, see file for details and modification -->
<?php
include $_SERVER["DOCUMENT_ROOT"] . '/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="col-xs-6">

    </div>
    <div class="col-xs-6">
        <iframe id="form-preview-iframe" src="AssistantFormPreview.php"></iframe>
    </div>
</div>

<!-- Creates the footer, see file for details and modification -->
<?php
include $_SERVER["DOCUMENT_ROOT"] . '/includes/footer.php';
?>

</body>
</html>
