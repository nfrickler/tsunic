<!-- | Tables for bp -->

CREATE TABLE IF NOT EXISTS `#__bits` (
  `fk_piece` int(11) NOT NULL,
  `fk_tag` int(11) NOT NULL,
  `_name_` varchar(200) NOT NULL,
  `_value_` varchar(500) NOT NULL,
  PRIMARY KEY (`fk_piece`, `fk_tag`, `_name_`, `_value_`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__pieces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `_author_` varchar(200) NOT NULL,
  `dateOfChange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateOfCreation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `fk_type` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__selections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_tag` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE(`fk_tag`, `name`)
) ENGINE=MyISAM;

INSERT IGNORE INTO `#__types` (`name`, `title`, `description`, `fk_account`) VALUES
    ('int', '{$BP$TYPE__INT}', '{$BP$TYPE__INT__DESCRIPTION}', 0),
    ('double', '{$BP$TYPE__DOUBLE}', '{$BP$TYPE__DOUBLE__DESCRIPTION}', 0),
    ('string', '{$BP$TYPE__STRING}', '{$BP$TYPE__STRING__DESCRIPTION}', 0),
    ('text', '{$BP$TYPE__TEXT}', '{$BP$TYPE__TEXT__DESCRIPTION}', 0),
    ('selection', '{$BP$TYPE__SELECTION}', '{$BP$TYPE__SELECTION__DESCRIPTION}', 0),
    ('radio', '{$BP$TYPE__RADIO}', '{$BP$TYPE__RADIO__DESCRIPTION}', 0)
;
