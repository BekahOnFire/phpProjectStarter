    /*
     * Written by Mind State Software Developing, Inc.
     * PHP Project Starter                 Version 1.0
     * September 2018
     */

Requires PHP and mysql installed, and a web server, like Apache, IIS, etc.
Web server needs to default execution scripts ending in .php as PHP scripts.

Checkout the code into /var/www/html or the folder dictated by the web server.

To create the basic database tables, run "mysql -u <root user> -p < dbConnect/basicTables.sql "
This will create 3 tables, BASIC_USER, BASIC_USERS_CONFIG, and BASIC_LOG.
The byHisSide.php script contains the database access and assumes the database will reside on the local host.  If otherwise, change "URL=remotehost".

Log into the website, http://<yourserver>/index.php
The username and password: firstguy, guypwd!

Afterward, change the default user and password for the mysql access.
Username and password: webUser, webUser1 in the "USER=webuser" and "SECRET=webuser1" . You can also change the database name, "DATABASE=<new name>".

Tips
When debugging 500 errors on Linux, view the /var/log/http/error-log for errors in PHP.  Example: tail -20 /var/log/http/error-log

When encountering error - Could not connect: Access denied for user 'webuser'@'localhost' (using password YES
Manually, log into MySQL as, "mysql -u webuser -p " to validate mysql access.
