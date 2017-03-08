<?php
/*
 * To provide consistant and pervasive changes to all pages, this file allows for standard library imports 
 * to the <head> section of every page. For any page that is to be visited, and doesn't have a datatable,
 * use the fullHeader() function. If the page DOES have a datatable, use the datatablesHeader() function.
 * If the page is to be hosted in an iFrame, use the reducedHeader() function. 
 */

function fullHeader(){
	/*
	 * This function is used to generate a standard <head> for pages that are to be visited, NOT iFrames.
	 */
	echo'
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	';
	/*
	 * Included scripts:
	 * JQuery
	 * Bootstrap
	 * Sweetalert
	 * Password Generator
	 * Alerts (custom SweetAlert functinos)
	 */
	echo'
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://140.209.47.120/sweetalert-master/dist/sweetalert.min.js"></script>
	<script src="https://140.209.47.120/js/PasswordGenerator.js"></script>
	<script src="https://140.209.47.120/js/alerts.js"></script>
	';
	/*
	 * Included Stylesheets:
	 * Bootstrap
	 * Font-Awesome
	 * Sweetalert
	 * standard styles (assistant.css)
	 */
	echo'
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://140.209.47.120/styles/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://140.209.47.120/sweetalert-master/dist/sweetalert.css">
	<link rel="stylesheet" href="https://140.209.47.120/styles/assistant.css">
	';
}

function reducedHeader(){
	/*
	 * This function is used to generate a standard header on pages that are to be hosted in iFrames, NOT full pages.
	 */
	echo'
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	';
	/*
	 * Included Stylesheets:
	 * Bootstrap
	 * Font-Awesome
	 * Sweetalert
	 * standard styles (assistant.css)
	 */
	echo'
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://140.209.47.120/styles/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://140.209.47.120/styles/assistant.css">
	';
	/*
	 * Included scripts:
	 * JQuery
	 * Bootstrap
	 * Sweetalert
	 * Password Generator
	 * Alerts (custom SweetAlert functinos)
	 */
	echo'
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	';
}
function datatablesHeader(){
		/*
	 * This function is used to generate a standard <head> for pages that are to be visited, NOT iFrames.
	 */
	echo'
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	';
	/*
	 * Included Stylesheets:
	 * Bootstrap
	 * Font-Awesome
	 * Sweetalert
	 * standard styles (assistant.css)
	 */
	echo'
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://140.209.47.120/styles/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://140.209.47.120/sweetalert-master/dist/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/r-2.1.0/se-1.2.0/datatables.min.css"/>
	<link rel="stylesheet" href="https://140.209.47.120/styles/assistant.css">
	';
	/*
	 * Included scripts:
	 * JQuery
	 * Bootstrap
	 * Sweetalert
	 * Password Generator
	 * Alerts (custom SweetAlert functinos)
	 */
	echo'
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/r-2.1.0/se-1.2.0/datatables.min.js"></script>
	<script src="https://140.209.47.120/sweetalert-master/dist/sweetalert.min.js"></script>
	<script src="https://140.209.47.120/js/PasswordGenerator.js"></script>
	<script src="https://140.209.47.120/js/alerts.js"></script>

	';
}

?>