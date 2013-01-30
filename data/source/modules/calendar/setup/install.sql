<!-- | Tables for calendar -->

INSERT IGNORE INTO #__$bp$types (`name`, `title`, `description`, `fk_account`) VALUES
    ('$$$Date', '{$CALENDAR$TYPE__FK_DATE}', '{$CALENDAR$TYPE__FK_DATE__DESCRIPTION}', 0)
;

INSERT IGNORE INTO `#__$bp$tags` (`fk_type`, `name`, `title`, `description`, `isId`) VALUES 
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'DATE__START',
	'{$CALENDAR$TAG__DATE__START}',
	'{$CALENDAR$TAG__DATE__START__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'DATE__STOP',
	'{$CALENDAR$TAG__DATE__STOP}',
	'{$CALENDAR$TAG__DATE__STOP__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'DATE__LENGTH',
	'{$CALENDAR$TAG__DATE__LENGTH}',
	'{$CALENDAR$TAG__DATE__LENGTH__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'DATE__TITLE',
	'{$CALENDAR$TAG__DATE__TITLE}',
	'{$CALENDAR$TAG__DATE__TITLE__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'DATE__REPEAT',
	'{$CALENDAR$TAG__DATE__REPEAT}',
	'{$CALENDAR$TAG__DATE__REPEAT__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'radio'),
	'DATE__REPEATTYPE',
	'{$CALENDAR$TAG__DATE__REPEATTYPE}',
	'{$CALENDAR$TAG__DATE__REPEATTYPE__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'DATE__REPEATSTOP',
	'{$CALENDAR$TAG__DATE__REPEATSTOP}',
	'{$CALENDAR$TAG__DATE__REPEATSTOP__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'DATE__REPEATCOUNT',
	'{$CALENDAR$TAG__DATE__REPEATCOUNT}',
	'{$CALENDAR$TAG__DATE__REPEATCOUNT__DESCRIPTION}',
	1
    )
;

INSERT IGNORE INTO `#__$bp$selections` (`fk_tag`, `idname`, `name`, `description`, `dateOfCreation`) VALUES
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'DATE__REPEATTYPE' LIMIT 1),
	'i',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_I}',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_I__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'DATE__REPEATTYPE' LIMIT 1),
	'h',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_H}',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_H__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'DATE__REPEATTYPE' LIMIT 1),
	'd',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_D}',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_D__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'DATE__REPEATTYPE' LIMIT 1),
	'm',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_M}',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_M__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'DATE__REPEATTYPE' LIMIT 1),
	'y',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_Y}',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_Y__DESCRIPTION}',
	NOW()
    )
;
