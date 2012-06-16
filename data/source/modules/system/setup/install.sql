<!-- | -->
CREATE TABLE IF NOT EXISTS `#__sessions` (
  `id` varchar(100) NOT NULL,
  `data` text NOT NULL,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;
