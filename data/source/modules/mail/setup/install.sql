<!-- | Tables for mail module -->

INSERT IGNORE INTO #__$bp$types (`name`, `title`, `description`, `fk_account`) VALUES
    ('$mail$Mail', '{$MAIL$TYPE__MAIL}', '{$MAIL$TYPE__MAIL__DESCRIPTION}', 0)
;

INSERT IGNORE INTO `#__$bp$tags` (`fk_type`, `name`, `title`, `description`, `isId`) VALUES
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'MAIL__UID',
	'{$MAIL$TAG__MAIL__UID}',
	'{$MAIL$TAG__MAIL__UID__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'MAIL__HTMLCONTENT',
	'{$MAIL$TAG__MAIL__HTMLCONTENT}',
	'{$MAIL$TAG__MAIL__HTMLCONTENT__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'MAIL__PLAINCONTENT',
	'{$MAIL$TAG__MAIL__PLAINCONTENT}',
	'{$MAIL$TAG__MAIL__PLAINCONTENT__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'MAIL__DATE',
	'{$MAIL$TAG__MAIL__DATE}',
	'{$MAIL$TAG__MAIL__DATE__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'MAIL__SUBJECT',
	'{$MAIL$TAG__MAIL__SUBJECT}',
	'{$MAIL$TAG__MAIL__SUBJECT__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'MAIL__SENDER',
	'{$MAIL$TAG__MAIL__SENDER}',
	'{$MAIL$TAG__MAIL__SENDER__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'string'),
	'MAIL__ADDRESSEE',
	'{$MAIL$TAG__MAIL__ADDRESSEE}',
	'{$MAIL$TAG__MAIL__ADDRESSEE__DESCRIPTION}',
	1
    ),
    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'MAIL__FKADDRESSEE',
	'{$MAIL$TAG__MAIL__FKADDRESSEE}',
	'{$MAIL$TAG__MAIL__FKADDRESSEE__DESCRIPTION}',
	1
    ),

    ((SELECT id FROM #__$bp$types as types WHERE types.name = 'int'),
	'MAIL__UNSEEN',
	'{$MAIL$TAG__MAIL__UNSEEN}',
	'{$MAIL$TAG__MAIL__UNSEEN__DESCRIPTION}',
	1
    )
;


CREATE TABLE IF NOT EXISTS `#__$mail$mailaccounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `_name_` varchar(500) NOT NULL,
  `_description_` text NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `_email_` varchar(500) NOT NULL,
  `_password_` varchar(500) NOT NULL,
  `_host_` varchar(1000) NOT NULL,
  `_user_` varchar(500) NOT NULL,
  `_port_` varchar(500) NOT NULL,
  `protocol` int(2) NOT NULL,
  `connsecurity` int(2) NOT NULL,
  `auth` int(2) NOT NULL,
  `lastServerboxUpdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$mail$attachments` (
  `fk_mail` int(11) NOT NULL,
  `fk_fsfile` int(11) NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fk_mail`, `fk_fsfile`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$mail$mailboxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `_name_` varchar(500) NOT NULL,
  `_description_` text NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastMailCheck` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$mail$knownservers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suffix` varchar(500) NOT NULL,
  `host` varchar(500) NOT NULL,
  `port` int(11) NOT NULL,
  `protocol` int(2) NOT NULL DEFAULT '0',
  `auth` int(2) NOT NULL DEFAULT '0',
  `connsecurity` int(2) NOT NULL DEFAULT '0',
  `user` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$mail$mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `fk_serverbox` int(11) NOT NULL,
  `fk_mailbox` int(11) NOT NULL,
  `fk_smtp` int(11) NOT NULL,
  `_subject_` varchar(500) NOT NULL,
  `_sender_` varchar(500) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateOfDeletion` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `unseen` int(1) NOT NULL,
  `dateOfMail` datetime NOT NULL,
  `uid` int(11) NOT NULL,
  `_plaincontent_` text NOT NULL,
  `_htmlcontent_` text NOT NULL,
  `charset` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$mail$addressees` (
  `fk_mail` int(11) NOT NULL,
  `address` varchar(500) NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fk_mail`, `address`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$mail$serverboxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_mailaccount` int(11) NOT NULL,
  `_name_` varchar(500) NOT NULL,
  `fk_mailbox` int(11) NOT NULL,
  `checkAllSeconds` int(11) NOT NULL DEFAULT '300',
  `deleteOnUpdate` char(1) NOT NULL DEFAULT '0',
  `dateOfCheck` datetime NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isActive` int(1) NOT NULL DEFAULT '0',
  `dateOfDeletion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__$mail$smtps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `_name_` varchar(500) NOT NULL,
  `_host_` varchar(500) NOT NULL,
  `_port_` varchar(100) NOT NULL,
  `_user_` varchar(500) NOT NULL,
  `_password_` varchar(500) NOT NULL,
  `_email_` varchar(500) NOT NULL,
  `_emailname_` varchar(500) NOT NULL,
  `auth` int(2) NOT NULL DEFAULT '0',
  `connsecurity` int(2) NOT NULL DEFAULT '0',
  `_description_` text NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

INSERT INTO `#__$mail$knownservers` (`id`, `suffix`, `host`, `port`, `protocol`, `auth`, `connsecurity`, `user`) VALUES
(1, '', 'mail.#suffix#', 143, 1, 1, 1, 1),
(2, '', 'mail.#suffix#', 993, 1, 1, 3, 1),
(3, '', 'mail.#suffix#', 110, 2, 1, 1, 1),
(4, '', 'mail.#suffix#', 995, 2, 1, 3, 1),
(5, '', 'imap.#suffix#', 143, 1, 1, 1, 1),
(6, '', 'imap.#suffix#', 993, 1, 1, 3, 1),
(7, '', 'pop.#suffix#', 110, 2, 1, 1, 1),
(8, '', 'pop.#suffix#', 995, 2, 1, 3, 1),
(9, '', 'mail.#suffix#', 25, -1, 1, 0, 1),
(10, '', 'smtp.#suffix#', 25, -1, 1, 0, 1),
(11, '', 'mail.#suffix#', 587, -1, 1, 2, 1),

(12, 't-online.de', 'secureimap.t-online.de', 993, 1, 1, 3, 2),
(23, 't-online.de', 'securesmtp.t-online.de', 587, -1, 1, 2, 1),

(14, 'aol.com', 'imap.de.aol.com', 143, 1, 1, 1, 1),
(15, 'aol.com', 'smtp.de.aol.com', 587, -1, 5, 1, 1),

(16, 'gmx.de', 'smtp.gmx.com', 25, -1, 1, 3, 2),
(17, 'gmx.de', 'imap.gmx.com', 993, 1, 1, 3, 2),
(18, 'gmx.de', 'pop.gmx.com', 995, 2, 1, 3, 2),

(19, 'web.de', 'smtp.web.de', 587, -1, 1, 2, 1),
(20, 'web.de', 'imap.web.de', 993, 1, 1, 3, 1)
;
