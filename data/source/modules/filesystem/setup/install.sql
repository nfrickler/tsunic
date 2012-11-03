<!-- | Tables for usersystem -->
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
  `bytes` int(11) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;
