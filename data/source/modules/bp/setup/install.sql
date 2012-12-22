<!-- | Tables for bp -->

CREATE TABLE IF NOT EXISTS `#__bits` (
  `fk_piece` int(11) NOT NULL,
  `_name_` varchar(200) NOT NULL,
  `_value_` varchar(500) NOT NULL,
  PRIMARY KEY (`fk_piece`, `name`, `value`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__pieces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_author_` varchar(200) NOT NULL,
  `dateOfChange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateOfCreation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

