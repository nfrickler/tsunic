<!-- | tables of module system -->
CREATE TABLE IF NOT EXISTS `#__$system$sessions` (
  `id` varchar(100) NOT NULL,
  `data` text NOT NULL,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$system$keys` (
  `fk_table` varchar(200) NOT NULL,
  `fk_id` int(11) NOT NULL,
  `fk_account` int(11) NOT NULL,
  `fk_account_origin` int(11) NOT NULL,
  `can_write` int(1) NOT NULL,
  `_key_` text NOT NULL,
  PRIMARY KEY (`fk_table`, `fk_id`, `fk_account`)
) ENGINE=MyISAM;
