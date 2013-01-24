<!-- | Tables for calendar -->

INSERT IGNORE INTO `$bp$tags` (`fk_type`, `name`, `title`, `description`) VALUES 
    ((SELECT id FROM $bp$types as types WHERE types.name = 'string'),
	'DATE__START',
	'{$CALENDAR$TAG__DATE__START}',
	'{$CALENDAR$TAG__DATE__START__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'string'),
	'DATE__STOP',
	'{$CALENDAR$TAG__DATE__STOP}',
	'{$CALENDAR$TAG__DATE__STOP__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'int'),
	'DATE__LENGTH',
	'{$CALENDAR$TAG__DATE__LENGTH}',
	'{$CALENDAR$TAG__DATE__LENGTH__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'string'),
	'DATE__TITLE',
	'{$CALENDAR$TAG__DATE__TITLE}',
	'{$CALENDAR$TAG__DATE__TITLE__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'int'),
	'DATE__REPEAT',
	'{$CALENDAR$TAG__DATE__REPEAT}',
	'{$CALENDAR$TAG__DATE__REPEAT__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'radio'),
	'DATE__REPEATTYPE',
	'{$CALENDAR$TAG__DATE__REPEATTYPE}',
	'{$CALENDAR$TAG__DATE__REPEATTYPE__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'int'),
	'DATE__REPEATSTOP',
	'{$CALENDAR$TAG__DATE__REPEATSTOP}',
	'{$CALENDAR$TAG__DATE__REPEATSTOP__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'int'),
	'DATE__REPEATCOUNT',
	'{$CALENDAR$TAG__DATE__REPEATCOUNT}',
	'{$CALENDAR$TAG__DATE__REPEATCOUNT__DESCRIPTION}'
    )
;

INSERT IGNORE INTO `$bp$selections` (`fk_tag`, `name`, `description`, `dateOfCreation`) VALUES
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'DATE__REPEATTYPE' LIMIT 1),
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_I}',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_I__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'DATE__REPEATTYPE' LIMIT 1),
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_H}',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_H__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'DATE__REPEATTYPE' LIMIT 1),
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_D}',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_D__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'DATE__REPEATTYPE' LIMIT 1),
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_M}',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_M__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'DATE__REPEATTYPE' LIMIT 1),
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_Y}',
	'{$CALENDAR$SELECTIONS__DATE__REPEATTYPE_Y__DESCRIPTION}',
	NOW()
    )
;
