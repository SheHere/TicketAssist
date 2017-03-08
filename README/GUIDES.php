<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php"); 
?>

Ticket Assist Guides README

Written by Nick Scheel 10-4-2016

This document will be a guide on the purpose, fucntion, and design of the Guides section of the Ticket Assist webpage.

OVERVIEW
The purpose of the guides is to provide in depth knowledge relating to a variety of topics that are delt with by Tech Desk student workers. There is one central page, Guide.php, that pulls from the database information to populate itself. 

MODIFING
Guides can be created, edited, or deleted from NewGuide.php. When NewGuide.php is sent a toEdit GET request, it populates in the given guide for editing, and it can be deleted at at the bottom of the page. Only Admins and Superusers have access to this page.

Formatting:
- The title of the guide should also be the first section header, an h1 header. 
- The first subsection should be "Overview", which describes the purpose of the guide and any relevent background information. 
- any set of instructions should be a numbered list (eg. 1, 2, 3) while any subsets of instructions should be unordered 
- Pictures should be included throughout. This can be done with either Greenshot (which has an editing function built in) or the Snipping Tool. For Mac OSX, use Cmd+Shift+4 to take screen shots. Bigger images are better, as the CSS stylesheet shrinks them to fit. 