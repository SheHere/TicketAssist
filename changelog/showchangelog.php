<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Changelog</title>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
    datatablesHeader();
    ?>

    <!-- Configures the datatable so that it targets the table, order by descending, sets it to a frame so that we can see the buttons at the bottom without scrolling to them. -->
    <script>
        $(document).ready(function () {
            $('#changelogTable').DataTable({
                scrollY: '55vh',
                scrollCollapge: true,
				order: [[ 0, 'desc' ]],
                columnDefs: [{width: '15%', targets: 0}]
            });
        });
    </script>
    <style>
        .table > tbody > tr > th {
            font-weight: normal;
        }
        .table > tbody >tr > th > ol > li {
            margin-top: 0px;
            margin-bottom: 0px;
        }
    </style>
</head>
<body>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
?>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-md-1 text-left">
            <!-- White space on left 1/12th -->
        </div>
        <!--
        ---- Begin main section, which will call the HTML from the input file
        --->
        <div class="col-md-10 text-left">

            <h1>Changelog</h1>
            <p>Updates to the site will be documented here.<?php if($_SESSION['admin_status'] > 2){echo ' Admin users can add to the changelog <a href="https://140.209.47.120/changelog/changelog.php">here.</a>';}?></p>
            <!--
            ---- The classe "sortable" calls .js file that allows the table to be sorted, the class "table" is a Bootstrap
            ---- class that formats it nicely, and "table-striped" is a Bootstrap class that makes every-other entry
            ---- a gray color so each entry stands out better.
            -->
            <table id="changelogTable" class="display table table-striped">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Log</th>
                </tr>
                </thead>
                <tbody>
                <?php
                /*
                    The following PHP send a request to the database looking for each log entry that belongs to the current user.
                    It displays them in descending order by ID, which is also by most recent.
                    It will not show log entries with a visibility of 0, ones that have been "deleted".
                */
                require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

                $output = "";
                $sql = "SELECT * FROM changelog ORDER BY id DESC;";
                $result = mysqli_query($con, $sql);
                if (!$result) {
                    echo '<div class="alert alert-danger" role="alert"><strong>Error. </strong>';
                    echo mysqli_error($con);
                    echo '</div>';
                } else {
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $date = $row['date'];
                            $author = $row['author'];
                            $title = html_entity_decode($row['title']);
                            $message = html_entity_decode($row['message']);

                            $output = '
									<tr>
										<th>' . $date . '</th>
										<th><h4>' . $title . '</h4><p>' . $message . '</p></th>
									</tr>' . $output;
                        }
                    }
                    echo $output;
                }
                ?>
                </tbody>
            </table>
            <div class="iFrame" id="iFrameDiv">
                <iframe style="display: none;" align="left" name="iFrame" width="100px" height="100px" frameBorder="0"
                        marginwidth="0"></iframe>
            </div>
        </div>
    </div> <!--End div for main section-->

    <div class="col-md-1 text-left">
        <!-- White space on right 1/12th -->
    </div>

</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<div class="footer">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
    ?>
</div>
</body>
</html>
