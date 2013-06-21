<!-- | Tables for usersystem -->
CREATE TABLE IF NOT EXISTS `#__$usersystem$accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `salt_enc` varchar(200) NOT NULL,
  `privkey` TEXT NOT NULL,
  `pubkey` TEXT NOT NULL,
  `symkey` TEXT NOT NULL,
  `dateOfRegistration` datetime NOT NULL,
  `dateOfChange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateOfDeletion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$usersystem$logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `emailname` varchar(300) NOT NULL,
  `tmpkey` varchar(200) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `browser` varchar(200) NOT NULL,
  `dateOfLogin` datetime NOT NULL,
  `dateOfLast` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateOfLogout` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

INSERT INTO `#__$usersystem$accounts` (name, dateOfRegistration)
VALUES ('root', NOW()), ('guest', NOW());

CREATE TABLE IF NOT EXISTS `#__$usersystem$connections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_usersystem__account` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `browser` varchar(200) NOT NULL,
  `dateOfFirst` datetime NOT NULL,
  `dateOfLast` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$usersystem$accessnames` (
  `name` varchar(200) NOT NULL,
  `dateOfCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$usersystem$access` (
  `fk__accessname` varchar(500) NOT NULL,
  `fk__owner` int(11) NOT NULL,
  `isUser` int(1) NOT NULL,
  `access` int(1) NOT NULL,
  `dateOfCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fk__accessname`, `fk__owner`, `isUser`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$usersystem$accessgroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `fk_parent` int(11) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateOfDeletion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

INSERT INTO `#__$usersystem$accessgroups` (name, dateOfCreation)
VALUES ('all', NOW());

CREATE TABLE IF NOT EXISTS `#__$usersystem$accessgroupmembers` (
  `fk_accessgroup` int(11) NOT NULL,
  `fk_account` int(11) NOT NULL,
  `dateOfJoin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fk_accessgroup`, `fk_account`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$usersystem$config` (
  `name` varchar(200) NOT NULL,
  `systemdefault` varchar(500) NOT NULL,
  `configtype` varchar(50) NOT NULL,
  `formtype` varchar(50) NOT NULL,
  `options` varchar(200) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$usersystem$userconfig` (
  `fk_config` varchar(200) NOT NULL,
  `value` varchar(500) NOT NULL,
  `fk_account` int(11) NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fk_config`, `fk_account`)
) ENGINE=MyISAM;
