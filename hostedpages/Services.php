<?php include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php"); ?>
<!DOCTYPE html>


<!--
<--- Services.php - Written by Nick Scheel - November 2016
<--- Displays serice status as seen at the link here: http://www.stthomas.edu/its/servicecatalog/
<--- Code was stripped directly from the page source found at the link above.
<---
--->

<html lang="en">
<head>
    <title>Services</title>

    <link rel="stylesheet" href="../styles/services.css">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
    fullHeader();
    ?>
    <!-- Sets the default column height to 100% -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
    <base target="_blank"/>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <br><span style="color: #1a7934 !important;"><strong>Green</strong></span> = no issue, <span
                    style="color: #f1c40f;"><strong>Yellow</strong></span> = minor issue , <span
                    style="color: #cc2329;"><strong>Red</strong></span> = major issue.</p>
            <div class="clearfix left-content-item main-body-titleless"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div id="Network" class="itsservice green">
                <div id="networkServiceStatus" class="itservice-box">
                    <h3>Network</h3>
                </div>
                <div class="serviceMessage"></div>
                <div class="moreInfo">
                    <a data-category="Button" data-action="Service Status Dashboard" data-label="Network"
                       href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Network&src=typd"
                       class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="Email" class="itsservice green">
                <div id="email365ServiceStatus" class="itservice-box">
                    <h3>Email</h3>
                </div>
                <div class="serviceMessage"></div>
                <div class="moreInfo">
                    <a data-category="Button" data-action="Service Status Dashboard" data-label="Email"
                       href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Email&src=typd"
                       class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="Blackboard" class="itsservice green">
                <div id="blackboardServiceStatus" class="itservice-box">
                    <h3>Blackboard</h3>
                </div>
                <div id="blackboardServiceMessage" class="serviceMessage"></div>
                <div class="moreInfo">
                    <a data-category="Button" data-action="Service Status Dashboard" data-label="Blackboard"
                       href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Blackboard&src=typd"
                       class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div id="Murphy" class="itsservice green">
                <div id="murphyServiceStatus" class="itservice-box">
                    <h3>Murphy</h3>
                </div>
                <div id="murphyServiceMessage" class="serviceMessage"></div>
                <div class="moreInfo">
                    <a data-category="Button" data-action="Service Status Dashboard" data-label="Murphy"
                       href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Murphy&src=typd"
                       class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="Telephone" class="itsservice green">
                <div id="telephoneServiceStatus" class="itservice-box">
                    <h3>Phones</h3>
                </div>
                <div id="telephoneServiceMessage" class="serviceMessage"></div>
                <div class="moreInfo">
                    <a data-category="Button" data-action="Service Status Dashboard" data-label="Telephone"
                       href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Telephone&src=typd"
                       class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="Printing" class="itsservice green">
                <div id="printingServiceStatus" class="itservice-box">
                    <h3>Printing</h3>
                </div>
                <div id="printingServiceMessage" class="serviceMessage"></div>
                <div class="moreInfo">
                    <a data-category="Button" data-action="Service Status Dashboard" data-label="Printing"
                       href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Printing&src=typd"
                       class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div id="Web" class="itsservice green">
                <div id="webServiceStatus" class="itservice-box">
                    <h3>Web</h3>
                </div>
                <div id="webServiceMessage" class="serviceMessage"></div>
                <div class="moreInfo">
                    <a data-category="Button" data-action="Service Status Dashboard" data-label="Web"
                       href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Web&src=typd"
                       class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="Office365" class="itsservice green">
                <div id="office365ServiceStatus" class="itservice-box">
                    <h3>Office 365</h3>
                </div>
                <div class="serviceMessage"></div>
                <div class="moreInfo">
                    <a data-category="Button" data-action="Service Status Dashboard" data-label="Office 365"
                       href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Office365&src=typd"
                       class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="Other" class="itsservice green">
                <div id="otherServiceStatus" class="itservice-box">
                    <h3>Other</h3>
                </div>
                <div id="otherServiceMessage" class="serviceMessage"></div>
                <div class="moreInfo">
                    <a data-category="Button" data-action="Service Status Dashboard" data-label="Other"
                       href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Other&src=typd"
                       class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call script to check if services are down or not -->
<script type="text/javascript">

    function updateServices() {
        var itsServices = ["Network", "Email", "Office365", "Blackboard", "Phones", "Murphy", "Printing", "Web", "Other"];
        var TwitterSearch = "https://blogs.stthomas.edu/wp-content/twitter.php?url=search&q=itssrvcstatus%20%23Other%20OR%20%23Printing%20OR%20%23Blackboard%20OR%20%23Network%20OR%20%23Web%20OR%20%23Murphy%20OR%20%23Phones%20OR%20%23Office365%20OR%20%23Email";

        jQuery.ajax({
            url: TwitterSearch,
            dataType: 'json',
            success: function (data) {
                var statuses = [];

//			$.each(itsServices, function(i) {
//				console.log("Services:"+itsServices[i]);

                $.each(data["statuses"], function (x) {
                    var messageDate = this["created_at"];
                    var UTCoffset = this["utc_offset"];
                    var UTCoffsetValue = UTCoffset / 3600;
                    var tweetdate = new Date(messageDate);
//					tweetdate = tweetdate + UTCoffsetValue;
                    var friendlyDate = tweetdate;

//only show it tweet was within last 24 hours
                    tweetdate = tweetdate.getTime() / 1000;
                    var ts = Math.round(new Date().getTime() / 1000);
                    var tsYesterday = ts - (24 * 3600);
                    var showMessage = 0;

                    if (tweetdate > tsYesterday) {
                        //show msg
                        showMessage = 1;
//						messageDate=messageDate.substring(0,messageDate.indexOf("+"));
                        messageDate = messageDate.substring(0, 10);
                        var serviceMessage = '<span class="itservice-date">' + messageDate + '</span><br />' + this["text"];
                    }
                    var serviceStatus = "";
                    var currentService = "";
                    var hashtags = this["entities"]["hashtags"];
                    var currentHash;

                    $.each(hashtags, function () {
                        currentHash = this["text"];
                        if (itsServices.indexOf(currentHash) > -1) {
                            currentService = currentHash;
                            var index = itsServices.indexOf(currentService);
                            if (index > -1) {
                                itsServices.splice(index, 1);
                                //remove the service since we had a match
                            }
                        }

                        if (currentHash.toLowerCase() === "green" || currentHash.toLowerCase() === "red" || currentHash.toLowerCase() === "yellow") {
                            serviceStatus = this["text"].toLowerCase();
                            if ((currentService != "") && (serviceStatus != "")) {
                                $("#" + currentService).removeClass("green");
                                $("#" + currentService).addClass(serviceStatus);
                            }
                        }
                    });
                    if ((currentService != "") && (serviceStatus != "") && (showMessage)) {
                        $("#" + currentService + " div.serviceMessage").html(serviceMessage);
                        $("#" + currentService + " div.moreInfo").show();
                    }

                });
            }
        });

    }
    ;

    updateServices();
    setInterval(updateServices, 60000);

</script>
</body>
</html>





