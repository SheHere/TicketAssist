<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php"); 
?>

USER ACCESS README

Written by Nick Scheel on 10-13-16

OVERVIEW
Users are broken up into three groups. There are users, superusers, and admins. Each has greater access then the one preceding it. 


PERMISSIONS
Users
	- Log in
	- Access homepage, student roster, and the knowledge base (guides)
	- Access their own logs*
	- In User Settings: change their own password and personal information*
Superusers
	- All of above
	- Create new users
	- Update announcments*
	- Update schedule*
	- Access READMEs
Admin
	- All of the above
	- Access all user logs
	- Change all user settings (cannot see passwords, but can change them)

Note that all of this is pending approval from Binfa. More may be added, and some options will be elevated or removed. 