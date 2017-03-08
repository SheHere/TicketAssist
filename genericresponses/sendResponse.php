<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
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
$message = nl2br(htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8'));
$cur_user = $_SESSION['username'];
$update = $_POST['update'];

if (strcmp('', $message) == 0 || strcmp('', $title) == 0) {
    echo '<script> parent.warningAlert("Missing title or message!", "https://140.209.47.120/genericresponses/EditResponses.php");</script>';
} else {
    if ($_POST['update'] > 0) {
        $query = "
			UPDATE `genericResponse` 
			SET title = '$title', msg_body = '$message' 
			WHERE id = $update;";

    } else {
        $query = "
			INSERT INTO `genericResponse` (`id`, `created_by`, `creation_date`, `title`, `msg_body`) 
			VALUES (NULL, '$cur_user', CURRENT_TIMESTAMP, '$title', '$message');";
    }
    $result = mysqli_query($con, $query);
    if (!$result) {
        //Insert something that would happen if the information was not placed in
        //the database correctly.
        echo '<script> parent.errorAlert("' . mysqli_error($con) . '", "https://140.209.47.120/genericresponses/EditResponses.php");</script>';
    } else {
        echo '<script> parent.successAlert("The reponse has been added.", "http://140.209.47.120/assistant.php"); </script>';
    }
}
?>
</body>
</html>
