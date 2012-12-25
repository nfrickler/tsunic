<!-- | Tables for profile -->

CREATE TABLE IF NOT EXISTS `#__profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `dateOfCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;
