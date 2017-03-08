<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php");

?>
TICKET ASSIST CHANGELOG

2016
======================================================

_____November_____
11/30:
  - Created README/CHANGELOG.php
  - Added tour to index.php
  - Began the tour for assistant.php

_____December_____
12/1:
	- Continued the tour for assistant.php
12/2:
	- Completed the tour for assistant.php
	- Verified that the automated SQL entries work
	- Deleted 14,000 automated SQL entries...
	- Began the tour for GuideIndex.php
12/5:
	- Began implimentation of notifications in Test Assistant.
		- Created relation `notifications` in the database
		- Created directory `notification`, which contains asociated files
		- Added notifications.css in /styles
	- Added query in RequestAccess.php which creates notification for admins
	- Fixed automated SQL entries (was sending request every minute between 8:00pm and 9:00pm)
	- Added flashy title
	- Added a dynamic way to create notifications (notifications/NewNotification.php)
12/6
	- Changed variable names in NewNotification.php for clarity
	- Added notifications in sendBug.php that are delivered to sche0210 and inge0019
	- Added notifications to inform a user when admin removed their bio/picture
	- Began the implementation of a calendar system (calendar/CalendarIndex.php, calendar/CalendarFunctions.php, styles/calendar.css)
12/7
	- Added page to push notifications to all users (notifications/NotifyAll.php)
	- Changed Ticket Assist form to include a misc notes section and removed "full name" and "UST ID", also made "Phone Number" to "Phone Number / Secondary Email"
	- Made more changes to the calendar
		- Created database structure for the calendar
		- Completed formatting for the calendar
12/9
	- Adjusted styling for the login page on Firefox and Internet Explorer
		- Fixed centering issues with the Request Access link
	- Added a sidebar to the calendar section to hold specific links
	- Finished the ModifyPositions and ModifyShifts sections for the calendar
12/12
	- Readded the tour to assistant.php and updated it to include the Notifications tab

2017
======================================================

_____January_____
1/1 - 1/30
	- Created the entirety of the dynamic calendar in the calendar folder
	- Added the favorite color button under user settings to be used by the dynamic calendar

1/23
	- Changed all pages to generate the head section from CreateHeader.php, and included file
	- Updated READMEs

_____Febuary_____
2/9
	- Readded the tour to assistant.php (for the fourth time...) and updated it to include the Generic Responses tab
	- Updated user settings to where the favorite color button will pull the initial color from the server and update without a second button
	- Added a note in the first time setup page to state that a tutorial can be found on the home page
2/13
	- Edited the tutorial on the assistant.php to have the twitter section be on the left and to fix a typo
2/15
	- Fixed the delete badge button not working in Firefox on the badges page
	
