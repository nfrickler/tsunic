CREATE TABLE IF NOT EXISTS `#__mailaccounts` (
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

CREATE TABLE IF NOT EXISTS `#__attachments` (
  `fk_mail` int(11) NOT NULL,
  `fk_fsfile` int(11) NOT NULL,
  PRIMARY KEY (`fk_mail`, `fk_fsfile`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__mailboxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `_name_` varchar(500) NOT NULL,
  `_description_` text NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastMailCheck` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__knownservers` (
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

CREATE TABLE IF NOT EXISTS `#__mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account` int(11) NOT NULL,
  `fk_serverbox` int(11) NOT NULL,
  `fk_mailbox` int(11) NOT NULL,
  `fk_smtp` int(11) NOT NULL,
  `_subject_` varchar(500) NOT NULL,
  `_sender_` varchar(500) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateOfDownload` datetime NOT NULL,
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

CREATE TABLE IF NOT EXISTS `#__addressees` (
  `fk_mail` int(11) NOT NULL,
  `address` varchar(500) NOT NULL,
  `dateOfUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fk_mail`, `address`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__serverboxes` (
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

CREATE TABLE IF NOT EXISTS `#__smtps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_mailaccount` int(11) NOT NULL,
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

INSERT INTO `#__knownservers` (`id`, `suffix`, `host`, `port`, `protocol`, `auth`, `connsecurity`, `user`) VALUES
(1, '', 'mail.#suffix#', 143, 1, 1, 1, 1),
(2, '', 'mail.#suffix#', 993, 1, 1, 3, 1),
(3, '', 'mail.#suffix#', 110, 2, 1, 1, 1),
(4, '', 'mail.#suffix#', 995, 2, 1, 3, 1),
(5, '', 'imap.#suffix#', 143, 1, 1, 1, 1),
(6, '', 'imap.#suffix#', 993, 1, 1, 3, 1),
(7, '', 'pop.#suffix#', 110, 2, 1, 1, 1),
(8, '', 'pop.#suffix#', 995, 2, 1, 3, 1),
(9, 'aol.com', 'imap.de.aol.com', 143, 1, 1, 1, 1),
(10, 'gmx.de', 'pop.gmx.com', 995, 2, 1, 3, 2),
(11, '', 'mail.#suffix#', 25, -1, 1, 0, 1),
(12, 'web.de', 'smtp.web.de', 587, -1, 1, 2, 1),
(13, '', 'smtp.#suffix#', 25, -1, 1, 0, 1),
(14, '', 'mail.#suffix#', 587, -1, 1, 2, 1),
(15, 'gmx.de', 'smtp.gmx.com', 25, -1, 1, 3, 2),
(16, 'aol.com', 'smtp.de.aol.com', 587, -1, 5, 1, 1),
(17, 'web.de', 'imap.web.de', 993, 1, 1, 3, 1),
(18, 'gmx.de', 'imap.gmx.com', 993, 1, 1, 3, 2),
(19, 't-online.de', 'secureimap.t-online.de', 993, 1, 1, 3, 2);
