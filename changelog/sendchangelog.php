<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html>
<head>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
    reducedHeader();
    ?>
</head>
<body>
<?php

require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

$title = htmlentities($_POST['title'], ENT_QUOTES, 'UTF-8');
$author = htmlentities($_POST['author'], ENT_QUOTES, 'UTF-8');
$message = htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');
if (strcmp('', $message) == 0) {
    echo '<script> parent.warningAlert("Message is empty.", "http://tdta.stthomas.edu/changelog/changelog.php");</script>';
} else {
    $query = "INSERT INTO `changelog` (id, date, title, author, message) VALUES (NULL, CURRENT_TIMESTAMP, '$title', '$author', '$message')";
    $result = mysqli_query($con, $query);
    if (!$result) {
        //Insert something that would happen if the information was not placed in
        //the database correctly.
        echo '<script> parent.errorAlert(' . mysqli_error($con) . ', "http://tdta.stthomas.edu/changelog/changelog.php");</script>';
    } else {
        echo '<script> parent.successAlert("Your announcement has been sent.", "http://tdta.stthomas.edu/changelog/showchangelog.php"); </script>';
    }
}
?>
</body>
</html>