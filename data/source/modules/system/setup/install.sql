<!-- | -->
CREATE TABLE IF NOT EXISTS `#__sessions` (
  `id` varchar(100) NOT NULL,
  `data` text NOT NULL,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__keys` (
  `fk_table` varchar(200) NOT NULL,
  `fk_id` int(11) NOT NULL,
  `fk_account` int(11) NOT NULL,
  `readwrite` int(1) NOT NULL,
  `_key_` varchar(200) NOT NULL,
  PRIMARY KEY (`fk_table`, `fk_id`, `fk_account`)
) ENGINE=MyISAM;
