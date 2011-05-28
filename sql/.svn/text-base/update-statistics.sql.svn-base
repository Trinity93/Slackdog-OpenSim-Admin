DROP TABLE IF EXISTS `statistics`;
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
