<!-- | Tables for profile -->

CREATE TABLE IF NOT EXISTS `#__profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `dateOfCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

INSERT IGNORE INTO `$bp$tags` (`fk_type`, `name`, `title`, `description`) VALUES 
    ((SELECT id FROM $bp$types as types WHERE types.name = 'string'),
	'PROFILE__FIRSTNAME',
	'{$PROFILE$TAG__PROFILE__FIRSTNAME}',
	'{$PROFILE$TAG__PROFILE__FIRSTNAME__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'string'),
	'PROFILE__LASTNAME',
	'{$PROFILE$TAG__PROFILE__LASTNAME}',
	'{$PROFILE$TAG__PROFILE__LASTNAME__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'radio'),
	'PROFILE__GENDER',
	'{$PROFILE$TAG__PROFILE__GENDER}',
	'{$PROFILE$TAG__PROFILE__GENDER__DESCRIPTION}'
    )
;

INSERT IGNORE INTO `$bp$selections` (`fk_tag`, `name`, `description`, `dateOfCreation`) VALUES
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'PROFILE__GENDER' LIMIT 1),
	'{$PROFILE$SELECTIONS__PROFILE__GENDER_M}',
	'{$PROFILE$SELECTIONS__PROFILE__GENDER_M__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'PROFILE__GENDER' LIMIT 1),
	'{$PROFILE$SELECTIONS__PROFILE__GENDER_F}',
	'{$PROFILE$SELECTIONS__PROFILE__GENDER_F__DESCRIPTION}',
	NOW()
    )
;
