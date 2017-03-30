<?php include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php"); ?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>

<!--
---- Ticket Assist - Home page for Ticket Assist Project.
---- Written by Nick Scheel and Chase Ingebritson Fall 2016
----
---- Designed for internal use at the St. Thomas Tech Desk for
---- training and efficiency purposes.
----
---- This page was built using the Bootstrap framework (http://getbootstrap.com/)
---- and also uses JQuery (https://jquery.com/) in its Javascript.
----
--->
<html lang="en">
<head>
    <title>Ticket Assist</title>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
    fullHeader();
    ?>
    <script src="../js/selection.js"></script>
    <!-- Sets the default column height to 100% -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
    <script src="../tours/bootstrap-tour-0.11.0/build/js/bootstrap-tour.min.js"></script>
    <script src="../tours/assistantTour.js"></script>
    <style>
        .infoiFrame {
            margin-top: 10px;
            padding-top: 10px;
        }
        .nav-tabs {
            margin-top: -11px;
        }
        input#submitbutton {
            width: 100%;
            margin-top: 25px;
            margin-left: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
        }
        th {
            font-weight: normal;
        }
    </style>
</head>
<body>

<!-- Creates the navbar, see file for details and modification -->
<?php
include $_SERVER["DOCUMENT_ROOT"] . '/includes/navbar.php';
?>

<div class="container-fluid text-center"> <!-- Creates container that holds everything except the navbar-->
    <div class="col-md-11 text-left">
        <h1>Ticket Assist</h1>
    </div>

    <!--
    <--- Begin columns 2-3, containing Client Information and Further Details sections of the form.
    <--- The form is continued and submitted in the next set of columns.
    --->
    <div class="col-md-2 text-left">
        <form id="clientInfoForm" method="post" action="sendLog.php" target="infoiFrame">
            <!-- Begin client info section-->
            <fieldset id="clientinfo">
                <legend>Client Information:</legend>
                <div class="form-group">
                    <label for ="clientusername"><span style="color: red;">*</span>Username: (Check in FIM / WHD)</label>
                    <input type="text" class="form-control" name="clientusername" required autofocus>
                </div>
                <!--
                <div class="form-group">
                    <label for ="fullname">Full Name:</label>
                    <input type="text" class="form-control" name="fullname">
                </div>
                <div class="form-group">
                    <label for ="ustID">St. Thomas ID:</label>
                    <input type="text" class="form-control" name="ustID">
                </div>
                -->
                <div class="form-group">
                    <label for ="clientphone">Phone Number / Seconary email:</label>
                    <input type="text" class="form-control" name="clientphone">
                </div>
                <div class="form-group">
                    <label for ="location"><span style="color: red;">*</span>Location:</label>
                    <input type="text" class="form-control" name="location" required>
                </div>

                <!--Role Selection-->
                <div class="form-group">
                    <label for="roleselect">Role:</label>
                    <select class="form-control" id="roleselect" name="roleselect">
                        <option value="none">----</option>
                        <option value="Faculty/Staff">Faculty/Staff</option>
                        <option value="Student">Student</option>
                        <option value="Alumni">Alumni</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </fieldset><br>

            <!--Begin further details-->
            <fieldset id="details">
                <legend>Further Details:</legend>
                <div class="form-group">
                    <select class="form-control" id="typeselect" name="typeselect" > <!-- When changed, calls selection.js -->
                        <option id="none" value="None Applicable" selected>None Applicable</option>
                        <option id="hardware" value="Hardware">Hardware</option>
                        <option id="software" value="Software">Software</option>
                        <option id="printer" value="Printer">Printer</option>
                        <option id="network" value="Network">Network</option>
                        <option id="webpage" value="Webpage">Webpage</option>
                        <option id="showall" value="All Selected">Show All</option>
                    </select>
                </div>
                <!-- The following form entries are hidden by default, and are shown depending on the selction above -->
                <div class="form-group" id="asset_input">
                    <label for="assetnum">Asset Number:</label><br>
                    <input class="form-control" name="assetnum" id="assetnum" type="text" placeholder="A00012345"/>
                </div>
                <div class="form-group" id="hardware_input">
                    <label for="assetdesc">Asset Description:</label>
                    <input class="form-control" name="assetdec" id="assetdesc" type="text" placeholder="PC Desktop, iMac, etc."/>
                </div>
                <div class="form-group" id="software_input">
                    <label for="softwaredesc">Software Description:</label><br>
                    <input class="form-control" name="siftwaredesc" id="softwaredesc" type="text" placeholder="Word, Minitab, etc."/>
                </div>
                <div class="form-group" id="printer_input">
                    <label for="queuename">Queue Name:</label><br>
                    <input class="form-control" name="queuename" id="queuename" type="text" placeholder="OEC008-4048"/>
                    <br>
                    <label for="printerIP">Printer IP:</label><br>
                    <input class="form-control" name="printerIP" id="printerIP" type="text" placeholder="140.209.47.122"/>
                </div>
                <div class="form-group" id="web_input">
                    <label for="sitename">Website:</label><br>
                    <input class="form-control" name="sitename" id="sitename" type="text" placeholder="Blackboard, Murphy, etc."/>
                    <br>
                </div>
                <div class="form-group" id="network_input">
                    <p><strong>Be sure to ask for their location!</strong></p>
                    <label for="devicedesc">Device:</label><br>
                    <input class="form-control" name="devicedesc" id="devicedesc" type="text" placeholder="Computer, cell phone, etc."/>
                    <label for="connectionRadio">Connection Type:</label>
                    <div class="radio" id="connectionRadio">
                        <label><input type="radio" name="connectiontype" value="Wired"> Wired</label>
                        <label><input type="radio" name="connectiontype" value="Wireless"> Wireless</label>
                    </div>
                    <br>
                </div>
            </fieldset>
            <br><br>
    </div> <!-- End div for columns 2-3 -->

    <!--
    <--- Begin columns 4-5, containing Misc. Information and the final output of the form.
    <--- Also contains the Submit button and Reset button.
    --->
    <div class="col-md-2 text-left">
        <div class="col-md 12">
            <legend>&nbsp </legend>
            <div class="form-group" style="margin-bottom: 0px;">
                <label for="message">Misc. Notes:</label>
                <textarea class="form-control" name="miscnotes" rows="6" selected></textarea>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-12 col-sm-12" >
                <input type="hidden" name="createdBy" value="<?php echo $_SESSION['username'];?>">
                <input id="submitbutton" type="submit" class="btn btn-custom" value="Send Log" onclick="showLogs();">
            </div>
        </div>
        </form> <!--end of form-->

        <!--
<--- The iFrame below calls testInfoOutput.php, which takes the above form and formats it.
<--- Also provides a button that copies the text within it's textarea
--->
        <div class="row">
            <div class="infoiFrame" id="infoiFrameDiv" >
                <iframe name="infoiFrame" width="100%" height="257px" frameBorder="0" marginwidth="0px" scrolling="no" style="display:none;"></iframe>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <input form="clientInfoForm" id="resetbutton" type="reset" class="btn btn-danger" value="Reset Form" onclick="hideAll();">
            </div>
        </div>
    </div>	<!-- End div for columns 3-4 -->

    <!--
    <--- Begin columns 6-10, which holds tabs for Announcements, Active Logs, Notifications, and Troubleshooting
    --->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/includes/countNotifications.php'; ?>
    <div class="col-md-5 text-left">
        <div id="home_tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" id="ann-tab" href="#home">Announcements</a></li>
                <li><a data-toggle="tab" id="log-tab" href="#logs">Active Logs</a></li>
                <li><a data-toggle="tab" id="note-tab" href="#notifications">Notifications <?php echo $num_show; ?></a></li>
                <!--<li><a data-toggle="tab" id="trbshoot-tab" href="#trbshoot">Troubleshooting</a></li>-->
                <li><a data-toggle="tab" id="genresp-tab" href="#genresp">Generic Responses</a></li>

            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <iframe style="padding-top: 19px;" name="announcements" width="100%" height="690px" frameBorder="0" src="../announcements/ShowAnnouncement.php"></iframe>
                </div>
                <div id="logs" class="tab-pane fade">
                    <iframe id="logiFrame"  name="logiFrame" width="100%" height="690px" frameBorder="0" src="https://140.209.47.120/logs/miniLogIndex.php"></iframe>
                </div>
                <div id="notifications" class="tab-pane fade">
                    <iframe id="noteiFrame"  name="noteiFrame" width="100%" height="690px" frameBorder="0" src="../notifications/Notifications.php"></iframe>
                </div>
                <!--<div id="trbshoot" class="tab-pane fade">
                  <iframe style="padding-top: 3px;" name="mindmapiFrame" width="100%" height="690px" frameBorder="0" src="Freemind/TroubleshootingAssist.php"></iframe>
                </div>-->
                <div id="genresp" class="tab-pane fade">
                    <iframe style="padding-top: 3px;" name="genrespiFrame" width="100%" height="690px" frameBorder="0" src="../genericresponses/ShowResponses.php"></iframe>
                </div>


            </div>
        </div>
    </div>	<!-- End of div for columns 6-10 -->

    <!--
    ---- Begin columns 11-12, which holds tabs for Service Status, Twitter Feed, and Contact Info
    --->
    <div class="col-md-3 text-left">
        <div id="right_tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" id="service-status-tab" href="#srvstatus">Services Status</a></li>
                <li><a data-toggle="tab" id="twitter-tab" href="#twitter">Twitter</a></li>
                <li><a data-toggle="tab" id="contact-tab" href="#contact">Contact Info</a></li>
                <li><a data-toggle="tab" id="note-tab" href="#notes">Notes</a></li>
            </ul>

            <div class="tab-content">
                <div id="srvstatus" class="tab-pane fade in active">
                    <iframe style="padding-top: 3px;" name="srvstatusiFrame" width="100%" height="690px" frameBorder="0" src="../hostedpages/Services.php"></iframe>
                </div>
                <div id="twitter" class="tab-pane fade">
                    <a class="twitter-timeline" data-height="600" href="https://twitter.com/itstechdesk">Tweets by ITSsrvcstatus</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
                <div id="contact" class="tab-pane fade">
                    <iframe style="padding-top: 3px;" name="contactiFrame" width="100%" height="690px" frameBorder="0" src="../contacts/contactinfo.php" marginwidth="0px"></iframe>
                </div>
                <div id="notes" class="tab-pane fade">
                    <iframe style="padding-top: 3px;" name="noteiFrame" width="100%" height="690px" frameBorder="0" src="../hostedpages/showNotes.php" marginwidth="0px" scrolling="no"></iframe>
                </div>
            </div>
        </div>

    </div>
</div><!--End div for Bootstrap container rules-->
<iframe name="TimeoutCheat" src="../hostedpages/cheat.php" style="display:none;"></iframe>
<button id="start-tour" type="button" class="btn btn-link" onclick="startTour();"><i class="fa fa-question-circle fa-2x" aria-hidden="true"></i></button>
<a class="btn" id="changelog-link" href="https://140.209.47.120/changelog/showchangelog.php"><i class="fa fa-code-fork fa-2x" aria-hidden="true"></i></span></a>
<!-- Creates the footer, see file for details and modification -->
<?php
include $_SERVER["DOCUMENT_ROOT"] . '/includes/footer.php';
?>
<script>
    function showLogs() {
        $( '.nav-tabs a[href="#logs"]' ).tab('show');
        setTimeout(function(){document.getElementById("logiFrame").contentWindow.location.reload(true); }, 500);
    }
</script>
</body>
</html>