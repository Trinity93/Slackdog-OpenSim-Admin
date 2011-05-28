-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--

--
-- Database: `wiredux`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '84e78b596fa8e391c49f3c4df7b9c57f');

CREATE TABLE IF NOT EXISTS `adminsetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startregion` varchar(255) NOT NULL,
  `userdir` varchar(255) NOT NULL,
  `griddir` varchar(255) NOT NULL,
  `assetdir` varchar(255) NOT NULL,
  `lastnames` varchar(10) NOT NULL,
  `adress` varchar(32) NOT NULL,
  `region` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `adminsetting` (`id`, `startregion`, `userdir`, `griddir`, `assetdir`, `lastnames`, `adress`, `region`) VALUES
(1, '', '', '', '', '0', '0', '1');

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

INSERT INTO `country` (`name`) VALUES
('Albania'),
('Belgium'),
('Bosnia'),
('Bulgaria'),
('Germany'),
('Denmark'),
('Estonia'),
('Finland'),
('France'),
('Georgia'),
('Greece'),
('United Kingdom'),
('Ireland'),
('Iceland'),
('Italy'),
('Croatia'),
('Latvia'),
('Lithuania'),
('Luxembourg'),
('Malta'),
('Macedonia'),
('Moldova'),
('Netherlands'),
('Norway'),
('Poland'),
('Portugal'),
('Romania'),
('Russia'),
('Sweden'),
('Switzerland'),
('Serbia & Montenegro'),
('Slovakia'),
('Slovenia'),
('Espana'),
('Czech Rep.'),
('Turkey'),
('Ukraine'),
('Hungary'),
('Belarus'),
('Cyprus'),
('Austria'),
('Afghanistan'),
('Armenia'),
('Azerbaijan'),
('Bangladesh'),
('Bhutan'),
('Brunei'),
('India'),
('Indonesia'),
('Japan'),
('Cambodia'),
('Kazakhstan'),
('Kyrgyzstan'),
('Laos'),
('Malaysia'),
('Maldives'),
('Mongolia'),
('Myanmar'),
('Nepal'),
('North Korea'),
('Pakistan'),
('Philippines'),
('Singapore'),
('Sri Lanka'),
('South Korea'),
('Tajikistan'),
('Taiwan'),
('Thailand'),
('Turkmenistan'),
('Uzbekistan'),
('Viet Nam'),
('Canada'),
('Mexico'),
('USA'),
('Antigua und Barbuda'),
('Aruba'),
('Bahamas'),
('Barbados'),
('Belize'),
('Bermuda'),
('Cayman Islands'),
('Costa Rica'),
('Curacao'),
('Dominica'),
('Dominican Rep.'),
('El Salvador'),
('Grenada'),
('Guadeloupe'),
('Guatemala'),
('Haiti'),
('Honduras'),
('Jamaica'),
('Virgin Islands'),
('Cuba'),
('Martinique'),
('Nicaragua'),
('Panama'),
('Puerto Rico'),
('St. Kitts und Nevis'),
('St. Lucia'),
('St. Maarten'),
('St. Vincent & Grenadin'),
('Trinidad & Tobago'),
('Argentina'),
('Bolivia'),
('Brazil'),
('Chile'),
('Ecuador'),
('Guyana'),
('Colombia'),
('Paraguay'),
('Peru'),
('Suriname'),
('Uruguay'),
('Venezuela'),
('Australia'),
('Fiji'),
('Marshall Islands'),
('Micronesia'),
('Nauru'),
('New Zealand'),
('Palau'),
('Papua New Guinea'),
('Samoa'),
('Tonga'),
('Tuvalu'),
('Vanuatu'),
('Bahrain'),
('Iraq'),
('Iran'),
('Israel'),
('Yemen'),
('Jordan'),
('Quatar'),
('Kuwait'),
('Lebanon'),
('Oman'),
('Palestinian authority'),
('Saudi Arabia'),
('Syria'),
('U.A.E.'),
('Algeria'),
('Angola'),
('Benin'),
('Botswana'),
('Burkina Faso'),
('Burundi'),
('Dem. Rep. of the Congo'),
('Djibouti'),
('Céte d''Ivoire'),
('Eritrea'),
('Gabun'),
('Gambia'),
('Ghana'),
('Guinea'),
('Guinea-Bissau'),
('Cameroon'),
('Cape Verde'),
('Kenya'),
('Lesotho'),
('Liberia'),
('Libya'),
('Madagascar'),
('Malawi'),
('Mali'),
('Morocco'),
('Mauritania'),
('Mauritius'),
('Mozambique'),
('Namibia'),
('Niger'),
('Nigeria'),
('Dem. Rep. of the Congo'),
('Zambia'),
('Sao Tomé and Principe'),
('Senegal'),
('Seychelles'),
('Sierra Leone'),
('Simbabwe'),
('Somalia'),
('Sudan'),
('Swaziland'),
('South Africa'),
('Tanzania'),
('Togo'),
('Chad'),
('Tunisia'),
('Uganda'),
('Central African Rep.'),
('Egypt'),
('Guinea Equatorial'),
('Ethiopia'),
('La Réunion'),
('Solomon Islands'),
('French Guiana');

CREATE TABLE IF NOT EXISTS `economy_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CentsPerMoneyUnit` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `economy_money` (`id`, `CentsPerMoneyUnit`) VALUES
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

INSERT INTO `pagemanager` (`id`, `code`, `sitename`, `content`, `rank`, `type`, `active`, `url`, `target`, `display`) VALUES
(1, '1211831857', 'Home', '<p>&nbsp;</p>\r\n<table height="100%" cellspacing="0" cellpadding="0" width="100%" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td valign="top" width="63%" height="204">\r\n            <table height="195" cellspacing="0" cellpadding="5" width="90%" align="center" bgcolor="#ffffff" border="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td valign="top">\r\n                        <p><strong>Welcome to the new Opensimwi Redux !</strong><br />\r\n                        <br />\r\n                        Create an Free Account today and Play in our World.<br />\r\n                        Our World is created by its Residents, you can build everything in here.<br />\r\n                        Meet Peoples, Chat, Play, Everything is possible in our brandnew 3D World.</p>\r\n                        <p>Beside you see the Status of our System -&gt; <br />\r\n                        <br />\r\n                        Enjoy it. :-)</p>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n            <td valign="top" colspan="2">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td>&nbsp;</td>\r\n            <td width="33%">&nbsp;</td>\r\n            <td width="3%">&nbsp;</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '01', '1', '1', 'index.php?page=home', '_self', '2'),
(2, '1211831897', 'Change Account', '', '05', '1', '1', 'index.php?page=change', '_self', '1'),
(3, '1211831925', 'Gridstatus', '', '03', '1', '1', 'index.php?page=gridstatus', '_self', '0'),
(4, '1211832121', 'Transaction History', '', '04', '1', '1', 'index.php?page=transactions', '_self', '1'),
(5, '1213729504', 'Region List', '', '06', '1', '1', 'index.php?page=regions', '_self', '0'),
(6, '1213811351', 'World Map', '', '07', '1', '1', 'index.php?page=map', '_self', '0'),
(7, '1211832149', 'Create Account', '', '08', '1', '1', 'index.php?page=create', '_self', '0'),
(8, '1211832173', 'Logout', '', '11', '1', '1', 'index.php?page=logout', '_self', '1'),
(17, '1235761445', 'Who''s online', '', '04', '1', '1', 'index.php?page=online', '_self', '0'),
(18, '1211831897', 'Additional Account tasks', '', '1', '2', '1', 'index.php?page=accounting', '_self', '1'),
(21, '1239453230', 'Support', '', '05', '1', '1', 'index.php?page=support', '_self', '1');

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

CREATE TABLE IF NOT EXISTS `startscreen_infowindow` (
  `gridstatus` varchar(255) NOT NULL,
  `active` varchar(30) NOT NULL,
  `color` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `startscreen_infowindow` (`gridstatus`, `active`, `color`, `title`, `message`) VALUES
('1', '1', 'yellow', 'Info system Works very well ;-)', 'Today we''ve built a new loginscreen info system and it works very well. You can now see Info windows on the startup screen.');

CREATE TABLE IF NOT EXISTS `startscreen_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `startscreen_news` (`id`, `title`, `message`, `time`) VALUES
(1, 'New version installed', 'We have succesfully installed the latest version of OpenSim', 1255536787);

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
