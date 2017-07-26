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
----
--->
<html lang="en">
<head>
    <title>Ticket Assist</title>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
    fullHeader();
    ?>
    <script src="../js/AssistantScripts.js"></script>
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
            margin: 17px 0px 0px;
        }
        th {
            font-weight: normal;
        }
        #ie_notice {
            color: red;
        }
        .hidden-iframe {
            display: none;
        }
        .tab-iframe {
            width: 100%;
            height: 690px;
            border: none;
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
        <h1 style="margin-bottom: 3px;">Ticket Assist</h1>
        <p id="ie_notice">Warning: Ticket Assist is not optimized for Internet Explorer. Please use Firefox or Chrome!</p>
    </div>

    <!--
    <--- Begin columns 2-3, containing Client Information and Further Details sections of the form.
    <--- The form is continued and submitted in the next set of columns.
    --->
    <div class="col-md-2 col-xs-6 text-left">
        <form id="clientInfoForm" method="post" action="sendLog.php" target="infoiFrame">
            <!-- Begin client info section-->
            <fieldset id="clientinfo">
                <legend>Client Information:</legend>
                <div class="form-group">
                    <label for="clientusername">Username: (Check in FIM / WHD)</label>
                    <input class="form-control" name="clientusername" autofocus>
                </div>
                <div class="form-group">
                    <label for="clientphone">Phone Number / Secondary email:</label>
                    <input class="form-control" name="clientphone">
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input class="form-control" name="location">
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
            </fieldset>

            <!--Begin further details-->
            <fieldset id="details">
                <legend>Further Details:</legend>
                <div class="form-group">
                    <select class="form-control" id="typeselect" name="typeselect">
                        <!-- When changed, calls selection.js -->
                        <option id="none" value="None Applicable" selected>None Applicable</option>
                        <option id="hardware" value="Hardware">Hardware</option>
                        <option id="software" value="Software">Software</option>
                        <option id="printer" value="Printer">Printer</option>
                        <option id="network" value="Network">Network</option>
                        <option id="webpage" value="Webpage">Webpage</option>
                        <option id="showall" value="All Selected">Show All</option>
                    </select>
                </div>

                <!-- The following form entries are hidden by default, and are shown depending on the selection above -->
                <div class="form-group" id="asset_input">
                    <label for="assetnum">Asset Number:</label>
                    <input class="form-control" name="assetnum" id="assetnum" placeholder="A00012345"/>
                </div>

                <div class="form-group" id="hardware_input">
                    <label for="assetdesc">Asset Description:</label>
                    <input class="form-control" name="assetdec" id="assetdesc" placeholder="PC Desktop, iMac, etc."/>
                </div>

                <div class="form-group" id="software_input">
                    <label for="softwaredesc">Software Description:</label>
                    <input class="form-control" name="siftwaredesc" id="softwaredesc" placeholder="Word, Minitab, etc."/>
                </div>

                <div class="form-group" id="printer_input">
                    <div class="form-group">
                        <label for="queuename">Queue Name:</label>
                        <input class="form-control" name="queuename" id="queuename" placeholder="OEC008-4048"/>
                    </div>
                    <div class="form-group">
                        <label for="printerIP">Printer IP:</label>
                        <input class="form-control" name="printerIP" id="printerIP" placeholder="140.209.47.122"/>
                    </div>
                </div>

                <div class="form-group" id="web_input">
                    <label for="sitename">Website:</label>
                    <input class="form-control" name="sitename" id="sitename" placeholder="Blackboard, Murphy, etc."/>
                </div>

                <div class="form-group" id="network_input">
                    <p><strong>Be sure to ask for their location!</strong></p>
                    <div class="form-group">
                        <label for="devicedesc">Device:</label>
                        <input class="form-control" name="devicedesc" id="devicedesc" placeholder="Computer, cell phone, etc."/>
                    </div>
                    <div class="form-group">
                        <label for="connectionRadio">Connection Type:</label>
                        <div class="radio" id="connectionRadio">
                            <label><input type="radio" name="connectiontype" value="Wired">Wired</label>
                            <label><input type="radio" name="connectiontype" value="Wireless">Wireless</label>
                        </div>
                    </div>
                </div>
            </fieldset>
    </div>

    <!--
    <--- Begin columns 4-5, containing Misc. Information and the final output of the form.
    <--- Also contains the Submit button and Reset button.
    --->
    <div class="col-md-2 col-xs-6 text-left">
        <div class="col-md 12">
            <legend>&nbsp</legend>
            <div class="form-group" style="margin-bottom: 0px;">
                <label for="message">Misc. Notes:</label>
                <textarea class="form-control" name="miscnotes" rows="12"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <input type="hidden" name="createdBy" value="<?php echo $_SESSION['username']; ?>">
                <input id="submitbutton" type="submit" class="btn btn-custom" value="Send Log" onclick="showLogs();">
            </div>
        </div>
        </form>

        <!--
        <--- The iFrame below calls testInfoOutput.php, which takes the above form and formats it.
        <--- Also provides a button that copies the text within it's textarea
        --->
        <div class="row">
            <div class="infoiFrame" id="infoiFrameDiv">
                <iframe class="hidden-iframe" name="infoiFrame" width="100%" height="257px" frameBorder="0" marginwidth="0px" scrolling="no"></iframe>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <input form="clientInfoForm" id="resetbutton" type="button" class="btn btn-danger" value="Reset Form"
                       onclick="form.reset(); hideAll();">
            </div>
        </div>
    </div>

    <!--
    <--- Begin columns 6-10, which holds tabs for Announcements, Active Logs, Notifications, and Troubleshooting
    --->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/includes/countNotifications.php'; ?>
    <div class="col-md-5 col-xs-12 text-left">
        <div id="home_tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" id="ann-tab" href="#home">Announcements</a></li>
                <li><a data-toggle="tab" id="log-tab" href="#logs">Active Logs</a></li>
                <li><a data-toggle="tab" id="note-tab" href="#notifications">Notifications <?php echo $num_show; ?></a></li>
                <li><a data-toggle="tab" id="genresp-tab" href="#genresp">Generic Responses</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <iframe class="tab-iframe" style="padding-top: 10px;" name="announcements" src="../announcements/ShowAnnouncement.php"></iframe>
                </div>
                <div id="logs" class="tab-pane fade">
                    <iframe id="logiFrame" class="tab-iframe" name="logiFrame" src="../logs/miniLogIndex.php"></iframe>
                </div>
                <div id="notifications" class="tab-pane fade">
                    <iframe id="noteiFrame" class="tab-iframe" name="noteiFrame" src="../notifications/Notifications.php"></iframe>
                </div>
                <div id="genresp" class="tab-pane fade">
                    <iframe class="tab-iframe" name="genrespiFrame" src="../genericresponses/ShowResponses.php"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!--
    ---- Begin columns 11-12, which holds tabs for Service Status, Twitter Feed, and Contact Info
    --->
    <div class="col-md-3 col-xs-12 text-left">
        <div id="right_tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" id="service-status-tab" href="#srvstatus">Services Status</a></li>
                <li><a data-toggle="tab" id="twitter-tab" href="#twitter">Twitter</a></li>
                <li><a data-toggle="tab" id="contact-tab" href="#contact">Contact Info</a></li>
                <li><a data-toggle="tab" id="note-tab" href="#notes">Notes</a></li>
            </ul>

            <div class="tab-content">
                <div id="srvstatus" class="tab-pane fade in active">
                    <iframe class="tab-iframe" name="srvstatusiFrame" src="../hostedpages/Services.php"></iframe>
                </div>
                <div id="twitter" class="tab-pane fade">
                    <a class="twitter-timeline" data-height="600" href="https://twitter.com/itstechdesk">Tweets by ITSsrvcstatus</a>
                    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
                <div id="contact" class="tab-pane fade">
                    <iframe class="tab-iframe"  name="contactiFrame" src="../contacts/contactinfo.php"></iframe>
                </div>
                <div id="notes" class="tab-pane fade">
                    <iframe class="tab-iframe" name="noteiFrame" src="../hostedpages/showNotes.php" scrolling="no"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Forces the page to ignore the auto timeout -->
<iframe class="hidden-iframe" name="TimeoutCheat" src="../hostedpages/cheat.php"></iframe>

<button id="start-tour" type="button" class="btn btn-link" onclick="startTour();"><i class="fa fa-question-circle fa-2x"></i></button>
<a class="btn" id="changelog-link" href="https://tdta.stthomas.edu/changelog/showchangelog.php"><i class="fa fa-code-fork fa-2x"></i></span></a>

<!-- Creates the footer, see file for details and modification -->
<?php
include $_SERVER["DOCUMENT_ROOT"] . '/includes/footer.php';
?>

</body>
</html>