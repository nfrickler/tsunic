<!-- | Tables for bp -->

CREATE TABLE IF NOT EXISTS `#__$bp$objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `class` varchar(200) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$bp$bits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_object` int(11) NOT NULL,
  `fk_tag` int(11) NOT NULL,
  `fk_bit` int(11) NOT NULL,
  `_value_` varchar(500) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$bp$types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$bp$tags` (
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

CREATE TABLE IF NOT EXISTS `#__$bp$links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_obj1` int(11) NOT NULL,
  `fk_obj2` int(11) NOT NULL,
  `forward` int(1) NOT NULL,
  `backward` int(1) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$bp$selections` (
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

INSERT IGNORE INTO `#__$bp$types` (`name`, `title`, `description`, `fk_account`) VALUES
    ('int', '{$BP$TYPE__INT}', '{$BP$TYPE__INT__DESCRIPTION}', 0),
    ('double', '{$BP$TYPE__DOUBLE}', '{$BP$TYPE__DOUBLE__DESCRIPTION}', 0),
    ('string', '{$BP$TYPE__STRING}', '{$BP$TYPE__STRING__DESCRIPTION}', 0),
    ('text', '{$BP$TYPE__TEXT}', '{$BP$TYPE__TEXT__DESCRIPTION}', 0),
    ('selection', '{$BP$TYPE__SELECTION}', '{$BP$TYPE__SELECTION__DESCRIPTION}', 0),
    ('radio', '{$BP$TYPE__RADIO}', '{$BP$TYPE__RADIO__DESCRIPTION}', 0),
    ('timestamp', '{$BP$TYPE__TIMESTAMP}', '{$BP$TYPE__TIMESTAMP__DESCRIPTION}', 0),
    ('date', '{$BP$TYPE__DATE}', '{$BP$TYPE__DATE__DESCRIPTION}', 0),
    ('$$$BpObject', '{$BP$TYPE__FK}', '{$BP$TYPE__FK__DESCRIPTION}', 0)
;
