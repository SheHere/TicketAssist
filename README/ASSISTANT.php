<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php"); 
?>

TICKET ASSIST README

Written by Nick Scheel 9-28-2016

This document will be a guide on the purpose, fucntion, and design of the Tech Desk Ticket Assist webpage. It can be found at http://140.209.47.120/Assistant.php (IP liable to change).

SOURCES
This file was made using HTML, PHP, CSS, and Javascript as the base languages. In addition to this, the following are being imported:
Bootstrap - Framework for HTML, CSS, and Javascript that is responsible for the layout and appearance of the site. Both a stylesheet and a Javascript library are imported in the head of this webpage. Source: http://getbootstrap.com/
JQuery - enhances Javascript, allows for increased interactivity and creates easily accessible pre-built functions. Found at https://jquery.com/


OVERVIEW
Assistant.php is the home page for the Ticket Assist project. Its purpose is to present a number of services for ease of access for Tech Desk student workers. These services are broken up into sections with Bootstrap, and will be discussed below.

Service 1 - Navbar
The first service is the Navbar, found at the top of the page. It contains links to internal sites, and also a list of Tech Desk resources that are external. There is also a Home button, and a Logout button.

Service 2 - Ticket Assist
The primary service is a fillable form called Ticket Assist. A student worker will use this form to take notes during any interaction with an end user. The purpose is to ensure that all necessary information is gathered and included in the Web Help Desk ticket. Information from the form is sent into the "Editor", where the student can make final changes and then send the log. When the log is sent, it goes into the database, and can be found in the Log Index page or the Active Logs section on the home page. 
 
Service 3 - Center Tabs
The center of the homepage is a series of clickable tabs. They are as follows:
Announcements - Admin users can publish announcements that will be displayed here.
Active Logs - displays all logs that are marked as Open
Notifications - notification center, where users will be alerted when Admins make changes to their account, and admins will be notified when new users register for an account.
Troubleshooting - holds the troubleshooting mind map, currently incomplete
Generic Repsonses - holds pre-written email replies that can be edited by the user.

Service 4 - Right Tabs
Another series of clickable tabs. They are as follows:
Service Status - Checks the service status twitter account and shows whether or not various services are functioning. 
Twitter - Tech Desk twitter feed
Contact Info - contact information for full time techs.  


LAYOUT
The page is broken into 12 collumns by Bootstrap. The allocation of this collumns is as follows, going from left to right:
1-2 Client Information and Further Details
3-4 - Misc notes, editor, and submit button
4-9 Center tabs
10-12 Right Tabs
 

MODIFYING 
Before making changes to Assistant.php, first make changes in TestAssistant.php and make sure that there are no unintended bugs. When you are content, copy>paste the contents of the test page into the main page.