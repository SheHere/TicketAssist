<?php
	include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php");
	//Set variables
	$ret = "";
	$username = $_POST['createdBy'];
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
	echo '\n'.$textToStore;
	
	
	
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	//Get the username of the person currently logged in.
	
	//Create query to insert into database.
	$query = "INSERT INTO `logs` (id, username, log_text, date) VALUES (NULL, '$username', '$textToStore', CURRENT_TIMESTAMP)";
	echo "\n Query sent.";
	//Check the result of adding it to the database.
	$result = mysqli_query($con,$query);
	
	//Displays any errors
	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo '<script> parent.errorAlert("Log could not be sent. Please see an administrator.","https://tdta.stthomas.edu/assistant/assistant.php");</script>';
		echo mysqli_error($con);
	}else{
		'<html>
		<script>
			parent.document.getElementById("logiFrame").contentWindow.location.reload(true);
		</script>
		</html>';
		
	}
	?>