<!-- | Tables for issuetracker -->

INSERT IGNORE INTO #__$bp$types (`name`, `title`, `description`, `fk_account`) VALUES
    ('$issuetracker$Issue', '{$ISSUETRACKER$TYPE__ISSUE}', '{$ISSUETRACKER$TYPE__ISSUE__DESCRIPTION}', 0)
;

INSERT IGNORE INTO `#__$bp$tags` (`fk_type`, `name`, `title`, `description`, `isId`) VALUES
    ((SELECT id FROM #__$bp$types as types WHERE types.name = '$profile$MyProfile'),
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
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'text'),
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
    ((SELECT id FROM #__$bp$types as types WHERE types.name = '$profile$MyProfile'),
	'ISSUE__MAINTAINER',
	'{$ISSUETRACKER$TAG__ISSUE__MAINTAINER}',
	'{$ISSUETRACKER$TAG__ISSUE__MAINTAINER__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'radio'),
	'ISSUE__STATUS',
	'{$ISSUETRACKER$TAG__ISSUE__STATUS}',
	'{$ISSUETRACKER$TAG__ISSUE__STATUS__DESCRIPTION}',
	1
    )
;

INSERT IGNORE INTO `#__$bp$selections` (`fk_tag`, `idname`, `name`, `description`, `dateOfCreation`) VALUES
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'ISSUE__STATUS' LIMIT 1),
	'new',
	'{$ISSUETRACKER$SELECTIONS__ISSUE__STATUS_NEW}',
	'{$ISSUETRACKER$SELECTIONS__ISSUE__STATUS_NEW__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'ISSUE__STATUS' LIMIT 1),
	'inprogress',
	'{$ISSUETRACKER$SELECTIONS__ISSUE__STATUS_INPROGRESS}',
	'{$ISSUETRACKER$SELECTIONS__ISSUE__STATUS_INPROGRESS__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'ISSUE__STATUS' LIMIT 1),
	'done',
	'{$ISSUETRACKER$SELECTIONS__ISSUE__STATUS_DONE}',
	'{$ISSUETRACKER$SELECTIONS__ISSUE__STATUS_DONE__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'ISSUE__STATUS' LIMIT 1),
	'closed',
	'{$ISSUETRACKER$SELECTIONS__ISSUE__STATUS_CLOSED}',
	'{$ISSUETRACKER$SELECTIONS__ISSUE__STATUS_CLOSED__DESCRIPTION}',
	NOW()
    ),
    ((SELECT id FROM #__$bp$tags as tags WHERE tags.name  = 'ISSUE__STATUS' LIMIT 1),
	'rejected',
	'{$ISSUETRACKER$SELECTIONS__ISSUE__STATUS_REJECTED}',
	'{$ISSUETRACKER$SELECTIONS__ISSUE__STATUS_REJECTED__DESCRIPTION}',
	NOW()
    )
;
