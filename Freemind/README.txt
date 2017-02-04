MINDMAP README

Written by Nick Scheel 9-28-2016

This document will be a guide on the purpose, fucntion, and design of the Tech Desk Troubleshooting Menu found on the ticket assistant, from here on out being referred to as the Troubleshooting Assistant.

The Troubleshooting Assistant was created using Freemind 1.0.1 [ freemind.sourceforge.net ]. To download, visit http://freemind.sourceforge.net/wiki/index.php/Download


OVERVIEW
The purpose of the Troubleshooting Assistant is to lead student workers through their interactions with clients in the search for a solution to their issue. This is achieved by separating common issues into a heirarchy, with the most basic description of the issue being the first shown. The guide is meant to be broad, and lacks depth. This is compensated for by linking detailed guides to each issue. 
The Assistant is made up of nodes. The parent node, "Tech Desk" is the center of the diagram. From here, each section is a child node of it's preceding parent mode. Any node without children is a leaf node, which is where the majority of our troubleshooting information is stored. 

MODIFYING
The Troubleshooting Assistant is housed within the Freemind folder found in /WWW/ on the Virtual Machine serving as the web server for the Ticket Assist site as a whole. Within the Freemind directory is another folder and the Troubleshooting Assistant HTML file. When making changes, it is important to update both. 

1. To make changes, first make sure you are able to access and modify files on the web server.
2. Next, make sure that you have Freemind installed on your computer. 
3. Move the TroubleshootingAssist.mm file to your computer and open it with Freemind. 
4. Make any changes necessary. Be sure to collapse all nodes before exporting.
5. Go to File->Export->As XHTML (Javascript Version)
6. Make sure the file is named TroubleshootingAssist, or it will not work properly on the site.
7. Replace the old files with the new ones on the web server, and refresh the page.
8. Ensure that your changes too place properly. 

