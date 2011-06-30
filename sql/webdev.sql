


CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `supporter` varchar (32) NOT NULL,
  `admin` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


CREATE TABLE IF NOT EXISTS `adminsetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startregion` varchar(255) NOT NULL,
  `userdir` varchar(255) NOT NULL,
  `griddir` varchar(255) NOT NULL,
  `assetdir` varchar(255) NOT NULL,
  `lastnames` varchar(10) NOT NULL,
  `adress` varchar(32) NOT NULL,
  `region` text NOT NULL,
  `confirm18` varchar(32) NOT NULL,
  `rlname` varchar(32) NOT NULL,
  `rladdress` varchar(32) NOT NULL,
  `rlzip` varchar(32) NOT NULL,
  `rlcity` varchar(32) NOT NULL,	
  `rlcountry` varchar(32) NOT NULL,
  `rldob` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `adminsetting` (
	`startregion`,`userdir`,`griddir`,`assetdir`,`lastnames`,`adress`,`region`,`confirm18`)
	VALUES
	('0','.','.','.','0','0','0','1') ;

CREATE TABLE IF NOT EXISTS `banned` (
  `UUID` varchar(36) NOT NULL,
  `agentIP` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `codetable` (
  `UUID` varchar(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `country` (
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `economy_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CentsPerMoneyUnit` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT IGNORE INTO `economy_money` (`id`, `CentsPerMoneyUnit`) VALUES
(1, 0.415);

CREATE TABLE IF NOT EXISTS `economy_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sourceId` varchar(36) NOT NULL,
  `destId` varchar(36) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `flags` int(11) NOT NULL DEFAULT '0',
  `aggregatePermInventory` int(11) NOT NULL DEFAULT '0',
  `aggregatePermNextOwner` int(11) NOT NULL DEFAULT '0',
  `description` varchar(256) DEFAULT NULL,
  `transactionType` int(11) NOT NULL DEFAULT '0',
  `timeOccurred` int(11) NOT NULL,
  `RegionGenerated` varchar(36) NOT NULL,
  `IPGenerated` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `lastnames` (
  `name` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL DEFAULT '1',
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `lastnames` (`name`, `active`) VALUES
('Allen', '1'),
('Babbi', '1'),
('Bauer', '1'),
('Baumeister', '1'),
('Binder', '1'),
('Bloomberg', '1'),
('Bohlen', '1'),
('Crazys', '1'),
('Dredd', '1'),
('Ewing', '1'),
('Gridlock', '1'),
('Hausermann', '1'),
('Heron', '1'),
('Himbaer', '1'),
('Huss', '1'),
('Kandee', '1'),
('Machlam', '1'),
('Maek', '1'),
('Mansworld', '1'),
('McKinsey', '1'),
('McLachlan', '1'),
('Mondial', '1'),
('Moondancer', '1'),
('Mueller', '1'),
('Nala', '1'),
('Noel', '1'),
('Nonsito', '1'),
('Nosemann', '1'),
('Notringham', '1'),
('Obolus', '1'),
('Opus', '1'),
('Pohl', '1'),
('Raptor', '1'),
('Roux', '1'),
('Schnuggy', '1'),
('Schwinge', '1'),
('Simons', '1'),
('Snapper', '1'),
('Sweetheart', '1'),
('Swindlehurst', '1'),
('Tickle', '1'),
('Young', '1');

CREATE TABLE IF NOT EXISTS `mysql_announcement_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL DEFAULT '0',
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `mysql_sessions_table` (
  `sesskey` char(32) NOT NULL,
  `expiry` int(11) unsigned NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`sesskey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `offline_msgs` (
  `uuid` varchar(36) NOT NULL,
  `message` text NOT NULL,
  KEY `uuid` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `pagemanager` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `rank` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `active` varchar(30) NOT NULL,
  `url` text NOT NULL,
  `target` varchar(255) NOT NULL,
  `display` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

INSERT INTO `pagemanager` (`id`, `code`, `sitename`, `content`, `rank`, `type`, `active`, `url`, `target`, `display`) VALUES
(1, '1211831857', 'Home', '', '01', '1', '1', 'index.php?page=home', '_self', '0'),
(28, '1262042911', 'Events', '', '05', '1', '1', 'index.php?page=events', '_self', '1'),
(3, '1211831925', 'Gridstatus', '', '03', '1', '1', 'index.php?page=gridstatus', '_self', '0'),
(5, '1213729504', 'Region List', '', '26', '1', '1', 'index.php?page=regions', '_self', '0'),
(6, '1213811351', 'World Map', '', '27', '1', '1', 'index.php?page=map', '_self', '0'),
(7, '1211832149', 'Create Account', '', '28', '1', '0', 'index.php?page=createaccount', '_self', '0'),
(8, '1211832173', 'Logout', '', '20', '1', '1', 'index.php?page=logout', '_self', '1'),
(17, '1235761445', 'Who''s online', '', '04', '1', '1', 'index.php?page=online', '_self', '0'),
(18, '1262039238', 'Additional Account tasks', '', '3', '2', '1', 'index.php?page=extendedaccount', '_self', '1'),
(25, '1262039238', 'Account', '', '04', '1', '1', '', '_self', '1'),
(26, '1262039238', 'Transaction History', '', '2', '2', '1', 'index.php?page=transactions', '_self', '1'),
(27, '1262039238', 'Change Password', '', '1', '2', '1', 'index.php?page=changepassword', '_self', '1'),
(29, '1262043041', 'Land Manager', '', '07', '1', '1', 'index.php?page=land', '_self', '1'),
(30, '1262043041', 'Group Land', '', '1', '2', '1', 'index.php?page=groupland', '_self', '1'),
(31, '1262043041', 'My Regions', '', '2', '2', '1', 'index.php?page=myregions', '_self', '1'),
(32, '1262043443', 'Shop', '', '06', '1', '1', 'index.php?page=shopping', '_self', '1'),
(33, '1262043540', 'Search', '', '12', '1', '1', 'index.php?page=search', '_self', '2'),
(34, '1304572878', 'About', '', '30', '1', '1', '', '_self', '0');

CREATE TABLE IF NOT EXISTS `regions` (
  `serverIP` varchar(64) NOT NULL,
  `serverPort` int(11) NOT NULL,
  `regionMapTexture` varchar(255) NOT NULL,
  `locX` int(11) NOT NULL,
  `locY` int(11) NOT NULL,
  `lastcheck` int(10) NOT NULL,
  `failcounter` int(11) NOT NULL,
  UNIQUE KEY `serverURI` (`serverIP`,`regionMapTexture`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `sitemanagement` (
  `pagecase` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `include` varchar(255) NOT NULL,
  PRIMARY KEY (`pagecase`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `sitemanagement` (`pagecase`, `type`, `include`) VALUES
('activate', 'standard', 'activate.php'),
('activatemail', 'standard', 'activatemail.php'),
('change', 'account', 'changeacc.php'),
('changepassword', 'account', 'changeacc.php'),
('classifieds', 'classifieds', 'classifieds.php'),
('createaccount', 'standard', 'createaccount.php'),
('events', 'events', 'events.php'),
('extendedaccount', 'account', 'extendedaccount.php'),
('forgotpass', 'standard', 'forgotpw.php'),
('gridstatus', 'news', 'gridnews.php'),
('gridstatushistory', 'news', 'newshistory.php'),
('home', 'standard', 'home.php'),
('land', 'landmanager', 'land.php'),
('logout', 'standard', 'logout.php'),
('make-events', 'events', 'make-events.php'),
('map', 'standard', 'map.php'),
('online', 'standard', 'whosonline.php'),
('pwreset', 'standard', 'pwreset.php'),
('regions', 'standard', 'region_list.php'),
('save-events', 'events', 'save-events.php'),
('transactions', 'account', 'transactions.php');

CREATE TABLE IF NOT EXISTS `startscreen_infowindow` (
  `gridstatus` varchar(255) NOT NULL,
  `active` varchar(30) NOT NULL,
  `color` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `startscreen_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


CREATE TABLE IF NOT EXISTS `statistics` (
  `serverIP` varchar(64) NOT NULL,
  `serverPort` int(11) NOT NULL,
  `dilation` float NOT NULL,
  `simfps` float NOT NULL,
  `phyfps` float NOT NULL,
  `prims` int(11) NOT NULL,
  `scripts` int(11) NOT NULL,
  `script_lps` float NOT NULL,
  `packets_in` float NOT NULL,
  `packets_out` float NOT NULL,
  `memory` float NOT NULL,
  `uptime` varchar(20) NOT NULL,
  `version` varchar(255) NOT NULL,
  `lastcheck` int(10) NOT NULL,
  `failcounter` int(11) NOT NULL,
  UNIQUE KEY `serverIP` (`serverIP`,`serverPort`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `sup_announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL DEFAULT '0',
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `sup_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL DEFAULT '',
  `address` text,
  `main_contact_id` int(11) NOT NULL DEFAULT '0',
  `author_id` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  `rank` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_name` (`company_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `sup_companies` (`id`, `company_name`, `address`, `main_contact_id`, `author_id`, `date_modified`, `comments`, `rank`) VALUES
(1, 'Inactive Contacts', 'This virtual company serves as a pool for contacts that are not assigned to any company.', 1, 1, 1309059868, 'This company cannot be modified!', 0);

CREATE TABLE IF NOT EXISTS `sup_diskid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diskid_name` varchar(60) NOT NULL DEFAULT '',
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `diskid_name` (`diskid_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `sup_faqcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(60) NOT NULL DEFAULT '',
  `rank` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `sup_faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL DEFAULT '',
  `answer` text,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `author_id` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `question` (`question`),
  FULLTEXT KEY `question_2` (`question`,`answer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `sup_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '',
  `filename` varchar(250) NOT NULL,
  `size` bigint(20) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `filename` (`filename`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `sup_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL DEFAULT '',
  `author_id` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  `rank` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_name` (`group_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `sup_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(60) NOT NULL DEFAULT '',
  `rank` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`module_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `sup_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) NOT NULL DEFAULT '',
  `last_name` varchar(60) NOT NULL DEFAULT '',
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `phone` varchar(100) NOT NULL DEFAULT '',
  `fax` varchar(100) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  `user` int(1) NOT NULL DEFAULT '0',
  `supporter` int(1) NOT NULL DEFAULT '0',
  `admin` int(1) NOT NULL DEFAULT '0',
  `theme` varchar(60) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `sup_people` (`id`, `first_name`, `last_name`, `user_name`, `password`, `email`, `phone`, `fax`, `company_id`, `author_id`, `date_modified`, `comments`, `user`, `supporter`, `admin`, `theme`) VALUES
(1, 'Default', 'Contact', 'defaultcontact', '5f4dcc3b5aa765d61d8327deb882cf99', 'default.contact@inactivecontacts.com', 'XXX-XXX-XXXX', 'XXX-XXX-XXXX', 1, 1, 1309059868, 'This contact cannot be modified!', 1, 0, 0, 'default');

CREATE TABLE IF NOT EXISTS `sup_platforms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` int(4) NOT NULL DEFAULT '0',
  `platform` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `platform` (`platform`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `sup_platforms` (`id`, `rank`, `platform`) VALUES
(1, 0, 'Generic'),
(2, 1, 'PC'),
(3, 1, 'Macintosh');

CREATE TABLE IF NOT EXISTS `sup_sessions` (
  `sesskey` char(32) NOT NULL,
  `expiry` int(11) unsigned NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`sesskey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `sup_settings` (
  `name` varchar(60) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `people_per_page` int(4) DEFAULT '5',
  `sets_per_page` int(4) DEFAULT '5',
  `tickets_per_page` int(4) DEFAULT '10',
  `announcements_limit` int(4) DEFAULT '5',
  `stats` varchar(3) DEFAULT 'on',
  `products_status` varchar(3) DEFAULT 'on',
  `setssl` varchar(3) NOT NULL DEFAULT 'off',
  `default_theme` varchar(60) NOT NULL DEFAULT 'default',
  `smtp` varchar(3) DEFAULT 'off',
  `automatic_notification` varchar(3) DEFAULT 'off',
  `sendmail_path` varchar(255) DEFAULT NULL,
  `on_off` varchar(3) DEFAULT 'on',
  `reason` text,
  `whosonline` varchar(3) DEFAULT 'on',
  `time_tracking` varchar(3) NOT NULL DEFAULT 'off'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sup_supporters` (
  `group_id` int(11) NOT NULL,
  `supporter_id` int(11) NOT NULL,
  UNIQUE KEY `group_id` (`group_id`,`supporter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `sup_tcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` int(4) NOT NULL DEFAULT '0',
  `category` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `sup_tcategories` (`id`, `rank`, `category`) VALUES
(1, 0, 'Big Problem'),
(2, 1, 'Small Problem'),
(3, 2, 'Other Problem');

CREATE TABLE IF NOT EXISTS `sup_ticketdiskid` (
  `ticket_id` int(11) NOT NULL,
  `diskid` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `sup_ticketfiles` (
  `ticket_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  UNIQUE KEY `ticket_id` (`ticket_id`,`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `sup_ticketmodules` (
  `ticket_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  UNIQUE KEY `ticket_id` (`ticket_id`,`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `sup_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '1',
  `supporter_id` int(11) NOT NULL DEFAULT '1',
  `company_id` int(11) NOT NULL DEFAULT '1',
  `contact_id` int(11) NOT NULL DEFAULT '1',
  `priority_id` int(11) NOT NULL DEFAULT '1',
  `status_id` int(11) NOT NULL DEFAULT '1',
  `platform_id` int(11) NOT NULL DEFAULT '1',
  `category_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `update_log` text,
  `version_id` int(11) NOT NULL DEFAULT '0',
  `diskid_id` int(11) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL DEFAULT '0',
  `date_modified` int(11) NOT NULL DEFAULT '0',
  `author_id` int(11) NOT NULL,
  `survey` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title` (`title`,`description`,`update_log`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `sup_tpriorities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` int(4) NOT NULL DEFAULT '0',
  `priority` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `priority` (`priority`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `sup_tpriorities` (`id`, `rank`, `priority`) VALUES
(1, 0, 'Critical'),
(2, 1, 'High'),
(3, 2, 'Medium'),
(4, 3, 'Low');

CREATE TABLE IF NOT EXISTS `sup_tracktime` (
  `ticket_id` int(11) NOT NULL,
  `supporter_id` int(11) NOT NULL,
  `minutes` int(11) DEFAULT '0',
  `date_logged` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `sup_tstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` int(4) NOT NULL DEFAULT '0',
  `status` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `sup_tstatus` (`id`, `rank`, `status`) VALUES
(1, 1, 'Open'),
(2, 2, 'In Progress'),
(3, 3, 'Waiting for Response'),
(4, 4, 'Closed');

CREATE TABLE IF NOT EXISTS `sup_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version_name` varchar(60) NOT NULL DEFAULT '',
  `rank` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `version_name` (`version_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `sup_whosonline` (
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `user` varchar(60) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`timestamp`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `users` (
  `UUID` varchar(36) NOT NULL DEFAULT '',
  `username` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `passwordHash` varchar(32) NOT NULL,
  `passwordSalt` varchar(32) NOT NULL,
  `realname1` varchar(255) NOT NULL,
  `realname2` varchar(255) NOT NULL,
  `adress1` varchar(255) NOT NULL,
  `zip1` varchar(255) NOT NULL,
  `city1` varchar(255) NOT NULL,
  `country1` varchar(255) NOT NULL,
  `emailadress` varchar(255) NOT NULL,
  `agentIP` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL DEFAULT '1',
  PRIMARY KEY (`UUID`),
  UNIQUE KEY `usernames` (`username`,`lastname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

