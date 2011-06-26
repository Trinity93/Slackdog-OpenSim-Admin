/*******************************************************************************
**	file:	README.txt
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.5 $ on $Date: 2004/02/12 04:35:05 $ by $Author: lmpmbernardo $
*******************************************************************************/

Contents:
----------
1.  System Requirements
2.  Installation
3.  If Upgrading
4.	Language Support
5.	Acknowledgements

-----------------------------------------------------------------------------
1.  System Requirements
-----------------------------------------------------------------------------
	- PHP 4.3.0 or higher
	- MySQL
	- Web Server (IIS/Apache/other)
	- Optional SMTP Server
	- Optional SSL for secure password transaction

2.  Installation
-----------------------------------------------------------------------------
a) 	Before you can begin installation, you will first need to have PHP installed and MySQL up and running.
b) 	Create a database in MySQL and provide proper permissions to a user that will be accessing
	your database.  For first time MySQL users, change the variables (web_user, and password) below
	and simply copy and paste the commands into your MySQL command line. If you have the database in the
	same server as the the webserver and you login as root you probably don't need to grant permissions.
	===============================================================================================
	mysql> create database myhelpdesk;
	mysql> grant alter, select, insert, update, delete, create on myhelpdesk.* to web_user@yourhost identified by 'password';
	===============================================================================================
	Refer to the MySQL documentation for more information (http://www.mysql.com/documentation)
c)	Extract myhelpdesk.zip to your htdocs directory.
d)	Open up config.php in the code directory and find the four variables at the top ($mysql_host, $mysql_user, $mysql_pwd,
	and $mysql_db).  Edit these so they match the settings for your host. You can also choose the directory to
	hold files associated with the tickets. Finally choose your language preference.
e)	Go to http://yourdomain.com/myhelpdesk/install.php.
f)	It will automatically make you an admin. Once finished, login, set a ticketing schema and you are all set!
g)	Try to change the code to suit your needs. This was written with something in mind but your needs are probably different.
	I strongly suggest that people tinker with the code to make it better for their needs. It is very easy. If however you
	don't have the resources to do it and need some customization you can drop me a line (lmpmbernardo@sourceforge.net).
	The same if you have old data in excel files that you would like to feed into the system.

3.  If Upgrading (from release 20040119 or earlier)
-----------------------------------------------------------------------------
a)  This code adds two indexes to the database schema. As such you need to upgrade the schema. To do that unzip
	the code to your myhelpdesk directory and run http://yourdomain.com/myhelpdesk/upgrade.php. If you prefer
	you can run the two "alter table" statements (look at the upgrade.php code) directly on the mysql command line.

4. Language Support
-----------------------------------------------------------------------------
a)	The language files are located in the code/lang/ directory. If you have suggestions or corrections to make
	please contact the following people:
	- English (lmpmbernardo@users.sourceforge.net)
	- Spanish (sasa_eh@users.sourceforge.net)
	- Portuguese - Portugal (lmpmbernardo@users.sourceforge.net) 
	- Dutch (marc_dekens@users.sourceforge.net)
	- German (madisback@users.sourceforge.net)
	- French (remiporcedda@users.sourceforge.net)

5. Acknowledgements
-----------------------------------------------------------------------------
	This code was originally adapted from Helpdesk OneOrZero 1.1 beta (http://helpdesk.oneorzero.com). 
	Thanks also to Dirk Brunner for pointing out bugs and how to fix them.

