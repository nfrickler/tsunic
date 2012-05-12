<!-- | Tables for usersystem -->
CREATE TABLE IF NOT EXISTS `#__accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL,
  `fk__homehost` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userkey` varchar(100) NOT NULL,
  `dateOfRegistration` datetime NOT NULL,
  `dateOfChange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateOfDeletion` datetime NOT NULL,
  `dateOfLastLogin` datetime NOT NULL,
  `dateOfLastLastLogin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

INSERT INTO `#__accounts` (name, dateOfRegistration)
VALUES ('root', NOW()), ('guest', NOW());

CREATE TABLE IF NOT EXISTS `#__connections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_usersystem__account` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `browser` varchar(200) NOT NULL,
  `dateOfFirst` datetime NOT NULL,
  `dateOfLast` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__accessnames` (
  `name` varchar(200) NOT NULL,
  `dateOfCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__access` (
  `fk__accessname` varchar(500) NOT NULL,
  `fk__owner` int(11) NOT NULL,
  `isUser` int(1) NOT NULL,
  `access` int(1) NOT NULL,
  `dateOfCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fk__accessname`, `fk__owner`, `isUser`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__accessgroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `fk_parent` int(11) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateOfDeletion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

INSERT INTO `#__accessgroups` (name, dateOfCreation)
VALUES ('all', NOW());

CREATE TABLE IF NOT EXISTS `#__accessgroupmembers` (
  `fk_accessgroup` int(11) NOT NULL,
  `fk_account` int(11) NOT NULL,
  `dateOfJoin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fk_accessgroup`, `fk_account`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__config` (
  `name` varchar(200) NOT NULL,
  `systemdefault` varchar(500) NOT NULL,
  `configtype` varchar(50) NOT NULL,
  `formtype` varchar(50) NOT NULL,
  `options` varchar(200) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__userconfig` (
  `fk_config` varchar(200) NOT NULL,
  `value` varchar(500) NOT NULL,
  `fk_account` int(11) NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fk_config`, `fk_account`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__fsdirectories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_name_` varchar(200) NOT NULL,
  `fk_account` int(11) NOT NULL,
  `fk_parent` int(11) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__fsfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_name_` varchar(200) NOT NULL,
  `fk_directory` int(11) NOT NULL,
  `fk_account` int(11) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;
