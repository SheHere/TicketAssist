<!-- 
    I set up a php variable called $database to pretend that there's a database

    Binfa wants the ability to sort this table by username, date, or permission. It doesn't need to be connected to a database or anything because he
    only wants a "proof of concept" 

    This is the best I was able to throw together, feel free to edit or completely redo it
-->

<?php
    $database[0]['username'] = "cole0126";
    $database[0]['date'] = "05/02/2017";
    $database[0]['permission'] = "Web Help Desk";

    $database[1]['username'] = "cole0126";
    $database[1]['date'] = "05/01/2017";
    $database[1]['permission'] = "Ticket Assist";

    $database[2]['username'] = "cole0126";
    $database[2]['date'] = "05/01/2017";
    $database[2]['permission'] = "LAPS";

    $database[3]['username'] = "sche0210";
    $database[3]['date'] = "05/02/2017";
    $database[3]['permission'] = "Web Help Desk";

    $database[4]['username'] = "ing0019";
    $database[4]['date'] = "04/27/2017";
    $database[4]['permission'] = "Web Help Desk";

    $database[5]['username'] = "inge0019";
    $database[5]['date'] = "05/02/2017";
    $database[5]['permission'] = "LAPS";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Title </title>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <?php
        include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
        fullHeader();
    ?>
    <style> /*We may want to refactor this into a css file*/
        table, th, td {
            border: 1px solid black;
            padding: 0 20px;
            margin-bottom: 20px;
        }

        h1 {
            margin-top: 40px;
            margin-bottom: 60px;
        }

        .btn-column {
            padding: 0;
        }

        .btn-default {
            color: black;
            border: none;
            border-radius: 0;
            transition: all 0.5s;
            width: 100%;
        }

        .btn-default:hover {
            color: black;
            font-weight: 700;
            background: #ff3333;
        }
    </style>
</head>
<body>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-md-2 text-left">
            <!-- White space on left 1/12th of the page -->
        </div>

        <div class="col-md-8 text-left">
            <h1>Permission History:</h1>

            <table>
                <tbody>
                    <tr>
                        <th>Username</th>
                        <th>Date</th>
                        <th>Permission Requested</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        foreach($database as $row) {
                            echo "<tr>";

                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['permission'] . "</td>";
                            echo "<td class='btn-column'><button class='btn btn-default'>Remove</button></td>";

                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div> <!--End div for main section-->

        <div class="col-md-2 text-left">
            <!-- White space on right 1/12th of the page  -->
        </div>
        <br><br><br><br><br>
    </div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->


<script>
    $(document).ready(function() {
        $('tr button').click(function() {
            $(this).parent().parent().fadeOut(function() {
                $(this).remove();

                //here we would query the db to remove the permission and submit a ticket to WHD
            });
        });
    });
</script>
</body>
</html>
