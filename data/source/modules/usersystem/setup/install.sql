<!-- | -->
<!--
/** header ***********************************************************
 * project:			TSunic 4.1 | system 1.0
 * file:			/setup/install.sql
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * **************************************************************** */
-->
CREATE TABLE IF NOT EXISTS `#__accounts` (
  `id_system_users__account` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL,
  `password` varchar(32) NOT NULL,
  `dateOfRegistration` datetime NOT NULL,
  `dateOfChange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateOfDeletion` datetime NOT NULL,
  `isAdmin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_system_users__account`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__profiles` (
  `id_system_users__profile` int(11) NOT NULL AUTO_INCREMENT,
  `fk_system_users__account` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfDeletion` datetime NOT NULL,
  `dateOfChange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_system_users__profile`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__userfiles` (
  `id__userfile` int(11) NOT NULL AUTO_INCREMENT,
  `fk_system_users__account` int(11) NOT NULL,
  `_name_` varchar(500) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateOfDeletion` datetime NOT NULL,
  `mimetype` varchar(100) NOT NULL,
  PRIMARY KEY (`id__userfile`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__users` (
  `id_system_users__user` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) NOT NULL,
  `browser` varchar(200) NOT NULL,
  `fk_system_users__account` int(11) NOT NULL,
  `dateOfFirst` datetime NOT NULL,
  `dateOfLast` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_system_users__user`)
) ENGINE=MyISAM;