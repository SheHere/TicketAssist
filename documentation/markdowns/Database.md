# Database

---

##Contents
- How to Access
- How to Use
- Example PHP code
- Schema
- Schema Details

## How do I access it?
The database is a MySQL DB that is accessed directly through phpmyadmin, and can be found at http://140.209.47.120/phpmyadmin. 

## How do I use it?
To interact with the database, you will need to make SQL queries. If you are unfamiliar with SQL, you can learn the basics at [w3schools.com.](https://www.w3schools.com/sql/default.asp) The majority of queries made throughout the Ticket Assist site are simple SELECT, UPDATE, or INSERT INTO statements, with a few DELETE statements. All SQL queries are nested within PHP code. The following section shows a few example queries.

## Example PHP with SQL
First, it is important to note that all PHP scripts that need to connect to the database have the following line before making any calls:
```php
<?php require($_SERVER["DOCUMENT_ROOT"] . "/loginutils/connectdb.php"); ?>
```
This forces the page to include the connectdb.php file, which connects to the database, and will not load the rest of the page if it can not find it. It is OK for this file to act as a [black box](https://en.wikipedia.org/wiki/Black_box), and the only important thing to know about it is that it creates a PHP variable `$con`, which is used later.

The following code takes in a variable via a $_POST request and searches a relation for it.
```php
require($_SERVER["DOCUMENT_ROOT"] . "/loginutils/connectdb.php"); // Connects to the database
 
$variable = $_POST['variable']; // Receives the passed data
 
$SQL = "SELECT `table`.`item` 
        FROM `table` 
        WHERE `table.`item` = $variable"; // Creates the SQL query
 
$result = mysqli_query($con,$SQL); // Runs the query. $con is defined in connectdb.php
 
// $result can be used as a boolean, based on whether it was successful or not
if($result){
    //Query was successful. More code can be put here.
}
else{
    //Query was unsuccessful, either it did not find the item, or an SQL error occurred
}
```
The above code is a simple SELECT statement. Other types of queries, such as INSERT INTO or UPDATE are called the same way. All SQL calls must have the same basic components:
- Database connection (connectdb.php)
- Variable with SQL statement stored as text
- Variable set with mysqli_query($con, $sql), where $sql is whatever variable you stored the statement in
- Success condition and failure condition.

For a full list of MySQLi functions, see [this](https://www.w3schools.com/php/php_ref_mysqli.asp) tutorial. The most commonly used ones include:
```php
// Used to chain together multiple semicolon-separated SQL queries in one $SQL variable
$result = mysqli_multi_query($con,$SQL);
 

// Returns a printable string that lists any errors that the database encountered. 
// Often used when $result is false
mysqli_errno($con);
 
// Returns an integer representing the number of rows returned by a SELECT statement
// Can be used in an if() statement to perform an action only if a certain number of
// rows are found.
mysqli_num_rows($result);
 
// Loops through all rows returned by the query. Data can be accessed by treating $row
// as an array.
while($row = mysqli_fetch_assoc($find_result)){
    $variable = $row['variable'];
}
```


## Relations
The following are the relations (tables) that make up the Ticket Assist database: 
 
**announcements** (count, date, title, author, message, visibility)  
**badges** (id, name, prerequisites, icon)  
**badges_held** (username, id)  
**bugs** (id, submitted_by, url, note, status)  
**calendar_assignments** (assignment_id, time_start, time_end, day, position_id, username)  
**calendar_positions** (position_id, position_name) 
**changelog** (id, date, title, author, message)  
**contactFTE** (id, full_name, location, position, desk_number, cell_number, grouping)  
**contact_groups** (id, group_name, ordering)  
**encyclopedia** (count, author, vocab_term, topic, description, guide, keyword1, keyword2, keyword3, status, approvedBy, flaggedBy)  
**genericReponse** (id, username, title, msg_body) 
**genericResponseGroups** (id, ordering, group_name)
**guides** (topic, guide_name, filename, overview, body)  
**login** (username, password, admin_status, new_user, role)  
**logs** (id, username, log_text, date, current_status)  
**megalink** (username, link1, link2, link3, link4, link5)  
**notifications** (id, date_created, viewed, dismissed, username, title, message, all_admin)  
**test** (test, text, date_created)  
**training_pages** (id, title, path, body)
**users** (username, fname, lname, bio, img_path, color, notes, phone_number)  

## Schema Details
The following topics will address each schema individually:

###announcements
**count (int)** primary key, auto increment variable.  
**date (timestamp)** current timestamp at time of entry creation.  
**title (text)** title of the sumbitted announcement.  
**author (author)** author of the submitted announcement.  
**message (text)** message to be announced. Will be in HTML format.  
**visibility (int)** determines if the announcement is shown on the home page. 0 if not to be shown, 1 if otherwise.  

###badges
**id (int)** primary key, auto increment variable.  
**name (text)** name of the badge.  
**prerequisites (text)** prereqs for the badge.  
**icon (text)** glyphicon of the badge.  


###badges_held
**id (int)** the id of the badge that the user is holding.  
**username (varchar)** username of the person that has the badge.  


###bugs
**id (int)** primary key, auto increment variable.  
**submitted_by (varchar)** username of person who submitted the bug.  
**url (varchar)** location of the bug found.  
**note (text)** description of the bug.  
**status (int)** determines if the bug is open(1) or resolved(0).  


###calendar_assignments
**assignment_id (int)** primary key, auto increment variable.  
**time_start (int)** 24 hr representation of the time the user starts their shift.  
**time_end (int)** 24 hr representation of the time the user ends their shift.  
**day (varchar)** represents the days of the week that the assignment applies to; U=Sunday, M=Monday, T=Tuesday, W=Wednesday, R=Thursday, F=Friday, S=Saturday  
**position_id (int)** the position that the assignment applies to; links calendar_positions with calendar_assignments  
**username (varchar)** the username of the person the assignment applies to  


###calendar_positions
**position_id (int)** primary key, auto increment variable  
**position_name (text)** the name of the position that users will be assigned to  


###changelog
**id (int)** primary key, auto increment variable.  
**date (timestamp)** time when the changelog was submitted
**title (varchar)** title of the submission.  
**author (varchar)** author of the submission.  
**message (text)** body of the submission.  

###contactFTE
**id (int)** primary key, auto increment variable.  
**full_name (varchar)** name of the indivudal who's info is being stored  
**location (varchar)** either St. Paul or Minneapolis, location of employee's main office  
**position (varchar)** description of individuals position in ITS  
**desk_number (varchar)** the individual's St. Thomas desk phone number  
**cell_number (varchar)** As above, but cell phone number  
**grouping (varchar)** 1=Tech Desk and department numbers, 2=RRT, 3=EDT, 4=Local Tech, 5=Other  


###contact_groups
**id (int)**  primary key, auto increment variable.  
**group_name (varchar)**  name of the group.  
**ordering (int)**  1, 2, or 3. 1 is always "Tech Desk", 3 is always "Other / Unassigned", and the rest are 2. This is to ensure that they appear in the group list in the correct order.  

###encyclopedia
**count (int)** primary key, auto increment variable.  
**author (varchar)** username of the person submtting the entry.  
**vocab_term (varchar)** the term they are defining.  
**topic (varchar)** the overall topic of the term.  
**description (text)** definition of the term.  
**guide (varchar)** link to related guide.  
**keyword1 (varchar)** related word.  
**keyword2 (varchar)** related word.  
**keyword3 (varchar)** related word.  
**status (text)** denied(0), pending(1), flagged(2), or approved(3)  
**approvedBy (varchar)** username of the superuser who most recently approved the word.  
**flaggedBy (varchar)** username of the user who most recently flagged the word.  


###genericReponse
**id (int)** primary key, auto increment variable.  
**username (varchar)** the username of the user who created the response  
**title (varchar)** displayed title of the response  
**msg_body (text)** text to be displayed in the dropdown  

###guides
**topic (text)** the overall topic of the term.
**guide_name (varchar)** primary key, name of the guide.
**filename (text)** name of the guide without spaces for use in GET request URL.
**overview (text)** Description of the guide.
**body (text)** body of the guide in HTML format.



###login
**username (varchar)** primary key  
**password (varchar)** password associated with each username. Hashed.  
**admin_status (int)** user(1), superuser(2), and admin(3).  
**new_user (int)** defaults to 0 so that new users are brought to welcome page. Is then changed to 1, and is not changed again.  
**role (int)** user role, inactive(0), student(1), or employee(2).  

###logs
**id (int)** primary key, auto increment variable.  
**username (varchar)** author of the log.  
**log_text (text)** body of the log.  
**date (timestamp)** time/date at creation of log.  
**current_status (int)** open(1), resolved(2)  


###megalink
**username (varchar)** primary key.  
**link1 (text)** holds URL that is opened when the Mega Link is clicked.  
**link2 (text)** holds URL that is opened when the Mega Link is clicked.  
**link3 (text)** holds URL that is opened when the Mega Link is clicked.  
**link4 (text)** holds URL that is opened when the Mega Link is clicked.  
**link5 (text)** holds URL that is opened when the Mega Link is clicked.  

###notifications
**id (int)** primary key, auto increment variable.  
**date_created (timestamp)** when the notification was created  
**viewed (int)** 0=viewed, 1=not viewed. Determines whether "new" appears next to the notofication, and if a badge appears in the tab  
**dismissed (int)** 0=dismissed, 1=not dismissed. Determines whether or not the notification shows up by default.  
**username (varchar)** who the notification displays for  
**title (text)** title for the notification  
**message (text)** body of the notification, in HTML  
**all_admin (int)** determines if the notification is for all admin users, default is 0=not all admin, 1=yes all admin. This is so that new users who register accounts can be approved quickly, and if these notifications are dismissed by one user then they are dismissed for all.  

###training_pages
**id (int)**  primary key, auto increment variable.  
**title (varchar)**  title of the training guide, can contain symbols.  
**path (varchar)**  derived from the title, but without spaces or symbols.  
**body (text)**  the HTML body of the training guide.  

###users
**username (varchar)** primary key.  
**fname (varchar)** user's first name.  
**lname (varchar)** user's last name.  
**bio (text)** user's biography.  
**img_path (text)** filepath for the user's bio image.  
**color (varchar)** hex code of the users color
**notes (text)** plain text of the users saved notes, visible on the homepage.  
**phone_number (varchar)** the user's phone number.  