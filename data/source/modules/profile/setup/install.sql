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
	'{TAG__PROFILE__FIRSTNAME}',
	'{TAG__PROFILE__FIRSTNAME__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'string'),
	'PROFILE__LASTNAME',
	'{TAG__PROFILE__LASTNAME}',
	'{TAG__PROFILE__LASTNAME__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'radio'),
	'PROFILE__GENDER',
	'{TAG__PROFILE__GENDER}',
	'{TAG__PROFILE__GENDER__DESCRIPTION}'
    )

;

INSERT IGNORE INTO `$bp$selections` (`fk_tags`, `name`, `description`, `dateOfCreation`) VALUES
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'PROFILE__GENDER' LIMIT 1),
	'{SELECTIONS__PROFILE__GENDER_M}',
	'{SELECTIONS__PROFILE__GENDER_M__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'PROFILE__GENDER' LIMIT 1),
	'{SELECTIONS__PROFILE__GENDER_F}',
	'{SELECTIONS__PROFILE__GENDER_F__DESCRIPTION}',
	NOW()
    )
;
