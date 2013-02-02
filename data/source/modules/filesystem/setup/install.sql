<!-- | Tables for filesystem -->

INSERT IGNORE INTO #__$bp$types (`name`, `title`, `description`, `fk_account`) VALUES
    ('$$$Directory', '{$FILESYSTEM$TYPE__DIRECTORY}', '{$FILESYSTEM$TYPE__DIRECTORY__DESCRIPTION}', 0),
    ('$$$File', '{$FILESYSTEM$TYPE__FILE}', '{$FILESYSTEM$TYPE__FILE__DESCRIPTION}', 0)
;

INSERT IGNORE INTO `#__$bp$tags` (`fk_type`, `name`, `title`, `description`, `isId`) VALUES
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'DIRECTORY__NAME',
	'{$FILESYSTEM$TAG__DIRECTORY__NAME}',
	'{$FILESYSTEM$TAG__DIRECTORY__NAME__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = '$$$Directory'),
	'DIRECTORY__PARENT',
	'{$FILESYSTEM$TAG__DIRECTORY__PARENT}',
	'{$FILESYSTEM$TAG__DIRECTORY__PARENT__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'FILE__NAME',
	'{$FILESYSTEM$TAG__FILE__NAME}',
	'{$FILESYSTEM$TAG__FILE__NAME__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = '$$$Directory'),
	'FILE__PARENT',
	'{$FILESYSTEM$TAG__FILE__PARENT}',
	'{$FILESYSTEM$TAG__FILE__PARENT__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'FILE__SIZE',
	'{$FILESYSTEM$TAG__FILE__SIZE}',
	'{$FILESYSTEM$TAG__FILE__SIZE__DESCRIPTION}',
	1
    )
;
