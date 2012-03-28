<!-- | -->
CREATE TABLE IF NOT EXISTS `#__sessions` (
  `id__sid` varchar(100) NOT NULL,
  `data` text NOT NULL,
  `expires` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id__sid`)
) ENGINE=MyISAM;
