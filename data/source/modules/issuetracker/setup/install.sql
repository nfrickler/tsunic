<!-- | Tables for issuetracker -->

INSERT IGNORE INTO #__$bp$types (`name`, `title`, `description`, `fk_account`) VALUES
    ('$issuetracker$Issue', '{$ISSUETRACKER$TYPE__ISSUE}', '{$ISSUETRACKER$TYPE__ISSUE__DESCRIPTION}', 0)
;

INSERT IGNORE INTO `#__$bp$tags` (`fk_type`, `name`, `title`, `description`, `isId`) VALUES
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'ISSUETRACKER__AUTHOR',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__AUTHOR}',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__AUTHOR__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'ISSUETRACKER__NAME',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__NAME}',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__NAME__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'ISSUETRACKER__DESCRIPTION',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__DESCRIPTION}',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__DESCRIPTION__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'ISSUETRACKER__QUEUE',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__QUEUE}',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__QUEUE__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'ISSUETRACKER__MAINTAINER',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__MAINTAINER}',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__MAINTAINER__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'ISSUETRACKER__STATUS',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__STATUS}',
	'{$ISSUETRACKER$TAG__ISSUETRACKER__STATUS__DESCRIPTION}',
	1
    )
;
