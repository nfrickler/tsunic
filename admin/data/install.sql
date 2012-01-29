CREATE TABLE IF NOT EXISTS `#__modules` (
  `id__module` int(11) NOT NULL AUTO_INCREMENT,
  `nameid` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `dateOfInstall` datetime NOT NULL,
  `dateOfUpdate` datetime NOT NULL,
  `dateOfUninstall` datetime NOT NULL,
  `dateOfPreParsing` datetime NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 0,
  `is_parsed` tinyint(1) NOT NULL DEFAULT 0,
  `author` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `version` varchar(50) NOT NULL,
  `version_installed` varchar(50) NOT NULL,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id__module`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__styles` (
  `id__style` int(11) NOT NULL AUTO_INCREMENT,
  `nameid` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `dateOfPreParsing` datetime NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 0,
  `is_parsed` tinyint(1) NOT NULL DEFAULT 0,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `author` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `version` varchar(50) NOT NULL,
  PRIMARY KEY (`id__style`)
) ENGINE=MyISAM;