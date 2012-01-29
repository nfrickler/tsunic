<!-- | -->
<!--
/** header ***********************************************************
 * project:			TSunic 4.1 | system 1.0
 * file:			/setup/install.sql
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * **************************************************************** */
-->
CREATE TABLE IF NOT EXISTS `#__sessions` (
  `id__sid` varchar(100) NOT NULL,
  `data` text NOT NULL,
  `expires` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id__sid`)
) ENGINE=MyISAM;