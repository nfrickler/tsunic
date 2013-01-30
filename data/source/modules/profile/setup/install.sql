<!-- | Tables for profile -->

INSERT IGNORE INTO #__$bp$types (`name`, `title`, `description`, `fk_account`) VALUES
    ('$$$Profile', '{$PROFILE$TYPE__FK_PROFILE}', '{$PROFILE$TYPE__FK_PROFILE__DESCRIPTION}', 0)
;

INSERT IGNORE INTO `#__$bp$tags` (`fk_type`, `name`, `title`, `description`, `isId`) VALUES 
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'PROFILE__FIRSTNAME',
	'{$PROFILE$TAG__PROFILE__FIRSTNAME}',
	'{$PROFILE$TAG__PROFILE__FIRSTNAME__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'PROFILE__LASTNAME',
	'{$PROFILE$TAG__PROFILE__LASTNAME}',
	'{$PROFILE$TAG__PROFILE__LASTNAME__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'radio'),
	'PROFILE__GENDER',
	'{$PROFILE$TAG__PROFILE__GENDER}',
	'{$PROFILE$TAG__PROFILE__GENDER__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'image'),
	'PROFILE__IMAGE',
	'{$PROFILE$TAG__PROFILE__IMAGE}',
	'{$PROFILE$TAG__PROFILE__IMAGE__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = '$calendar$Date'),
	'PROFILE__DATEOFBIRTH',
	'{$PROFILE$TAG__PROFILE__DATEOFBIRTH}',
	'{$PROFILE$TAG__PROFILE__DATEOFBIRTH__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'PROFILE__TEL',
	'{$PROFILE$TAG__PROFILE__TEL}',
	'{$PROFILE$TAG__PROFILE__TEL__DESCRIPTION}',
	0
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'text'),
	'PROFILE__ADDRESS',
	'{$PROFILE$TAG__PROFILE__ADDRESS}',
	'{$PROFILE$TAG__PROFILE__ADDRESS__DESCRIPTION}',
	0
    )
;

INSERT IGNORE INTO `#__$bp$selections` (`fk_tag`, `idname`, `name`, `description`, `dateOfCreation`) VALUES
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'PROFILE__GENDER' LIMIT 1),
	'm',
	'{$PROFILE$SELECTIONS__PROFILE__GENDER_M}',
	'{$PROFILE$SELECTIONS__PROFILE__GENDER_M__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'PROFILE__GENDER' LIMIT 1),
	'f',
	'{$PROFILE$SELECTIONS__PROFILE__GENDER_F}',
	'{$PROFILE$SELECTIONS__PROFILE__GENDER_F__DESCRIPTION}',
	NOW()
    )
;
