#Ticket Assist Homepage

---

##Overview
The core purpose for the Ticket Assist site is to increase productivity, facilitate communication, and provide useful resources to the Tech Desk student workers. To achieve this, the Ticket Assist homepage is chock-full of useful tools and references.
After logging in, a user is directed to the homepage (assistant.php). It is made up of the Ticket Assist log form, and two series of tabbed frames. The form is a part of the homepage directly, but the sections housed in the tabs are hosted iframes. A tour of the page can be seen by clicking the "?" in the bottom right corner.
##Ticket Assist Form
The form found on the left side of the homepage is how logs are created. When a log is created, the Active Logs tab becomes active. This form should be used as a note-taking feature, and it is designed to prompt the Tech Desk user to be asking the appropriate questions and recording necessary information.  
###*Using the Ticket Assist Form*
The Ticket Assist form is the original feature of this site. It is intended to act as a note-taking feature during client interactions that is flexible, but also structures the student worker's questions and troubleshooting.  
During a client phone call, a student should first prompt the client for their username, which can be filled in the "Username" form field. This is the only required sections of the form. As the call continues, the student worker can fill in the form with any pertinent information.  
One of the core features of this form is the "Further Details" select field, which allows the student worker to narrow down the issue. Each option within this select input reveals further form fields, which prompt the student worker to be asking all the questions appropriate for that issue. 
###*Logs*
When the Ticket Assist Form is sent, a Log is created. The log is a text block that collates the information from the form, and can be easily copy/pasted into a tech note in Web Help Desk. 
Logs can be in one of two states: active or resolved. An active log will show up in the Active Logs tab on the homepage (discussed below), and a user can see all of their logs at the [Log Index page](https://140.209.47.120/logs/logIndex.php). It is important to note that logs are not automatically made into tickets! To ensure that tickets are made for each log, Admin users are sent a notification at 8:05pm every night that lists all users with open logs. 
##Announcements
The announcements tab is the first active tab, and is used by admin users to convey important news and information. 
##Active Logs
The active logs tab displays all logs that belong to the current user that are not yet resolved. Thses are logs that still need a ticket created for them. For each log that appears, there are three columns: Date Creates, the Log text, and Log Options. The log options include changing the log's status, and a button that copies the log text to the user's clipboard. 
##Notifications
Fairly self-explanatory, this is where notifications will appear. There are two actions that can be performmed on a notification: mark as read, and dismiss. A notification can be marked as read by clicking the box that reads "new". However, the notification will remain visible until it is dismissed by clicking the link that reads "dismiss".  
Additionally, there are two kinds of notifications: per user, and per user-tier. Per user notifications will appear to each user individually, and no other users can see them. The per user-tier notifications appear for all users of a given admin status, and is generally only for admin users. For these, any admin who dismisses the notification will dismiss it for all admins. This is so that user's who request access can approved quickly and not bog down all admin's notifications.
##Generic Responses
The Generic Responses tab houses email templates that can be copied directly using a "copy to clipboard" button, and can be pasted directly into tech notes. This ensures that we are communicating to clients properly, and it also saves time because the user will not need to type a similar response for every ticket.   
The responses are organized by topic, which are currently: General, Accounts, Email, Network/VPN, Printer/Hardware. Each of these topics houses a number of generic templates, which auto-populate the current user's name. Superusers and Admins can change, add, or delete topics (and any responses housed there will be moved to General). They can also edit, create, or delete the responses themselves by clicking the pencil symbol next to each.  
##Service Status
This tab shows what services are down, reflecting the service status twitter account that is managed by ITS. It is nearly identical to the one found on the ITS homepage.
##Twitter
This is a twitter feed for the Tech Desk twitter account.
##Contact Info
This tab houses contact info for the Tech Desk desks, ITS employees, and any student workers who provide their phone number. Similar to the Generic Responses, Superusers and Admins can change, add, or delete contact groups or contact entries. They cannot change student numbers, however. 
##Notes
The notes tab houses a textarea that can be used as a pervasive notepad. It is per user, and will persist through log in sessions. It saves automatically 1 second after the user is done typing. 