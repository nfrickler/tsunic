<!-- | language file english -->
<?php
$lang = array(

	// classes
	'CLASS__SENDERLOCAL__HOST' => 'Localhost',
	'CLASS__SENDERLOCAL__USER' => 'Local user',

	'CLASS__SERVERBOX__ADDATTACHMENTERROR' => 'Attachment couldn\'t be downloaded!',

	'CLASS__ACCOUNT__AUTHS_NORMAL' => 'Normal',
	'CLASS__ACCOUNT__AUTHS_ENCRYPTEDPWD' => 'Encrypted password',
	'CLASS__ACCOUNT__AUTHS_NTLM' => 'NTLM',
	'CLASS__ACCOUNT__AUTHS_KERBEROS_GSSAPI' => 'Kerberos/GSSAPI',
	'CLASS__ACCOUNT__PROTOCOLS_IMAP' => 'IMAP',
	'CLASS__ACCOUNT__PROTOCOLS_POP3' => 'POP3',
	'CLASS__ACCOUNT__CONNSECURITIES_NONE' => 'None',
	'CLASS__ACCOUNT__CONNSECURITIES_STARTTLS' => 'STARTTLS',
	'CLASS__ACCOUNT__CONNSECURITIES_SSLTLS' => 'SLL/TLS',
	'CLASS__ACCOUNT__CONNSECURITIES_SSLTLSNOVAL' => 'SSL/TLS (invalid certificate)',
	'CLASS__ACCOUNT__NOCONNECTION' => 'Connection to server failed!',

	'CLASS__SMTP__AUTHS_NORMAL' => 'Normal',
	'CLASS__SMTP__AUTHS_ENCRYPTEDPWD' => 'Encrypted password',
	'CLASS__SMTP__AUTHS_NTLM' => 'NTLM',
	'CLASS__SMTP__AUTHS_KERBEROS_GSSAPI' => 'Kerberos/GSSAPI',
	'CLASS__SMTP__AUTHS_NOAUTH' => 'No authentication',
	'CLASS__SMTP__CONNSECURITIES_NONE' => 'None',
	'CLASS__SMTP__CONNSECURITIES_STARTTLS' => 'STARTTLS',
	'CLASS__SMTP__CONNSECURITIES_SSLTLS' => 'SLL/TLS',

	/* general */
	'INBOX__NAME' => 'Local inbox',
	'INBOX__DESCRIPTION' => 'Default Inbox of user (not editable)',

	/* common */
	'COMMON__BACKTOOVERVIEW' => 'Back to overview',
	'COMMON__RESET' => 'Reset',
	'COMMON__DELETE' => 'Delete',
	'COMMON__EDIT' => 'Edit',
	'COMMON_MISSINGINPUT' => 'Missing input-data! Please fill in all required fields!',
	'COMMON__INVALIDINPUT' => '{$$$COMMON_MISSINGINPUT}',
	'COMMON__TOBACK' => 'Back',
	'COMMON__ERROR' => 'An error occurred! Please try again!',
	'COMMON__CHOOSEPLEASE' => '--Choose please--',

	/* showMain */
	'SHOWMAIN__H1' => 'Your mails',
	'SHOWMAIN__INFO' => 'This is your mail-administration. To recieve mails from certain mailservers, you have to add these servers. All mails in your INBOX on this server will be automatically recieved and stored locally.',

	/* ************************* mailbox ************************************ */

	// updateMailbox
	'UPDATEMAILBOX__SUCCESS' => 'Mailbox updated.',

	/* showMailboxes */
	'SHOWMAILBOXES__YOURMAILBOXES' => 'Your Mailboxes',
	'SHOWMAILBOXES__TOCREATENEWBOX' => 'Create a new mailbox',
	'SHOWMAILBOXES__EDIT' => '{$$$COMMON__EDIT}',
	'SHOWMAILBOXES__DELETE' => '{$$$COMMON__DELETE}',
	'SHOWMAILBOXES__NAME' => 'Name',
	'SHOWMAILBOXES__DESCRIPTION' => 'Description',
	'SHOWMAILBOXES__MAILNUMBER' => 'Number of mails',
	'SHOWMAILBOXES__POPUP_DELETE_HEADER' => 'Delete mailbox "#name#"?',
	'SHOWMAILBOXES__POPUP_DELETE_HEADER_JS' => 'Delete mailbox?',
	'SHOWMAILBOXES__POPUP_DELETE_CONTENT' => 'Do you really want to delete this mailbox?',
	'SHOWMAILBOXES__POPUP_DELETE_YES' => 'Yes, delete.',
	'SHOWMAILBOXES__POPUP_DELETE_NO' => 'No, cancel.',

	/* showMailbox */
	'SHOWMAILBOX__H1' => 'Mails - #name#',
	'SHOWMAILBOX__NUMBEROFMAILS' => 'Number of mails:',
	'SHOWMAILBOX__FROMADDRESS' => 'From',
	'SHOWMAILBOX__SUBJECT' => 'Subject',
	'SHOWMAILBOX__NOMAILINBOX' => 'There are no mails in this mailbox.',
	'SHOWMAILBOX__TOSHOWMAILBOXES' => 'Back to all mailboxes',
	'SHOWMAILBOX__TOSHOWWRITEMAIL' => 'Write mail',
	'SHOWMAILBOX__JS_UPDATER' => 'Searching for new mails...',
	'SHOWMAILBOX__OPTIONBOX_NEWMAILS_HEADER' => 'New mails',
	'SHOWMAILBOX__OPTIONBOX_NEWMAILS_CONTENT' => 'New mails have been recieved. Refresh the page to load new mails!',
	'SHOWMAILBOX__OPTIONBOX_NEWMAILS_YES' => 'Reload page',
	'SHOWMAILBOX__OPTIONBOX_NEWMAILS_NO' => 'Cancel',
	'SHOWMAILBOX__UPDATER_NONEWMAILS' => 'No new mails on server',
	'SHOWMAILBOX__UPDATER_FAIL' => 'Update of mailbox failed!',
	'SHOWMAILBOX__SELECTALL' => 'Select all',
	'SHOWMAILBOX__DESELECTALL' => 'Deselect all',
	'SHOWMAILBOX__PERFORMACTION_DELETE' => 'Delete',
	'SHOWMAILBOX__PERFORMACTION_SETSPAM' => 'Spam',
	'SHOWMAILBOX__PERFORMACTION_MOVE' => 'Move to...',
	'SHOWMAILBOX__PERFORMACTION_MOVE_SUBMIT' => 'Move Mails',
	'SHOWMAILBOX__TOUPDATEMAILBOX' => 'Check for new mails',

	// performMailsAction
	'PERFORMMAILSACTION__SUCCESS' => 'Action successfully performed.',

	/* showAddMailbox */
	'SHOWADDMAILBOX__SUBMIT' => 'Create mailbox',
	'SHOWADDMAILBOX__RESET' => '{$$$COMMON__RESET}',
	'SHOWADDMAILBOX__H1' => 'Add mailbox',
	'SHOWADDMAILBOX__INFO' => 'To add a local mailbox, fill in the following form and submit.',
	'SHOWADDMAILBOX__TOSHOWMAILBOXES' => 'Back to all mailboxes',

	/* addmailbox */
	'ADDMAILBOX__SUCCESS' => 'New mailbox has been successfully created.',
	'ADDMAILBOX__INVALIDINPUT' => 'Please fill in all required fields correctly.',

	/* showEditMailbox */
	'SHOWEDITMAILBOX__H1' => 'Edit mailbox "#0#"',
	'SHOWEDITMAILBOX__INFO' => 'Via this form you can edit the data of your mailbox.',
	'SHOWEDITAILBOX__SUBMIT' => 'Save changes',
	'SHOWEDITMAILBOX__RESET' => '{$$$COMMON__RESET}',
	'SHOWEDITMAILBOX__TOSHOWMAILBOXES' => 'Back to all mailboxes',

	/* editMailbox */
	'EDITMAILBOX__SUCCESS' => 'Changes have been successfully saved.',
	'EDITMAILBOX__INVALIDINPUT' => 'Please fill in all required fields correctly.',

	/* formMailbox */
	'FORMMAILBOX__LEGEND' => 'Your local mailbox',
	'FORMMAILBOX__NAME' => 'Name',
	'FORMMAILBOX__PRESET_NAME' => 'Name of your local mailbox',
	'FORMMAILBOX__HELP_NAME' => 'Insert an individual name for your local mailbox.',
	'FORMMAILBOX__DESCRIPTION' => 'Description',
	'FORMMAILBOX__PRESET_DESCRIPTION' => 'A description of your mailbox.',
	'FORMMAILBOX__HELP_DESCRIPTION' => 'Insert a description for your mailbox (optional).',
	'FORMMAILBOX_ERROR_INVALIDINPUT' => 'Please fill in all required fields correctly.',

	/* showDeleteMailBox */
	'SHOWDELETEMAILBOX__POPUP_DELETE_HEADER' => 'Delete mailserver "#name#"?',
	'SHOWDELETEMAILBOX__POPUP_DELETE_HEADER_JS' => 'Delete mailserver?',
	'SHOWDELETEMAILBOX__POPUP_DELETE_CONTENT' => 'Do you really want to delete this mailserver?',
	'SHOWDELETEMAILBOX__POPUP_DELETE_YES' => 'Yes, delete.',
	'SHOWDELETEMAILBOX__POPUP_DELETE_NO' => 'No, cancel.',

	/* deleteMailbox */
	'DELETEMAILBOX__SUCCESS' => 'Mailbox has been successfully deleted.',
	'DELETEMAILBOX__ERROR' => 'Mailbox couldn\'t be deleted.',

	/* ********************** mailservers *********************************** */

	// showMailservers
	'SHOWMAILSERVERS__TITLE' => 'Your Mailservers',
	'SHOWMAILSERVERS__H1' => 'Your Mailservers',
	'SHOWMAILSERVERS__INFOTEXT' => 'This is a list of all mailaccounts and SMTP-servers connected to your account.',
	'SHOWMAILSERVERS__ACCOUNTS_H1' => 'Your Mailaccounts',
	'SHOWMAILSERVERS__ACCOUNTS_INFO' => 'This is a list of all mailaccounts added to your user-account. You can add an new one, edit their attributes and delete them, if you don\'t want to have them registered here any more. Mailaccounts are used to fetch e-mails from your mailboxes.',
	'SHOWMAILSERVERS__ACCOUNTS_ADD' => 'Add mailaccount',
	'SHOWMAILSERVERS__SMTPS_H1' => 'Your Smtp-Servers',
	'SHOWMAILSERVERS__SMTPS_INFO' => 'This is a list of all your SMTP-Servers connected to this system. You can add an new one, edit their attributes and delete them, if you don\'t want to have them registered here any more. SMTP-servers enable you to send e-mails from an certain address.',
	'SHOWMAILSERVERS__SMTPS_ADD' => 'Add SMTP-Server',

	/* ************************* mailaccount ******************************** */

	// showAccount
	'SHOWACCOUNT__H1' => 'Mailaccount "#name#"',
	'SHOWACCOUNT__TOEDITACCOUNT' => 'Edit',
	'SHOWACCOUNT__TODELETEACCOUNT' => 'Delete',
	'SHOWACCOUNT__INFOTEXT' => 'Mailaccounts enable you to recieve e-mails from the server\'s mailboxes (called serverboxes).',
	'SHOWACCOUNT__NAME' => 'Name',
	'SHOWACCOUNT__DESCRIPTION' => 'Description',
	'SHOWACCOUNT__EMAIL' => 'E-mail',
	'SHOWACCOUNT__DATEOFCREATION' => 'Date of creation',
	'SHOWACCOUNT__SERVERBOXES_H1' => 'Account\'s Serverboxes',
	'SHOWACCOUNT__SERVERBOXES_INFO' => 'This is a list of serverboxes of this mailaccount. Activate those, from whom you want to recieve e-mails on this system. New mails will be transfered in the given local mailbox.',
	'SHOWACCOUNT__SERVERBOXES_ADD' => 'Add another serverbox manually',
	'SHOWACCOUNT__SERVERBOXES_SUBMIT' => 'De-/Activate serverboxes',
	'SHOWACCOUNT__SERVERBOXES_REFRESH' => 'Refresh serverbox-list',
	'SHOWACCOUNT__SMTPS_H1' => 'Account\'s SMTP-servers',
	'SHOWACCOUNT__SMTPS_INFO' => 'This is a list of SMTP-servers of this mailaccount.',
	'SHOWACCOUNT__SMTPS_ADD' => 'Add SMTP-server',

	// refresh serverboxes
	'REFRESHSERVERBOXES__SUCCESS' => 'The list of serverboxes has been updated.',

	// showListAccounts
	'SHOWLISTACCOUNTS__NAME' => 'Name',
	'SHOWLISTACCOUNTS__DESCRIPTION' => 'Description',
	'SHOWLISTACCOUNTS__EMAIL' => 'E-Mail',
	'SHOWLISTACCOUNTS__NOACCOUNTS' => 'No mail-accounts added yet.',

	// showEditMailaccount
	'SHOWEDITACCOUNT__H1' => 'Edit Mailaccount',
	'SHOWEDITACCOUNT__INFO' => 'Via this form you can edit this mailaccount.',
	'SHOWEDITACCOUNT__SUBMIT' => 'Save changes',
	'SHOWEDITACCOUNT__RESET' => '{$$$COMMON__RESET}',
	'SHOWEDITACCOUNT__TITLE' => 'Edit Mailaccount',
	'SHOWEDITACCOUNT__TOBACK' => '{$$$COMMON__BACKTOOVERVIEW}',

	// editMailaccount
	'EDITACCOUNT__INVALIDINPUT' => '{$$$COMMON__INVALIDINPUT}',
	'EDITACCOUNT__ERROR' => '{$$$COMMON__ERROR}',
	'EDITACCOUNT__SUCCESS' => 'Changes have been successfully saved.',
	'EDITACCOUNT__CONNERROR' => 'Connection to mail-server could not be established. Have you entered the correct password? Otherwise, please fill in the correct connection-details manually!',

	// showAddMailaccount
	'SHOWADDACCOUNT__TITLE' => 'Add mailaccount',
	'SHOWADDACCOUNT__H1' => 'Add mailaccount',
	'SHOWADDACCOUNT__INFO' => 'Via this form you can add an e-mail-account. Afterwards you can easily add in- and outgoing servers. The system will try to find the connection details on it\'s on, if these fields are left blank.',
	'SHOWADDACCOUNT__SUBMIT' => 'Add mailaccount',
	'SHOWADDACCOUNT__RESET' => '{$$$COMMON__RESET}',
	'SHOWADDACCOUNT__TOBACK' => '{$$$COMMON__BACKTOOVERVIEW}',

	// addMailaccount
	'ADDACCOUNT__INVALIDINPUT' => '{$$$COMMON__INVALIDINPUT}',
	'ADDACCOUNT__ERROR' => 'An error occurred! Please try again!',
	'ADDACCOUNT__SUCCESS' => 'New Mailaccount has been successfully added.',
	'ADDACCOUNT__CONNERROR' => 'Connection to mail-server could not be established. Have you entered the correct password? Otherwise, please fill in the correct connection-details manually!',

	// formMailaccount
	'FORMACCOUNT__LEGEND_EMAILACCOUNT' => 'Data of mail-account',
	'FORMACCOUNT__NAME' => 'Name',
	'FORMACCOUNT__PRESET_NAME' => 'Optional name',
	'FORMACCOUNT__HELP_NAME' => 'Give this mail-account an optional name.',
	'FORMACCOUNT__DESCRIPTION' => 'Description',
	'FORMACCOUNT__PRESET_DESCRIPTION' => 'Short description',
	'FORMACCOUNT__HELP_DESCRIPTION' => 'Here you can insert a short description of this mail-account.',
	'FORMACCOUNT__EMAIL' => 'E-mail-address',
	'FORMACCOUNT__PRESET_EMAIL' => 'E-mail-address of mail-account',
	'FORMACCOUNT__HELP_EMAIL' => 'Insert the e-mail-address of your e-mail-account.',
	'FORMACCOUNT__PASSWORD' => 'Password',
	'FORMACCOUNT__HELP_PASSWORD' => 'The password of this e-mail-account.',
	'FORMACCOUNT__LEGEND_LOGINDATA' => 'Your login-data',
	'FORMACCOUNT__LEGEND_CONNECTION' => 'Connection details',
	'FORMACCOUNT__HOST' => 'Host',
	'FORMACCOUNT__PRESET_HOST' => 'Hostserver',
	'FORMACCOUNT__HELP_HOST' => 'You can get the host from your e-mail-service (might be s.th. like "mail.abc.yz")',
	'FORMACCOUNT__PORT' => 'Port',
	'FORMACCOUNT__PRESET_PORT' => 'Port to connect to server',
	'FORMACCOUNT__HELP_PORT' => 'The port to connect to IMAP- or POP3-server. Default-ports: POP3: 110 AND IMAP:143. Ask your e-mail-service for further information.',
	'FORMACCOUNT__USER' => 'User',
	'FORMACCOUNT__PRESET_USER' => 'Your username of this mailaccount',
	'FORMACCOUNT__HELP_USER' => 'Your username of this mailaccount (this might be the part of your e-mail-address in front of the at-Symbol)',

	'FORMACCOUNT__PROTOCOL' => 'Protocol',
	'FORMACCOUNT__PROTOCOL_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
	'FORMACCOUNT__HELP_PROTOCOL' => 'Choose a protocol to connect to server.',
	'FORMACCOUNT__AUTH' => 'Password security',
	'FORMACCOUNT__AUTH_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
	'FORMACCOUNT__HELP_AUTH' => 'Choose a password-security level.',
	'FORMACCOUNT__CONNSECURITY' => 'Connection security',
	'FORMACCOUNT__CONNSECURITY_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
	'FORMACCOUNT__HELP_CONNSECURITY' => 'Choose a connection security-level.',
	'FORMACCOUNT__SUBINFO' => 'The loading may take some time after submitting the form, because the system is trying to connect to the server.',

	// showDeleteAccount
	'SHOWDELETEACCOUNT__TITLE' => 'Delete mailaccount',
	'SHOWDELETEACCOUNT__POPUP_DELETE_HEADER_JS' => 'Delete mailaccount?',
	'SHOWDELETEACCOUNT__POPUP_DELETE_HEADER' => 'Delete mailaccount "#name#"?',
	'SHOWDELETEACCOUNT__POPUP_DELETE_CONTENT' => 'Do you really want to remove this mailaccount from this system. You will neither recieve mails from any boxes of this mailaccount any more nor any mails can be sent via it\'s SMTP-servers.',
	'SHOWDELETEACCOUNT__POPUP_DELETE_YES' => 'Yes, remove.',
	'SHOWDELETEACCOUNT__POPUP_DELETE_NO' => 'No, cancel.',

	// deleteAccount
	'DELETEACCOUNT__ERROR' => '{$$$COMMON__ERROR}',
	'DELETEACCOUNT__SUCCESS' => 'Mailaccount has been successfully removed from this system.',

	/* ************************* serverbox ********************************** */

	/* showListServerboxes */
	'SHOWLISTSERVERBOXES__EDIT' => '{$$$COMMON__EDIT}',
	'SHOWLISTSERVERBOXES__DELETE' => '{$$$COMMON__DELETE}',
	'SHOWLISTSERVERBOXES__NOSERVER' => 'No serverboxes in this list.',
	'SHOWLISTSERVERBOXES__NAME' => 'Name',
	'SHOWLISTSERVERBOXES__FKMAILBOX' => 'Transfer new mails to...',
	'SHOWLISTSERVERBOXES__SERVERBOXES' => 'Serverboxes',

	// activateServerboxes
	'ACTIVATESERVERBOXES__SUCCESS' => 'Changes have been saved.',

	// showAddServerbox
	'SHOWADDSERVERBOX__H1' => 'Add serverbox',
	'SHOWADDSERVERBOX__INFO' => 'Fill in this form to add a serverbox.',
	'SHOWADDSERVERBOX__SUBMIT' => 'Add serverbox',
	'SHOWADDSERVERBOX__RESET' => '{$$$COMMON__RESET}',
	'SHOWADDSERVERBOX__TOOVERVIEW' => '{$$$COMMON__BACKTOOVERVIEW}',
	'SHOWADDSERVERBOX__INVALIDINPUT' => 'Invalid input! Please try again!',

	// showEditServerbox
	'SHOWEDITSERVERBOX__H1' => 'Edit serverbox',
	'SHOWEDITSERVERBOX__INFO' => 'Edit the values of this serverbox via following form.',
	'SHOWEDITSERVERBOX__SUBMIT' => 'Save changes',
	'SHOWEDITSERVERBOX__RESET' => '{$$$COMMON__RESET}',
	'SHOWEDITSERVERBOX__TOOVERVIEW' => '{$$$COMMON__BACKTOOVERVIEW}',

	// showServerboxes
	'SHOWSERVERBOXES__H1' => 'Serverboxes of "#servername#"',
	'SHOWSERVERBOXES__INFO' => 'This are the serverboxes registered for the server. All this serverboxes will be checked for new mails. New mails will be saved in the local mailbox, linked to the serverbox.',
	'SHOWSERVERBOXES__NAME' => 'Name of serverbox',
	'SHOWSERVERBOXES__TOMAILBOX' => 'Local mailbox',
	'SHOWSERVERBOXES__EDIT' => '{$$$COMMON__EDIT}',
	'SHOWSERVERBOXES__DELETE' => '{$$$COMMON__DELETE}',
	'SHOWSERVERBOXES__NOSERVERBOXES' => 'No serverboxes added to this server.',
	'SHOWSERVERBOXES__ADDSERVERBOX' => 'Add serverbox',

	// formServerbox
	'FORMSERVERBOX__LEGEND' => 'Data of serverbox',
	'FORMSERVERBOX__NAME' => 'Name on server ',
	'FORMSERVERBOX__SELECTMAILBOX' => 'Local mailbox',
	'FORMSERVERBOX__SELECTMAILBOX_CREATENEW' => 'Create new mailbox',
	'FORMSERVERBOX__TOBOX_CREATENEW' => 'Name of new mailbox',
	'FORMSERVERBOX__PRESET_NAME' => 'Name of serverbox',
	'FORMSERVERBOX__HELP_NAME' => 'Name of mailbox on server (e.g. "INBOX")',
	'FORMSERVERBOX__HELP_SELECTMAILBOX' => 'Select local mailbox to which new mails are transfered.',
	'FORMSERVERBOX__PRESET_NEWMAILBOX' => 'Name of new mailbox',
	'FORMSERVERBOX__HELP_NEWMAILBOX' => 'Insert a name to create a new local mailbox.',

	// editServerbox
	'EDITSERVERBOX__INVALIDINPUT' => 'Invalid input!',
	'EDITSERVERBOX__ERROROCCURRED' => 'Error occurred!',
	'EDITSERVERBOX__SUCCESS' => 'Changes successfully saved.',

	// addServerbox
	'ADDSERVERBOX__INVALIDINPUT' => 'Invalid input!',
	'ADDSERVERBOX__ERROROCCURRED' => 'Error occurred!',
	'ADDSERVERBOX__SUCCESS' => 'Serverbox successfully added.',

	// showDeleteServerbox
	'SHOWDELETESERVERBOX__POPUP_DELETE_HEADER' => 'Delete Serverbox #name#?',
	'SHOWDELETESERVERBOX__POPUP_DELETE_CONTENT' => 'Do you want to delete the serverbox on this system? New mails in this serverbox will not be loaded anymore?',
	'SHOWDELETESERVERBOX__POPUP_DELETE_YES' => 'Yes, delete.',
	'SHOWDELETESERVERBOX__POPUP_DELETE_NO' => 'No, cancel.',

	// deleteServerbox
	'DELETESERVERBOX__ERROR' => 'An error occurred. Please try again!',
	'DELETESERVERBOX__SUCCESS' => 'Serverbox has been successfully deleted.',
	'SHOWEDITSERVERBOX__TODELETESERVERBOX' => 'Delete this serverbox',

	/* *********************** smtps **************************************** */

	// showListSmtps
	'SHOWLISTSMTPS__EMAILNAME' => 'Sender',
	'SHOWLISTSMTPS__AUTH' => 'Security',
	'SHOWLISTSMTPS__EDIT' => 'Edit Smtp-server',
	'SHOWLISTSMTPS__DELETE' => 'Delete Smtp-server',
	'SHOWLISTSMTPS__NOSMTPS' => 'No Smtp-servers registered yet.',
	'SHOWLISTSMTPS__DESCRIPTION' => 'Description',

	// showAddSmtp
	'SHOWADDSMTP__H1' => 'Add SMTP-server',
	'SHOWADDSMTP__INFO' => 'Fill in this form to add a SMTP-server to your account. You can leave the connection-details empty, to let the system looking for the right settings on it\'s own.',
	'SHOWADDSMTP__SUBMIT' => 'Add SMTP-server',
	'SHOWADDSMTP__RESET' => '{$$$COMMON__RESET}',
	'SHOWADDSMTP__OVERVIEW' => '{$$$COMMON__TOBACK}',

	// addSmtp
	'ADDSMTP__SUCCESS' => 'SMTP-server has been added successfully.',
	'ADDSMTP__ERROR' => 'An error occurred. Please try again!',
	'ADDSMTP__INVALIDINPUT' => 'Invalid data. Please check your inputs!',
	'ADDSMTP__CONNERROR' => 'Connection could not be established. Please fill in the correct connection-details manually.',

	// showEditSmtp
	'SHOWEDITSMTP__H1' => 'Edit SMTP-server',
	'SHOWEDITSMTP__INFO' => 'By changing values in this form you can edit the smtp-server settings.',
	'SHOWEDITSMTP__SUBMIT' => 'Save changes',
	'SHOWEDITSMTP__RESET' => '{$$$COMMON__RESET}',
	'SHOWEDITSMTP__TOOVERVIEW' => '{$$$COMMON__TOBACK}',

	// editSmtp
	'EDITSMTP__SUCCESS' => 'Changes have been saved.',
	'EDITSMTP__ERROR' => 'An error occurred. Please try again!',
	'EDITSMTP__INVALIDINPUT' => 'Invalid data. Please check your inputs!',
	'EDITSMTP__CONNERROR' => 'Connection could not be established. Please fill in the correct connection-details manually.',

	// formSmtp
	'FORMSMTP__LEGEND_SMTPACCOUNT' => 'SMTP-data',
	'FORMSMTP__MAILACCOUNT' => 'Mailaccount',
	'FORMSMTP__MAILACCOUNT_NOACCOUNT' => 'Added to no account',
	'FORMSMTP__HELP_MAILACCOUNT' => 'Choose a mailaccount, this SMTP-server belongs to. You can also add a standalone SMTP-server.',
	'FORMSMTP__EMAIL' => 'E-Mail',
	'FORMSMTP__PRESET_EMAIL' => 'E-Mail-address',
	'FORMSMTP__HELP_EMAIL' => 'Your e-mail-address.',
	'FORMSMTP__PASSWORD' => 'Password',
	'FORMSMTP__HELP_PASSWORD' => 'The password for your Smtp-server.',
	'FORMACCOUNT__LEGEND_OPTIONALDATA' => 'Optional SMTP-data',
	'FORMSMTP__EMAILNAME' => 'Your name',
	'FORMSMTP__PRESET_EMAILNAME' => 'Your name',
	'FORMSMTP__HELP_EMAILNAME' => 'This name will be shown as the sender (optional)',
	'FORMSMTP__DESCRIPTION' => 'Description',
	'FORMSMTP__PRESET_DESCRIPTION' => 'A short description...',
	'FORMSMTP__HELP_DESCRIPTION' => 'Here you can add a short description of this SMTP-server (optional)',
	'FORMSMTP__LEGEND_CONNECTION' => 'Connection-details',
	'FORMSMTP__HOST' => 'Host',
	'FORMSMTP__PRESET_HOST' => 'Smtp-server',
	'FORMSMTP__HELP_HOST' => 'Insert the host of this SMTP-server (e.g. mail.abc.yz)',
	'FORMSMTP__PORT' => 'Port',
	'FORMSMTP__PRESET_PORT' => 'Connection-port',
	'FORMSMTP__HELP_PORT' => 'Port to connect to server (normally 25, 465 or 587)',
	'FORMSMTP__USER' => 'User',
	'FORMSMTP__PRESET_USER' => 'Smtp-user',
	'FORMSMTP__HELP_USER' => 'User of the smtp-server (normally the name before @-character in your e-mail-address)',
	'FORMSMTP__CONNSECURITY' => 'Connection security',
	'FORMSMTP__CONNSECURITY_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
	'FORMSMTP__HELP_CONNSECURITY' => 'Choose a connection-security',
	'FORMSMTP__AUTH' => 'Password security',
	'FORMSMTP__AUTH_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
	'FORMSMTP__HELP_AUTH' => 'Choose an password-security-level',

	// showDeleteSmtp
	'SHOWDELETESMTP__POPUP_DELETE_HEADER' => 'Remove SMTP-server #name#?',
	'SHOWDELETESMTP__POPUP_DELETE_HEADER_JS' => 'Remove this SMTP-server?',
	'SHOWDELETESMTP__POPUP_DELETE_CONTENT' => 'Do you really want to remove this smpt-server from this system?',
	'SHOWDELETESMTP__POPUP_DELETE_YES' => 'Yes, remove.',
	'SHOWDELETESMTP__POPUP_DELETE_NO' => 'No, cancel.',

	// deleteSmtp
	'DELETESMTP__ERROR' => 'An error occurred. Please try again!',
	'DELETESMTP__SUCCESS' => 'Smtp-server has been deleted successfully.',

	/* **************************** mail ************************************ */

	/* showMail */
	'SHOWMAIL__H1' => 'Your mail',
	'SHOWMAIL__DELETE' => 'Delete mail',
	'SHOWMAIL__ANSWERMAIL' => 'Write answer',
	'SHOWMAIL__TOSHOWMAILBOX' => 'Back to mailbox',
	'SHOWMAIL__ATTACHMENTS' => 'Attachments',
	'SHOWMAIL__NOIFRAMESUPPORT' => 'Your browser doesn\'t support iframes, so the mail couldn\'t be embedded here...',
	'SHOWMAIL__NOIFRAMESUPPORT_OPENMAIL' => 'Please open mail in new window or tab',
	'SHOWMAIL__SENDER' => 'Sender',
	'SHOWMAIL__ADDRESSEE' => 'Addressee',
	'SHOWMAIL__DATEOFMAIL' => 'Date',

	/* deleteMail */
	'SHOWDELETEMAIL__POPUP_DELETE_HEADER' => 'Delete mail "#name#"?',
	'SHOWDELETEMAIL__POPUP_DELETE_HEADER_JS' => 'Delete this mail?',
	'SHOWDELETEMAIL__POPUP_DELETE_CONTENT' => 'Do you really want to delete this mail?',
	'SHOWDELETEMAIL__POPUP_DELETE_YES' => 'Yes, delete',
	'SHOWDELETEMAIL__POPUP_DELETE_NO' => 'No, cancel',
	
	/* deleteMail */
	'DELETEMAIL__ERROR' => 'Mail couldn\'t be deleted.',
	'DELETEMAIL__SUCCESS' => 'Mail has been successfully deleted.',

	// showSendMail
	'SHOWSENDMAIL__H1' => 'Send mail',
	'SHOWSENDMAIL__INFO' => 'Fill in this form to send a mail to someone.',
	'SHOWSENDMAIL__TOSHOWMAILBOXES' => 'Cancel and show mailboxes',
	'SHOWSENDMAIL__LEGEND_HEADER' => 'Header of mail',
	'SHOWSENDMAIL__LEGEND_CONTENT' => 'Content of mail',
	'SHOWSENDMAIL__SUBMIT' => 'Send mail',
	'SHOWSENDMAIL__RESET' => '{$$$COMMON__RESET}',
	'SHOWSENDMAIL__SENDER' => 'Sender',
	'SHOWSENDMAIL__LOCALSENDER' => 'Local sender',
	'SHOWSENDMAIL__ADDRESSEE' => 'Addressee',
	'SHOWSENDMAIL__SENDER_HELP' => 'Choose a sender for the mail',
	'SHOWSENDMAIL__ADDRESSEE_PRESET' => 'Addressee of mail',
	'SHOWSENDMAIL__ADDRESSEE_HELP' => 'Username or e-mail-address of addressee',
	'SHOWSENDMAIL__SUBJECT' => 'Subject',
	'SHOWSENDMAIL__SUBJECT_PRESET' => 'Subject of your mail',
	'SHOWSENDMAIL__SUBJECT_HELP' => 'Write down a subject for this mail',
	'SHOWSENDMAIL__CONTENT' => 'Content',
	'SHOWSENDMAIL__CONTENT_PRESET' => 'Content of your mail',
	'SHOWSENDMAIL__CONTENT_HELP' => 'The message of this mail.',
	'SHOWSENDMAIL__ADDSMTPFIRST' => 'Please add a smtp-server first, which can handle sending your e-mails.',

	/* sendMail */
	'SENDMAIL__INVALIDINPUT' => 'Please fill in all required fields before sending!',
	'SENDMAIL__SUCCESS' => 'Mail has been sent successfully.',
	'SENDMAIL__INVALIDADDRESSEE' => 'At least one invalid addressee!',
	'SENDMAIL__ERROR' => 'Error occurred! E-Mail could not be sent.',

	/* ***************** _system_navigation ********************************* */

	'_NAVIGATION__SHOWMAILBOXES' => 'Your mailboxes',
	'_NAVIGATION__SHOWSENDMAIL' => 'Send mail',
	'_NAVIGATION__SHOWMAILSETTINGS' => 'Mailsettings',
	'_NAVIGATION__SHOWMAILSERVERS' => 'Mailservers',
	'_NAVIGATION_HEADER' => 'Mail'
);
?>
