<?php
if(isset($_POST['student']) && strcmp("", $_POST['student']) != 0) {
    require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
    $studentUsername = $_POST['student'];
    $sql = "
        SELECT `username`, `fname`, `lname`, `img_path`, `phone_number`
        FROM `users`
        WHERE `username` LIKE '$studentUsername';";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo "https://tdta.stthomas.edu/StudentRoster/" . $row['img_path'] . "!" . $row['fname'] . "!" . $row['lname'] . "!" . $row['username'] . "!" . $row['phone_number'];
    } else { // If , send error
        echo "db error";
    }
}else{ // If $_POST['student'] is not set, send error
        echo "input error";
    }