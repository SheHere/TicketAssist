<?php include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php"); ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/assistant.css">
<style>
body {
	margin-left: 0px;
	margin-right: 0px;
}
</style>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/jquery-3.1.1.min.js"></script>
</head>

<body>
<!-- infoOutput.php
<--- Created by Nick Scheel and Chase Ingebritson
<--- St. Thomas ITS Tech Desk 2016
<---
<--- This file is intended to work as an output program, displaying 
<--- and formatting entries submitted via form from index.html
<---
<--- There are two cases for text below. The first is the situation where
<--- we want to display the description regardless of whether or not
<--- data was provided for that input. An example of this is Username.
<--- The second is the sitiation where we want to only display the description
<--- if the user provided input. An example of this is Phone Number. All of this
<--- text will be outputed to an iFrame below the original form, and will be sent
<--- to a textarea so that it can be edited easily and copy/pasted easily. 
--->

<!-- List of All Variables
<--- Username - clientusername
<--- Full Name - fullname
<--- St. Thomas ID - ustID
<--- Phone Number - clientphone
<--- Location - location
<--- Role - roleselect
<--- Request Type - typeselect
<--- Asset Number - assetnum
<--- Asset Description - assetdesc
<--- Software Description - softwaredesc
<--- Queue Name - queuename
<--- Printer IP - printerIP
<--- Webpage Name - sitename
<--- Device Type - devicetype
<--- Connection Type - connectiontype
<--- Misc. Notes - miscnotes
<--- 
--->
<?php
	//Set variables
	$ret = "";
	$clientusername = $_POST["clientusername"];
	$fullname = $_POST["fullname"];
	$ustID = $_POST["ustID"];
	$clientphone = $_POST["clientphone"];
	$location = $_POST["location"];
	$roleselect = $_POST["roleselect"];
	$typeselect = $_POST["typeselect"];
	$assetnum = $_POST["assetnum"];
	$assetdesc = $_POST["assetdesc"];
	$softwaredesc = $_POST["softwaredesc"];
	$queuename = $_POST["queuename"];
	$printerip = $_POST["printerIP"];
	$devicedesc = $_POST["devicedesc"];
	$connectiontype = $_POST["connectiontype"];
	$sitename = $_POST["sitename"];
	$miscnotes = $_POST["miscnotes"];
	
	//Example of first scenario described above.
	//Print username or print "none given" if not provided.
	$ret .= "Username: ";
	if($clientusername > ""){
		$ret .=  ($clientusername . "\n");
	}else{ 
		$ret .= "\n";
	}
	//Example of second scenario described above.
	//Print client name only if provided.
	if($fullname > ""){
		$ret .= ("Full Name: " . $fullname . "\n");
	}
	//Print ID number only if provided.
	if($ustID > ""){
		$ret .= ("ID Number: " . $ustID . "\n");
	}
	//Print Phone Number only if provided. 
	if($clientphone > ""){
		$ret .= ("Phone Number: " . $clientphone . "\n");
	}
	//Print location, or print OEC Room if not provided.
	$ret .= "Location: ";
	if($location > ""){
		$ret .= ($location . "\n");
	}else{ 
		$ret .= "----\n";
	}
	//Print client role, or "----" if not provided.
	$ret .= "Role: ";
	if($roleselect !== "none"){
		$ret .= ($roleselect . "\n");
	}else{ 
		$ret .= "----\n";
	}
	
	
	//Print type, will always have value provided.
	$ret .= ("Ticket Type: " . $typeselect . "\n"); 
	//Print asset number only if provided.
	if($assetnum > ""){
		$ret .= ("Asset Number: " . $assetnum . "\n");
	}
	//Print asset description only if provided.
	if($assetdesc > ""){
		$ret .= ("Asset Description: " . $assetdesc . "\n");
	}
	//Print software description only if provided
	if($softwaredesc > ""){
		$ret .= ("Software Description: " . $softwaredesc . "\n");
	}
	//Print printer name only if provided.
	if($queuename > ""){
		$ret .= ("Queue Name: " . $queuename . "\n");
	}
	//Print printer IP only if provided.
	if($printerip > ""){
		$ret .= ("Printer IP: " . $printerip . "\n");
	}
	//Print device type only if provided.
	if($devicedesc > ""){
		$ret .= ("Device Type: " . $devicedesc . "\n");
	}
	//Print connection type only if provided. (Can only be Wired or Wireless)
	if($connectiontype > ""){
		$ret .= ("Connection Type: " . $connectiontype . "\n");
	}
	//Print webpage name only if provided.
	if($sitename > ""){
		$ret .= ("Webpage Name: " . $sitename . "\n");
	}
	//Print Misc notes, will leave empty if not provided.
	$ret .= ("Misc. Notes: " . $miscnotes . "\n");
	
	
	//modify ret to retain new lines
	$textToStore = nl2br(htmlentities($ret, ENT_QUOTES, 'UTF-8'));	
	
	?>
<div class="col-md-12">
<form id="totform" action="submitLog.php" method="post" target="iFrame1">
<div class="form-group" style="margin-bottom: 3px;">
	<label for="message">Editor:</label>
	<textarea class="form-control" name="message" rows="7" selected><?php echo $ret ?></textarea>
</div>
	<br>
	<input form="totform" id="sendbutton" type="submit" class="btn btn-block btn-custom" value="Send Log" onclick="parent.myFunction();">

	</div>
</form>
<iframe name="iFrame1" style="display: none;" width="100%" height="335px" frameBorder="0" marginwidth="0px"></iframe>


</div>	
</body>
	<script>
		parent.document.getElementById("logiFrame").contentWindow.location.reload(true);
	</script>
</html> 