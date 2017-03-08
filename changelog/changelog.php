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
    <title> Edit Changelog </title>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
    fullHeader();
    ?>

    <!-- TinyMCE is a 3rd party WYSIWYG. The following scripts initialize it for this page. -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        //See http://archive.tinymce.com/wiki.php/Controls for toolbar options
        //See https://www.tinymce.com/docs/demo/custom-toolbar-button/ for custom button options used to make inserttoggle
        tinymce.init({
            browser_spellcheck : true,
            selector:'textarea',
            content_css: 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
            toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | inserttoggle',
            plugins: 'link image code autolink lists',
            setup: function(editor){
                editor.addButton('inserttoggle', {
                    text: 'Insert Toggle',
                    icon: false,
                    onclick: function() {
                        editor.insertContent('<div class=\"panel-group\"> <div class=\"panel panel-default"> <div class="panel-heading"> <h4 class="panel-title"><a href="#collapse1" data-toggle="collapse">Click to Toggle Information</a></h4> </div> <div id="collapse1" class="panel-collapse collapse in"> <div class="panel-body"> [Replace this with your content] </div></div></div></div>');
                    }
                });
            }
        });
    </script>
</head>
<body>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
?>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-md-1 text-left">
            <!-- White space on left 1/12th of the page -->
        </div>

        <div class="col-md-10 text-left">
            <br>
            <div id="changelog_tabs">
                <ul class="nav nav-tabs">
                    <li <?php if (strcmp('remove', $_GET['tab']) != 0) {
                        echo 'class="active"';
                    } ?>><a data-toggle="tab" href="#new">New Entry</a></li>
                    <li <?php if (strcmp('remove', $_GET['tab']) == 0) {
                        echo 'class="active"';
                    } ?>><a data-toggle="tab" href="#remove">Remove Entry</a></li>
                </ul>

                <div class="tab-content">
                    <div id="new" class="tab-pane fade <?php if (strcmp('remove', $_GET['tab']) != 0) {
                        echo 'in active';
                    } ?>">
                        <h1>Create New Entry</h1>
                        <p>This form will allow you to submmit a new changelog that will be displayed on the changelog
                            display page.</p>
                        <p>This page should only be accessible by admin users.
                        <p>
                        <form id="sendForm" action="sendchangelog.php" method="post" target="sendiFrame">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input class="form-control" name="title"
                                       placeholder='"Minor Updates" if not a large change or new feature'>
                            </div>
                            <div class="form-group">
                                <label for="author">Author:</label>
                                <input class="form-control" name="author" placeholder="John Example" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" name="message" rows="5"
                                          placeholder="Unordered list of changes"></textarea>
                            </div>
                            <button type="submit" class="btn btn-custom">Submit</button>
                        </form>
                        <br>
                        <iframe style="display: none;" align="left" name="sendiFrame" width="100%" height="500"
                                frameBorder="0" marginwidth="0"></iframe>
                    </div>
                    <div id="remove" class="tab-pane fade<?php if (strcmp('remove', $_GET['tab']) == 0) {
                        echo 'in active';
                    } ?>">
                        <h1>Remove Entry</h1>
                        <p>This form will allow you to remove a changelog entry so that it no longer shows on the
                            display page.</p>
                        <p>This page should only be accessible by admin users.
                        <p>
                        <form id="deleteForm" action="deletechangelog.php" method="post" target="removeiFrame">
                            <table class="sortable table table-striped">
                                <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>ID</th>
                                    <th>Date Created</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                require($_SERVER['DOCUMENT_ROOT'] . "/loginutils/connectdb.php");

                                $output = "";

                                $sql = "SELECT * FROM `changelog`";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $date = $row['date'];
                                        $author = html_entity_decode($row['author']);
                                        $title = html_entity_decode($row['title']);

                                        $output =
                                            '<tr>
											<th>
												<div class="checkbox">
													<label class="checkbox-inline">
														<input type="checkbox" name="toRemove[]" value="' . $id . '">
													</label>
												</div>
											</th>
											<th>' . $id . '</th>
											<th>' . $date . '</th>
											<th>' . $author . '</th>
											<th>' . $title . '</th>
										</tr>'
                                            . $output;
                                    }
                                    echo $output;
                                }
                                ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-danger" value="submit">Remove Selected</button>
                        </form>
                        <br>
                        <iframe style="display: none;" align="left" name="removeiFrame"></iframe>
                    </div>
                </div>
            </div>
        </div> <!--End div for main section-->

        <div class="col-md-1 text-left">
            <!-- White space on right 1/12th of the page  -->
        </div>
    </div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
include '../includes/footer.php';
?>


</body>
</html>
