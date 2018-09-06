CREATE DATABASE basicproject;
connect basicproject;
CREATE TABLE `BASIC_USERS` (
  `USER_NUMBER` int(10) NOT NULL auto_increment,
  `USERNAME` varchar(30) character set latin1 collate latin1_bin default NULL,
  `PASSWD` varchar(30) character set latin1 collate latin1_bin default NULL,
  `CREATE_DATE` datetime default NULL,
  `UPDATE_DATE` datetime default NULL,
  `FIRST_LOGIN` datetime default NULL,
  `LAST_LOGIN` datetime default NULL,
  `COUNT_LOGINS` int(10) default NULL,
  `COUNT_PAGES` int(10) default NULL,
  `LAST_IP` varchar(50) default NULL,
  `APP_ACCESS` varchar(80) default NULL,
  PRIMARY KEY  (`USER_NUMBER`)
);
# Create basic login user
insert into BASIC_USERS values (1,'firstguy','guypwd!',now(),now(),now(),now(),0,0,'setup','');

CREATE TABLE `BASIC_USERS_CONFIG` (
  `USER_NUMBER` int(10) NOT NULL,
  `MAXLOGINATTEMPTS` int(3) default NULL,
  `ADMIN_ABLE` char(1) default NULL,
  `CREATE_DATE` datetime default NULL,
  `UPDATE_DATE` datetime default NULL
);
# Create basic login user
insert into BASIC_USERS_CONFIG values (1,15,'Y',now(),now());

CREATE TABLE `BASIC_LOG` (
  `TRANS_NUMBER` int(10) default NULL,
  `ENTRY_DATE` datetime default NULL,
  `USERNAME` varchar(30),
  `LOG_ENTRY` text
);
# Create the web access to mysql database and tables connection.
drop user webuser@localhost;
create user 'webuser'@'localhost';
GRANT ALL PRIVILEGES ON basicproject.* TO 'webuser'@'localhost' IDENTIFIED BY 'webUser1';

