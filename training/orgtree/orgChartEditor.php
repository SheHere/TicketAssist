<?php include $_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"; ?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html>
<head>
	<title> Org Tree </title>
	<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
	<!-- Copyright 1998-2017 by Northwoods Software Corporation. -->
	<script src="go-debug.js"></script>
	<link rel="stylesheet" href="DataInspector.css"/>
	<script src="DataInspector.js"></script>
	<script src="tree-init.js"></script>
	<style>
		.row {
			margin-bottom: 25px;
		}
	</style>
</head>
<body onload="init()">
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>
<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
			<!-- White space on left 1/12th of the page -->
		</div>

		<div class="col-md-10 text-left">

			<h1>ITS Org Tree</h1>
			<div id="myDiagramDiv" style="background-color: #696969; border: solid 1px black; height: 500px"></div>
			<div>
				<div id="myInspector">

				</div>
			</div>
			<p>
				This editable organizational chart sample color-codes the Nodes according to the tree level in the hierarchy.
			</p>
			<p>
				Double click on a node in order to add a person or the diagram background to add a new parent_node. Double
				clicking the diagram uses the <a>ClickCreatingTool</a>
				with a custom <a>ClickCreatingTool.insertPart</a> to assign an ID.
			</p>
			<p>
				Drag a node onto another in order to change relationships.
				You can also draw a link from a node's background to other nodes that have no "parent_node". Links can also be
				relinked to change relationships.
				Right-click or tap-hold a Node to bring up a context menu which allows you to:
			<ul>
				<li>Vacate Position - remove the information specfic to the current person in that role</li>
				<li>Remove Role - removes the role entirely and reparents any children</li>
				<li>Remove Department - removes the role and the whole subtree</li>
			</ul>
			Deleting a Node or Link will orphan the child Nodes and generate a new tree. A custom SelectionDeleting <a>DiagramEvent</a>
			listener will clear out the parent_node info
			when the parent is removed.
			</p>
			<p>
				Select a node to edit/update node data values. This sample uses the Data Inspector extension to display and
				modify Part data.
			</p>
			<div>
				<div>
					<button id="SaveButton" onclick="save()">Save</button>
					<button onclick="load()">Load</button>
					Diagram Model saved in JSON format:
				</div>
				<textarea id="mySavedModel" style="width:100%;height:250px">
{ "class": "go.TreeModel",
  "nodeDataArray": [
{"key":1, "name":"Information Technology Services", "manager":"Dr. Edmund Clark", "comments":"undefined"},
{"key":2, "name":"Infrastructure", "manager":"William Bear", "parent":"1", "comments":""},
{"key":4, "name":"Service Delivery and Operations", "manager":"Jenn Haas", "parent":"1", "comments":""},
{"key":5, "name":"Support Services", "manager":"Gene Binfa", "parent":"4", "comments":""},
{"key":8, "name":"Computing Support Techs", "manager":"---", "parent":"5", "comments":""},
{"key":10, "name":"Technology Services", "manager":"Chris McDaniel", "parent":"4", "comments":""},
{"key":11, "name":"Student Workers", "manager":"---", "parent":"5", "comments":""},
{"key":12, "name":"Local Techs", "manager":"---", "parent":"10", "comments":""},
{"key":17, "name":"Information Security and Risk Managment", "manager":"Chris Gregg", "parent":"1", "comments":""},
{"key":18, "name":"Academic Technology", "manager":"Bret Coup", "parent":"1", "comments":""},
{"key":20, "name":"Event Support", "manager":"Rick Hendrickson", "parent":10, "comments":""},
{"key":21, "name":"Library Technology", "manager":"Brian Hill", "parent":"5", "comments":""},
{"key":22, "name":"Library Student Workers", "manager":"---", "parent":"21", "comments":""},
{"key":3, "name":"STELAR", "manager":"Peter Weinhold", "parent":"18", "comments":""},
{"key":6, "name":"Classroom / AV Technology", "manager":"Dan Hoistington", "parent":"18", "comments":""},
{"key":7, "name":"Security", "manager":"---", "parent":"17", "comments":""},
{"key":9, "name":"Budget and Acquisitions", "manager":"Paul Kozak", "parent":"17", "comments":""},
{"key":13, "name":"Software", "manager":"Tom Oscanyan", "parent":"9", "comments":""},
{"key":14, "name":"Hardware", "manager":"Dave Braun and Jerry Schwartz", "parent":"9", "comments":""},
{"key":15, "name":"Infrastructure Services (IS)", "manager":"Mike Reinhart", "parent":"2", "comments":""},
{"key":16, "name":"Networking", "manager":"Dan Strojny", "parent":"2", "comments":""},
{"key":19, "name":"Telecom", "manager":"Rick Lucius", "parent":"2", "comments":""}
 ]}
    </textarea>
			</div>


		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
?>
</body>
</html>
