-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2011 at 09:39 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wiredux`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'f0d998cf0c9cae229a7e0bc1a5aa7ae0');

-- --------------------------------------------------------

--
-- Table structure for table `adminsetting`
--

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

--
-- Dumping data for table `adminsetting`
--

INSERT INTO `adminsetting` (`id`, `startregion`, `userdir`, `griddir`, `assetdir`, `lastnames`, `adress`, `region`) VALUES
(1, '4915916489252352', 'D:\\opensim\\', 'D:\\opensim\\', 'D:\\opensim\\', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `banned`
--

CREATE TABLE IF NOT EXISTS `banned` (
  `UUID` varchar(36) NOT NULL,
  `agentIP` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banned`
--


-- --------------------------------------------------------

--
-- Table structure for table `codetable`
--

CREATE TABLE IF NOT EXISTS `codetable` (
  `UUID` varchar(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `codetable`
--


-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `economy_money`
--

CREATE TABLE IF NOT EXISTS `economy_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CentsPerMoneyUnit` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `economy_money`
--

INSERT INTO `economy_money` (`id`, `CentsPerMoneyUnit`) VALUES
(1, 0.415);

-- --------------------------------------------------------

--
-- Table structure for table `economy_transactions`
--

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

--
-- Dumping data for table `economy_transactions`
--


-- --------------------------------------------------------

--
-- Table structure for table `lastnames`
--

CREATE TABLE IF NOT EXISTS `lastnames` (
  `name` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL DEFAULT '1',
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lastnames`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `offline_msgs`
--

CREATE TABLE IF NOT EXISTS `offline_msgs` (
  `uuid` varchar(36) NOT NULL,
  `message` text NOT NULL,
  KEY `uuid` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offline_msgs`
--

INSERT INTO `offline_msgs` (`uuid`, `message`) VALUES
('f7a9d10c-4620-4b91-adca-ae584eae9bf6', '<GridInstantMessage xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><fromAgentID>00000000-0000-0000-0000-000000000000</fromAgentID><fromAgentName>Server</fromAgentName><toAgentID>f7a9d10c-4620-4b91-adca-ae584eae9bf6</toAgentID><dialog>19</dialog><fromGroup>false</fromGroup><message>Your object Testing zero sized object bug was returned from &lt;132.7117, 122.8007, 21.33398&gt; in region Sandbox 1 due to parcel autoreturn</message><imSessionID>a3ac719e-2bf7-4770-a05b-819eb0431dca</imSessionID><offline>1</offline><Position><X>0</X><Y>0</Y><Z>0</Z></Position><binaryBucket /><ParentEstateID>1</ParentEstateID><RegionID>a475661f-18e7-4435-b9f6-5409123ac33b</RegionID><timestamp>1306065871</timestamp></GridInstantMessage>'),
('f7a9d10c-4620-4b91-adca-ae584eae9bf6', '<GridInstantMessage xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><fromAgentID>00000000-0000-0000-0000-000000000000</fromAgentID><fromAgentName>Server</fromAgentName><toAgentID>f7a9d10c-4620-4b91-adca-ae584eae9bf6</toAgentID><dialog>19</dialog><fromGroup>false</fromGroup><message>Your object Testing zero sized object bug was returned from &lt;132.7117, 122.8007, 21.33398&gt; in region Sandbox 1 due to parcel autoreturn</message><imSessionID>726d2a39-9682-421b-ad94-0efae3448b34</imSessionID><offline>1</offline><Position><X>0</X><Y>0</Y><Z>0</Z></Position><binaryBucket /><ParentEstateID>1</ParentEstateID><RegionID>a475661f-18e7-4435-b9f6-5409123ac33b</RegionID><timestamp>1306126772</timestamp></GridInstantMessage>'),
('f7a9d10c-4620-4b91-adca-ae584eae9bf6', '<GridInstantMessage xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><fromAgentID>00000000-0000-0000-0000-000000000000</fromAgentID><fromAgentName>Server</fromAgentName><toAgentID>f7a9d10c-4620-4b91-adca-ae584eae9bf6</toAgentID><dialog>19</dialog><fromGroup>false</fromGroup><message>Your object Testing zero sized object bug was returned from &lt;132.7117, 122.8007, 21.33398&gt; in region Sandbox 1 due to parcel autoreturn</message><imSessionID>ecf0bab5-7172-4102-924c-671ad7c3dbf7</imSessionID><offline>1</offline><Position><X>0</X><Y>0</Y><Z>0</Z></Position><binaryBucket /><ParentEstateID>1</ParentEstateID><RegionID>a475661f-18e7-4435-b9f6-5409123ac33b</RegionID><timestamp>1306388214</timestamp></GridInstantMessage>'),
('f7a9d10c-4620-4b91-adca-ae584eae9bf6', '<GridInstantMessage xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><fromAgentID>00000000-0000-0000-0000-000000000000</fromAgentID><fromAgentName>Server</fromAgentName><toAgentID>f7a9d10c-4620-4b91-adca-ae584eae9bf6</toAgentID><dialog>19</dialog><fromGroup>false</fromGroup><message>Your object Testing zero sized object bug was returned from &lt;132.7117, 122.8007, 21.33398&gt; in region Sandbox 1 due to parcel autoreturn</message><imSessionID>698a3312-d886-4d7e-af99-736cd2f06fb3</imSessionID><offline>1</offline><Position><X>0</X><Y>0</Y><Z>0</Z></Position><binaryBucket /><ParentEstateID>1</ParentEstateID><RegionID>a475661f-18e7-4435-b9f6-5409123ac33b</RegionID><timestamp>1306417830</timestamp></GridInstantMessage>');

-- --------------------------------------------------------

--
-- Table structure for table `pagemanager`
--

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

--
-- Dumping data for table `pagemanager`
--

INSERT INTO `pagemanager` (`id`, `code`, `sitename`, `content`, `rank`, `type`, `active`, `url`, `target`, `display`) VALUES
(1, '1211831857', 'Home', '<p> </p>\r\n<table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%">\r\n    <tbody>\r\n        <tr>\r\n            <td width="63%" valign="top" height="204">\r\n            <table cellspacing="0" cellpadding="5" border="0" bgcolor="#ffffff" align="center" width="90%" height="195">\r\n                <tbody>\r\n                    <tr>\r\n                        <td valign="top">\r\n                        <p><strong>Welcome to Slackdog Grid !</strong><br />\r\n                        <br />\r\n                        <p>This site is currently under construction. Automated account creation is disabled on the website. Please Contact Trinity at trinity93@gmail.com for information on getting an account</p>\r\n                        <p>For now you can see the Status of our System -> <br />\r\n                        <br />\r\n                        Feel free to look around the site. :-)</p>\r\n <br />\r\n<p><strong>Now looking for donations !</strong><br />\r\nWe are currently looking for donations to help support and update the grid. Please contact Trinity at trinity93@gmail.com if you would like to make a donation.</p>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n            <td valign="top" colspan="2"> </td>\r\n        </tr>\r\n        <tr>\r\n            <td> </td>\r\n            <td width="33%"> </td>\r\n            <td width="3%"> </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '01', '1', '1', 'index.php?page=home', '_self', '0'),
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

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

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

--
-- Dumping data for table `regions`
--


-- --------------------------------------------------------

--
-- Table structure for table `sitemanagement`
--

CREATE TABLE IF NOT EXISTS `sitemanagement` (
  `pagecase` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `include` varchar(255) NOT NULL,
  PRIMARY KEY (`pagecase`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sitemanagement`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `startscreen_infowindow`
--

CREATE TABLE IF NOT EXISTS `startscreen_infowindow` (
  `gridstatus` varchar(255) NOT NULL,
  `active` varchar(30) NOT NULL,
  `color` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `startscreen_infowindow`
--

INSERT INTO `startscreen_infowindow` (`gridstatus`, `active`, `color`, `title`, `message`) VALUES
('1', '1', 'white', 'Account Creation Info', 'Please go to http://gallifrey.slackdog.com:9000/wifi to create a new account.');

-- --------------------------------------------------------

--
-- Table structure for table `startscreen_news`
--

CREATE TABLE IF NOT EXISTS `startscreen_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `startscreen_news`
--

INSERT INTO `startscreen_news` (`id`, `title`, `message`, `time`) VALUES
(2, 'New system being worked on', 'Developement and Testing of new Web Services is under way', 1255536787);

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

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

--
-- Dumping data for table `statistics`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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

--
-- Dumping data for table `users`
--

