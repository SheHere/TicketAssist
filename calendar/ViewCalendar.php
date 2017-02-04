<?php
  include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Calendar</title>
<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
?>
	<link rel="stylesheet" href="../styles/calendar.css">

</head>

<body>
  <?php
		include '../includes/navbar.php';
	?>
  <div class="container-fluid fill_minus_nav">
    <div class="col-md-12 fill">
      <div class="row fill">
        <!--
        -URL Parameter
        -Effect
        -Default

        -wdHideSheetTabs=True
        -Hides the sheet tabs that are displayed at the bottom of all sheets in a workbook.
        -False

        -wdAllowInteractivity=True
        -Lets you interact with the data if your workbook has a table or PivotTable that can be sorted and filtered.
        -True

        -Item=itemName
        -Displays a specific item. If your workbook includes a chart, table, PivotTable, or named range, and you want to display only one of the items in your web page, use the Item parameter to specify that item. For information about named ranges and named items in Excel workbooks see Define and use names in formulas.
        -Not set

        -ActiveCell=CellName
        -Specifies the active (selected) cell in the embedded workbook when the web page opens. You can specify the active cell by cell reference (such as A1) or by name.
          You can also use this parameter to define the active sheet by selecting a cell in that sheet. If you want to select a Power View sheet as active, set this parameter to A1, even though there is no grid on a Power View sheet.
          If you don't specify the active cell, the last saved view will be shown.
        -The last saved view will be shown.

        -wdHideGridlines=True
        -Hides worksheet gridlines for a cleaner look.
        -False

        -wdHideHeaders=True
        -Hides the column and row headers.
        -False

        -wdDownloadButton=True
        -Includes the Download button so viewers can download their own copy of the workbook.
        -False
        -->

        <iframe frameborder="0" scrolling"no" src="https://uofstthomasmn-my.sharepoint.com/personal/inge0019_stthomas_edu/_layouts/15/guestaccess.aspx?docid=0fc4daaaa53094b1282c49f26fb4a3138&authkey=AcYvhp6ANgcGam30mmKhkwI&rev=1&action=embedview">
      </div>
    </div>
  </div>

  <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
  ?>
</body>
</html>
