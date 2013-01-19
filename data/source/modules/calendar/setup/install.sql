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
	'DATE__PERIOD',
	'{$CALENDAR$TAG__DATE__PERIOD}',
	'{$CALENDAR$TAG__DATE__PERIOD__DESCRIPTION}'
    ),
    ((SELECT id FROM $bp$types as types WHERE types.name = 'radio'),
	'DATE__PERIODTYPE',
	'{$CALENDAR$TAG__DATE__PERIODTYPE}',
	'{$CALENDAR$TAG__DATE__PERIODTYPE__DESCRIPTION}'
    )
;

INSERT IGNORE INTO `$bp$selections` (`fk_tag`, `name`, `description`, `dateOfCreation`) VALUES
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'DATE__PERIODTYPE' LIMIT 1),
	'{$CALENDAR$SELECTIONS__DATE__PERIODTYPE_I}',
	'{$CALENDAR$SELECTIONS__DATE__PERIODTYPE_I__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'DATE__PERIODTYPE' LIMIT 1),
	'{$CALENDAR$SELECTIONS__DATE__PERIODTYPE_H}',
	'{$CALENDAR$SELECTIONS__DATE__PERIODTYPE_H__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'DATE__PERIODTYPE' LIMIT 1),
	'{$CALENDAR$SELECTIONS__DATE__PERIODTYPE_D}',
	'{$CALENDAR$SELECTIONS__DATE__PERIODTYPE_D__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'DATE__PERIODTYPE' LIMIT 1),
	'{$CALENDAR$SELECTIONS__DATE__PERIODTYPE_M}',
	'{$CALENDAR$SELECTIONS__DATE__PERIODTYPE_M__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM $bp$tags as tags WHERE tags.name  = 'DATE__PERIODTYPE' LIMIT 1),
	'{$CALENDAR$SELECTIONS__DATE__PERIODTYPE_Y}',
	'{$CALENDAR$SELECTIONS__DATE__PERIODTYPE_Y__DESCRIPTION}',
	NOW()
    )
;
