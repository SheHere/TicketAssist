<?php
	/*
	 * This file is used to generate a standard <head> for pages that are to be visited, NOT iFrames.
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
?>