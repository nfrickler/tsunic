<!-- | Tables for bp -->

CREATE TABLE IF NOT EXISTS `#__objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `class` varchar(200) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__bits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_object` int(11) NOT NULL,
  `fk_tag` int(11) NOT NULL,
  `fk_bit` int(11) NOT NULL,
  `_value_` varchar(500) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
  `isId` char(1) NOT NULL,
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
  `idname` varchar(200) NOT NULL,
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
    ('radio', '{$BP$TYPE__RADIO}', '{$BP$TYPE__RADIO__DESCRIPTION}', 0),
    ('fk', '{$BP$TYPE__FK}', '{$BP$TYPE__FK__DESCRIPTION}', 0),
    ('image', '{$BP$TYPE__IMAGE}', '{$BP$TYPE__IMAGE__DESCRIPTION}', 0),
    ('file', '{$BP$TYPE__FILE}', '{$BP$TYPE__FILE__DESCRIPTION}', 0)
;
