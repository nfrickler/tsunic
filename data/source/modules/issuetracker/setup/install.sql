<!-- | Tables for issuetracker -->

INSERT IGNORE INTO #__$bp$types (`name`, `title`, `description`, `fk_account`) VALUES
    ('$issuetracker$Issue', '{$ISSUETRACKER$TYPE__ISSUE}', '{$ISSUETRACKER$TYPE__ISSUE__DESCRIPTION}', 0)
;

INSERT IGNORE INTO `#__$bp$tags` (`fk_type`, `name`, `title`, `description`, `isId`) VALUES
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'ISSUE__AUTHOR',
	'{$ISSUETRACKER$TAG__ISSUE__AUTHOR}',
	'{$ISSUETRACKER$TAG__ISSUE__AUTHOR__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'ISSUE__NAME',
	'{$ISSUETRACKER$TAG__ISSUE__NAME}',
	'{$ISSUETRACKER$TAG__ISSUE__NAME__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'ISSUE__DESCRIPTION',
	'{$ISSUETRACKER$TAG__ISSUE__DESCRIPTION}',
	'{$ISSUETRACKER$TAG__ISSUE__DESCRIPTION__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'ISSUE__QUEUE',
	'{$ISSUETRACKER$TAG__ISSUE__QUEUE}',
	'{$ISSUETRACKER$TAG__ISSUE__QUEUE__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'ISSUE__MAINTAINER',
	'{$ISSUETRACKER$TAG__ISSUE__MAINTAINER}',
	'{$ISSUETRACKER$TAG__ISSUE__MAINTAINER__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'ISSUE__STATUS',
	'{$ISSUETRACKER$TAG__ISSUE__STATUS}',
	'{$ISSUETRACKER$TAG__ISSUE__STATUS__DESCRIPTION}',
	1
    )
;
