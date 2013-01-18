<!-- | Tables for profile -->

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
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'image'),
	'PROFILE__IMAGE',
	'{$PROFILE$TAG__PROFILE__IMAGE}',
	'{$PROFILE$TAG__PROFILE__IMAGE__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'date'),
	'PROFILE__DATEOFBIRTH',
	'{$PROFILE$TAG__PROFILE__DATEOFBIRTH}',
	'{$PROFILE$TAG__PROFILE__DATEOFBIRTH__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'string'),
	'PROFILE__TEL',
	'{$PROFILE$TAG__PROFILE__TEL}',
	'{$PROFILE$TAG__PROFILE__TEL__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'text'),
	'PROFILE__ADDRESS',
	'{$PROFILE$TAG__PROFILE__ADDRESS}',
	'{$PROFILE$TAG__PROFILE__ADDRESS__DESCRIPTION}'
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
