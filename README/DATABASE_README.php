<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php");
?>
----------------------
DATABASE DOCUMENTATION
----------------------
The database can be found at http://140.209.47.120/phpmyadmin

---------
RELATIONS
---------
announcements(count, date, title, author, message, visibility)
badges (id, name, prerequisites, icon)
badges_held (username, id)
bugs (id, submitted_by, url, note, status)
calendar_assignments(assignment_id, time_start, time_end, day, position_id, username)
calendar_positions(position_id, position_name)
contactFTE(id, full_name, location, position, desk_number, cell_number, grouping)
encyclopedia (count, author, vocab_term, topic, description, guide, keyword1, keyword2, keyword3, status, approvedBy, flaggedBy)
genericReponse(id, username, title, msg_body)
guides (topic, guide_name, filename, overview, body)
login (username, password, admin_status, new_user, role)
logs (id, username, log_text, date, current_status)
megalink (username, link1, link2, link3, link4, link5)
notifications(id, date_created, viewed, dismissed, username, title, message, all_admin)
test(test, text, date_created)
users (username, fname, lname, bio, img_path, badges_held)

-------------
announcements
-------------
count (int) primary key, auto increment variable.
date (timestamp) current timestamp at time of entry creation.
title (text) title of the sumbitted announcement.
author (author) author of the submitted announcement .
message (text) message to be announced. Will be in HTML format.
visibility (int) determines if the announcement is shown on the home page. 0 if not to be shown, 1 if otherwise.

------
badges
------
id (int) primary key, auto increment variable.
name (text) name of the badge.
prerequisites (text) prereqs for the badge.
icon (text) glyphicon of the badge.

-----------
badges_held
-----------
id (int) the id of the badge that the user is holding
username (varchar) username of the person that has the badge

----
bugs
----
id (int) primary key, auto increment variable.
submitted_by (varchar) username of person who submitted the bug.
url (varchar) location of the bug found.
note (text) description of the bug.
status (int) determines if the bug is open(1) or resolved(0).

--------------------
calendar_assignments
--------------------
assignment_id (int) primary key, auto increment variable
time_start (int) 24 hr representation of the time the user starts their shift
time_end (int) 24 hr representation of the time the user ends their shift
day (varchar) represents the days of the week that the assignment applies to; U=Sunday, M=Monday, T=Tuesday, W=Wednesday, R=Thursday, F=Friday, S=Saturday
position_id (int) the position that the assignment applies to; links calendar_positions with calendar_assignments
username (varchar) the username of the person the assignment applies to

------------------
calendar_positions
------------------
position_id (int) primary key, auto increment variable
position_name (text) the name of the position that users will be assigned to 

----------
contactFTE
----------
id (int) primary key, auto increment variable.
full_name (varchar) name of the indivudal who's info is being stored
location (varchar) either St. Paul or Minneapolis, location of employee's main office
position (varchar) description of individuals position in ITS
desk_number (varchar) the individual's St. Thomas desk phone number
cell_number (varchar) As above, but cell phone number
grouping (varchar) 1=Tech Desk and department numbers, 2=RRT, 3=EDT, 4=Local Tech, 5=Other

------------
encyclopedia
------------
count (int) primary key, auto increment variable.
author (varchar) username of the person submtting the entry.
vocab_term (varchar) the term they are defining.
topic (varchar) the overall topic of the term.
description (text) definition of the term.
guide (varchar) link to related guide.
keyword1 (varchar) related word.
keyword2 (varchar) related word.
keyword3 (varchar) related word.
status (text) denied(0), pending(1), flagged(2), or approved(3)
approvedBy (varchar) username of the superuser who most recently approved the word.
flaggedBy (varchar) username of the user who most recently flagged the word.

--------------
genericReponse
--------------
id (int) primary key, auto increment variable.
username (varchar) the username of the user who created the response
title (varchar) displayed title of the reponse
mesg_body (text) text to be displayed in the dropdown


------
guides
------
topic (text) the overall topic of the term.
guide_name (varchar) primary key, name of the guide.
filename (text) name of the guide without spaces for use in GET request URL.
overview (text) Description of the guide.
body (text) body of the guide in HTML format.

-----
login
-----
username (varchar) primary key
password (varchar) password associated with each username. Hashed.
admin_status (int) user(1), superuser(2), and admin(3).
new_user (int) defaults to 0 so that new users are brought to welcome page. Is then changed to 1, and is not changed again.
role (int) user role, inactive(0), student(1), or employee(2).

----
logs
----
id (int) primary key, auto increment variable.
username (varchar) author of the log.
log_text (text) body of the log.
date (timestamp) time/date at creation of log.
current_status (int) canceled(0), open(1), flagged(2), resolved(3).

--------
megalink
--------
username (varchar) primary key.
link1 (text) holds URL that is opened when the Mega Link is clicked.
link2 (text) holds URL that is opened when the Mega Link is clicked.
link3 (text) holds URL that is opened when the Mega Link is clicked.
link4 (text) holds URL that is opened when the Mega Link is clicked.
link5 (text) holds URL that is opened when the Mega Link is clicked.

-------------
notifications
-------------
id (int) primary key, auto increment variable.
date_created (timestamp) when the notification was created
viewed (int) 0=viewed, 1=not viewed. Determines whether "new" appears next to the notofication, and if a badge appears in the tab
dismissed (int) 0=dismissed, 1=not dismissed. Determines whether or not the notification shows up by default.
username (varchar) who the notification displays for
title (text) title for the notification
message (text) body of the notification, in HTML
all_admin (int) determines if the notification is for all admin users, default is 0=not all admin, 1=yes all admin. This is so that new users who register accounts can be approved quickly, and if these notifications are dismissed by one user then they are dismissed for all.

-----
users
-----
username (varchar) primary key.
fname (varchar) user's first name.
lname (varchar) user's last name.
bio (text) user's biography.
img_path (text) filepath for the user's bio image.
badges_held (text) list of badged held by the user.
