<!-- | language file german -->
<?php
$lang = array(

	// classes
	'CLASS__SENDERLOCAL__HOST' => 'Localhost',
	'CLASS__SENDERLOCAL__USER' => 'Lokaler Benutzer',

	'CLASS__SERVERBOX__ADDATTACHMENTERROR' => 'Anhang konnte nicht heruntergeladen werden!',

	'CLASS__ACCOUNT__AUTHS_NORMAL' => 'Normal',
	'CLASS__ACCOUNT__AUTHS_ENCRYPTEDPWD' => 'Verschlüsseltes Passwort',
	'CLASS__ACCOUNT__AUTHS_NTLM' => 'NTLM',
	'CLASS__ACCOUNT__AUTHS_KERBEROS_GSSAPI' => 'Kerberos/GSSAPI',
	'CLASS__ACCOUNT__PROTOCOLS_IMAP' => 'IMAP',
	'CLASS__ACCOUNT__PROTOCOLS_POP3' => 'POP3',
	'CLASS__ACCOUNT__CONNSECURITIES_NONE' => 'None',
	'CLASS__ACCOUNT__CONNSECURITIES_STARTTLS' => 'STARTTLS',
	'CLASS__ACCOUNT__CONNSECURITIES_SSLTLS' => 'SLL/TLS',
	'CLASS__ACCOUNT__CONNSECURITIES_SSLTLSNOVAL' => 'SSL/TLS (invalid certificate)',
	'CLASS__ACCOUNT__NOCONNECTION' => 'Serververbindung konnte nicht eingerichet werden!',

	'CLASS__SMTP__AUTHS_NORMAL' => 'Normal',
	'CLASS__SMTP__AUTHS_ENCRYPTEDPWD' => 'Verschlüsseltes Passwort',
	'CLASS__SMTP__AUTHS_NTLM' => 'NTLM',
	'CLASS__SMTP__AUTHS_KERBEROS_GSSAPI' => 'Kerberos/GSSAPI',
	'CLASS__SMTP__AUTHS_NOAUTH' => 'Keine Authentifizierung',
	'CLASS__SMTP__CONNSECURITIES_NONE' => 'Kein',
	'CLASS__SMTP__CONNSECURITIES_STARTTLS' => 'STARTTLS',
	'CLASS__SMTP__CONNSECURITIES_SSLTLS' => 'SLL/TLS',

	/* general */
	'INBOX__NAME' => 'Posteingang',
	'INBOX__DESCRIPTION' => 'Standard Posteingang des Benutzers (nicht veränderbar)',

	/* common */
	'COMMON__BACKTOOVERVIEW' => 'Zurück zur Übersicht',
	'COMMON__RESET' => 'Reset',
	'COMMON__DELETE' => 'Löschen',
	'COMMON__EDIT' => 'Bearbeiten',
	'COMMON_MISSINGINPUT' => 'Fehlende Eingaben! Bitte fülle alle notwendigen Felder aus!',
	'COMMON__INVALIDINPUT' => '{$$$COMMON_MISSINGINPUT}',
	'COMMON__TOBACK' => 'Zurück',
	'COMMON__ERROR' => 'Es ist ein Fehler aufgetreten. Bitte versuche es erneut!',
	'COMMON__CHOOSEPLEASE' => '--Bitte wählen--',

	/* showMain */
	'SHOWMAIN__H1' => 'Deine Mails',
	'SHOWMAIN__INFO' => 'Dies ist deine Mail-Verwaltung. Um Mails von deinen E-Mail-Postfächern zu empfangen, füge bitte deinen Mailaccount in der Rubrik "Mailserver" hinzu. Um E-Mails über SMTP zu versenden, füge bitte an gleicher Stelle einen SMTP-Server hinzu.',

	/* ***************** mailbox ******************************* */

	// updateMailbox
	'UPDATEMAILBOX__SUCCESS' => 'Mailbox aktualisiert.',

	/* showMailboxes */
	'SHOWMAILBOXES__YOURMAILBOXES' => 'Deine Mailboxen',
	'SHOWMAILBOXES__TOCREATENEWBOX' => 'Erstelle neue Mailbox',
	'SHOWMAILBOXES__EDIT' => 'Bearbeiten',
	'SHOWMAILBOXES__DELETE' => 'Löschen',
	'SHOWMAILBOXES__NAME' => 'Name',
	'SHOWMAILBOXES__DESCRIPTION' => 'Beschreibung',
	'SHOWMAILBOXES__MAILNUMBER' => 'Zahl der Mails',
	'SHOWMAILBOXES__POPUP_DELETE_HEADER' => 'Mailbox "#name#" löschen?',
	'SHOWMAILBOXES__POPUP_DELETE_HEADER_JS' => 'Mailbox löschen?',
	'SHOWMAILBOXES__POPUP_DELETE_CONTENT' => 'Willst du wirklich diese Mailbox löschen?',
	'SHOWMAILBOXES__POPUP_DELETE_YES' => 'Ja, löschen.',
	'SHOWMAILBOXES__POPUP_DELETE_NO' => 'Nein, abbrechen.',

	/* showMailbox */
	'SHOWMAILBOX__H1' => 'Mailbox - #name#',
	'SHOWMAILBOX__NUMBEROFMAILS' => 'Mailanzahl:',
	'SHOWMAILBOX__FROMADDRESS' => 'Von',
	'SHOWMAILBOX__SUBJECT' => 'Betreff',
	'SHOWMAILBOX__NOMAILINBOX' => 'In dieser Mailbox sind keine Mails...',
	'SHOWMAILBOX__TOSHOWMAILBOXES' => 'Zurück zu allen Mailboxen',
	'SHOWMAILBOX__TOSHOWWRITEMAIL' => 'Mail schreiben',
	'SHOWMAILBOX__JS_UPDATER' => 'Suche neue Mails...',
	'SHOWMAILBOX__OPTIONBOX_NEWMAILS_HEADER' => 'Neue Mails',
	'SHOWMAILBOX__OPTIONBOX_NEWMAILS_CONTENT' => 'Es wurden neue Mails heruntergeladen. Bitte aktualisiere diese Seite, um die neuen Mails angezeigt zu bekommen.',
	'SHOWMAILBOX__OPTIONBOX_NEWMAILS_YES' => 'Aktualisieren',
	'SHOWMAILBOX__OPTIONBOX_NEWMAILS_NO' => 'Abbrechen',
	'SHOWMAILBOX__UPDATER_NONEWMAILS' => 'Keine neuen Mails gefunden',
	'SHOWMAILBOX__UPDATER_FAIL' => 'Aktualisierung der Mailbox ist fehlgeschlagen!',
	'SHOWMAILBOX__SELECTALL' => 'Alle auswählen',
	'SHOWMAILBOX__DESELECTALL' => 'Auswahl aufheben',
	'SHOWMAILBOX__PERFORMACTION_DELETE' => 'Löschen',
	'SHOWMAILBOX__PERFORMACTION_SETSPAM' => 'Spam',
	'SHOWMAILBOX__PERFORMACTION_MOVE' => 'Verschieben nach...',
	'SHOWMAILBOX__PERFORMACTION_MOVE_SUBMIT' => 'Mails verschieben',
	'SHOWMAILBOX__TOUPDATEMAILBOX' => 'Nach neuen Mails suchen',

	// performMailsAction
	'PERFORMMAILSACTION__SUCCESS' => 'Die gewählte Aktion wurde erfolgreich ausgeführt.',

	/* showAddMailbox */
	'SHOWADDMAILBOX__SUBMIT' => 'Mailbox erstellen',
	'SHOWADDMAILBOX__RESET' => 'Reset',
	'SHOWADDMAILBOX__H1' => 'Mailbox erstellen',
	'SHOWADDMAILBOX__INFO' => 'Bitte fülle das Formular aus, um eine neue lokale Mailbox zu erstellen.',
	'SHOWADDMAILBOX__TOSHOWMAILBOXES' => 'Zurück zu allen Mailboxen',

	/* addmailbox */
	'ADDMAILBOX__SUCCESS' => 'Die neue Mailbox wurde erfolgreich erstellt',
	'ADDMAILBOX__INVALIDINPUT' => 'Bitte fülle alle erforderlichen Felder aus!',

	/* showEditMailbox */
	'SHOWEDITMAILBOX__H1' => 'Mailbox "#0#" bearbeiten',
	'SHOWEDITMAILBOX__INFO' => 'Über dieses Formular kannst du die Daten der Mailbox bearbeiten.',
	'SHOWEDITAILBOX__SUBMIT' => 'Änderungen speichern',
	'SHOWEDITMAILBOX__RESET' => 'Reset',
	'SHOWEDITMAILBOX__TOSHOWMAILBOXES' => 'Zurück zu allen Mailboxen',

	/* editMailbox */
	'EDITMAILBOX__SUCCESS' => 'Die Änderungen wurden erfolgreich gespeichert.',
	'EDITMAILBOX__INVALIDINPUT' => 'Bitte fülle alle erforderlichen Felder korrekt aus!',

	/* formMailbox */
	'FORMMAILBOX__LEGEND' => 'Deine lokale Mailbox',
	'FORMMAILBOX__NAME' => 'Name',
	'FORMMAILBOX__PRESET_NAME' => 'Name deiner lokalen Mailbox',
	'FORMMAILBOX__HELP_NAME' => 'Gebe einen beliebigen Namen für deine lokale Mailbox ein',
	'FORMMAILBOX__DESCRIPTION' => 'Beschreibung',
	'FORMMAILBOX__PRESET_DESCRIPTION' => 'Eine Beschreibung der Mailbox',
	'FORMMAILBOX__HELP_DESCRIPTION' => 'Gebe eine Beschreibung der Mailbox ein (optional).',
	'FORMMAILBOX_ERROR_INVALIDINPUT' => 'Bitte fülle alle erforderlichen Felder korrekt aus!',

	/* showDeleteMailBox */
	'SHOWDELETEMAILBOX__POPUP_DELETE_HEADER' => 'Mailbox "#name#" löschen?',
	'SHOWDELETEMAILBOX__POPUP_DELETE_HEADER_JS' => 'Mailbox löschen?',
	'SHOWDELETEMAILBOX__POPUP_DELETE_CONTENT' => 'Willst du diese Mailbox wirklich löschen?',
	'SHOWDELETEMAILBOX__POPUP_DELETE_YES' => 'Ja, löschen.',
	'SHOWDELETEMAILBOX__POPUP_DELETE_NO' => 'Nein, abbrechen.',

	/* deleteMailbox */
	'DELETEMAILBOX__SUCCESS' => 'Die Mailbox wurde erfolgreich gelöscht',
	'DELETEMAILBOX__ERROR' => 'Die Mailbox konnte nicht gelöscht werden.',

	/* ********************** mailservers *********************************** */

	// showMailservers
	'SHOWMAILSERVERS__TITLE' => 'Deine Mailserver',
	'SHOWMAILSERVERS__H1' => 'Deine Mailserver',
	'SHOWMAILSERVERS__INFOTEXT' => 'Dies ist eine Liste deiner Mailaccounts und SMTP-Server, die du zu deinem Account auf diesem System hinzugefügt hast.',
	'SHOWMAILSERVERS__ACCOUNTS_H1' => 'Deine Mailaccounts',
	'SHOWMAILSERVERS__ACCOUNTS_INFO' => 'Hier sind alle Mailaccounts aufgelistet, die du mit diesem System verbunden hast. Du kannst einen weiteren hinzufügen, ihre Einstellungen ändern oder welche von diesem System wieder entfernen. Mithilfe von Mailaccounts kannst du über IMAP/POP3 E-Mails von deinen E-Mail-Accounts empfangen, über SMTP-Server kannst du E-Mails versenden.',
	'SHOWMAILSERVERS__ACCOUNTS_ADD' => 'Mailaccount hinzufügen',
	'SHOWMAILSERVERS__SMTPS_H1' => 'Deine SMTP-Server',
	'SHOWMAILSERVERS__SMTPS_INFO' => 'Dies ist eine Liste aller SMTP-Server, die du mit diesem System verbunden hast. Von diesen SMTP-Servern aus kannst du E-Mails versenden.',
	'SHOWMAILSERVERS__SMTPS_ADD' => 'SMTP-Server hinzufügen',

	/* ************************* mailaccount ******************************** */

	// showAccount
	'SHOWACCOUNT__H1' => 'Mailaccount "#name#"',
	'SHOWACCOUNT__TOEDITACCOUNT' => 'Bearbeiten',
	'SHOWACCOUNT__TODELETEACCOUNT' => 'Löschen',
	'SHOWACCOUNT__INFOTEXT' => 'Mailaccounts ermöglichen dir, E-Mails über IMAP/POP3 von deinen E-Mail-Accounts zu empfangen.',
	'SHOWACCOUNT__NAME' => 'Name',
	'SHOWACCOUNT__DESCRIPTION' => 'Beschreibung',
	'SHOWACCOUNT__EMAIL' => 'E-Mail',
	'SHOWACCOUNT__DATEOFCREATION' => 'Erstellungsdatum',
	'SHOWACCOUNT__SERVERBOXES_H1' => 'Serverboxen des Accounts',
	'SHOWACCOUNT__SERVERBOXES_INFO' => 'Serverboxen sind die Mailboxen deines externen E-Mailaccounts. Aktiviere eine Serverbox, um E-Mails aus dieser Box in eine lokale Mailbox zu laden.',
	'SHOWACCOUNT__SERVERBOXES_ADD' => 'Manuell eine weitere Serverbox hinzufügen',
	'SHOWACCOUNT__SERVERBOXES_SUBMIT' => 'Serverboxen de-/aktivieren',
	'SHOWACCOUNT__SERVERBOXES_REFRESH' => 'Serverbox-Liste aktualisieren',
	'SHOWACCOUNT__SMTPS_H1' => 'SMTP-Server des Accounts',
	'SHOWACCOUNT__SMTPS_INFO' => 'Diese Liste zeigt dir alle SMTP-Server, die zu diesem Account hinzugefügt sind.',
	'SHOWACCOUNT__SMTPS_ADD' => 'Add SMTP-server',

	// refresh serverboxes
	'REFRESHSERVERBOXES__SUCCESS' => 'Die Serverbox-Liste wurde aktualisiert.',

	// showListAccounts
	'SHOWLISTACCOUNTS__NAME' => 'Name',
	'SHOWLISTACCOUNTS__DESCRIPTION' => 'Beschreibung',
	'SHOWLISTACCOUNTS__EMAIL' => 'E-Mail',
	'SHOWLISTACCOUNTS__NOACCOUNTS' => 'Es wurden noch keine Mailaccounts hinzugefügt.',

	// showEditMailaccount
	'SHOWEDITACCOUNT__H1' => 'Mailaccount bearbeiten',
	'SHOWEDITACCOUNT__INFO' => 'Über dieses Formular kannst du den Mailaccount bearbeiten.',
	'SHOWEDITACCOUNT__SUBMIT' => 'Änderungen speichern',
	'SHOWEDITACCOUNT__RESET' => '{$$$COMMON__RESET}',
	'SHOWEDITACCOUNT__TITLE' => 'Mailaccount bearbeiten',
	'SHOWEDITACCOUNT__TOBACK' => '{$$$COMMON__BACKTOOVERVIEW}',

	// editMailaccount
	'EDITACCOUNT__INVALIDINPUT' => '{$$$COMMON__INVALIDINPUT}',
	'EDITACCOUNT__ERROR' => '{$$$COMMON__ERROR}',
	'EDITACCOUNT__SUCCESS' => 'Die Änderungen wurden erfolgreich gespeichert.',
	'EDITACCOUNT__CONNERROR' => 'Verbindung zum Server konnte nicht hergestellt werden. Hast du das richtige Passwort angegeben? Ansonsten fülle bitte die Verbindungsdaten manuell aus und versuche es erneut!',

	// showAddMailaccount
	'SHOWADDACCOUNT__TITLE' => 'Mailaccount hinzufügen',
	'SHOWADDACCOUNT__H1' => 'Mailaccount hinzufügen',
	'SHOWADDACCOUNT__INFO' => 'Mit diesem Formular kannst du einen Mailaccount zu diesem System hinzufügen. Das System wird versuchen, die richtigen Servereinstellungen selber zu finden, wenn die entsprechenden Felder freigelassen werden.',
	'SHOWADDACCOUNT__SUBMIT' => 'Mailaccount hinzufügen',
	'SHOWADDACCOUNT__RESET' => '{$$$COMMON__RESET}',
	'SHOWADDACCOUNT__TOBACK' => '{$$$COMMON__BACKTOOVERVIEW}',

	// addMailaccount
	'ADDACCOUNT__INVALIDINPUT' => '{$$$COMMON__INVALIDINPUT}',
	'ADDACCOUNT__ERROR' => 'Ein Fehler ist aufgetreten. Bitte versuche es erneut!',
	'ADDACCOUNT__SUCCESS' => 'Der Mailaccount wurde erfolgreich hinzugefügt.',
	'ADDACCOUNT__CONNERROR' => 'Verbindung zum Server konnte nicht hergestellt werden. Hast du das richtige Passwort angegeben? Ansonsten fülle bitte die Verbindungsdaten manuell aus und versuche es erneut!',

	// formMailaccount
	'FORMACCOUNT__LEGEND_EMAILACCOUNT' => 'Daten des Mailaccounts',
	'FORMACCOUNT__NAME' => 'Name',
	'FORMACCOUNT__PRESET_NAME' => 'Optionaler Name',
	'FORMACCOUNT__HELP_NAME' => 'Gebe dem Account einen optionalen Namen.',
	'FORMACCOUNT__DESCRIPTION' => 'Beschreibung',
	'FORMACCOUNT__PRESET_DESCRIPTION' => 'Kurze Beschreibung',
	'FORMACCOUNT__HELP_DESCRIPTION' => 'Hier kannst du eine kurze Beschreibung des Mailaccount einfügen.',
	'FORMACCOUNT__EMAIL' => 'E-Mail-Adresse',
	'FORMACCOUNT__PRESET_EMAIL' => 'E-Mailadresse des Accounts',
	'FORMACCOUNT__HELP_EMAIL' => 'Gebe hier die E-Mailadresse des Accounts an.',
	'FORMACCOUNT__PASSWORD' => 'Passwort',
	'FORMACCOUNT__HELP_PASSWORD' => 'Passwort des Mailaccounts.',
	'FORMACCOUNT__LEGEND_LOGINDATA' => 'Deine Login-Daten des Mailaccounts',
	'FORMACCOUNT__LEGEND_CONNECTION' => 'Verbindungsdaten',
	'FORMACCOUNT__HOST' => 'Host',
	'FORMACCOUNT__PRESET_HOST' => 'Hostserver',
	'FORMACCOUNT__HELP_HOST' => 'Du kannst den Hostserver bei deinem E-Mailanbieter erfragen (sollte etwas so aussehen wie "mail.abc.yz")',
	'FORMACCOUNT__PORT' => 'Port',
	'FORMACCOUNT__PRESET_PORT' => 'Verbindungsport',
	'FORMACCOUNT__HELP_PORT' => 'Die Portnummer, über die der Mailserver erreichbar ist. Diese Information kann ebenfalls beim Anbieter eingeholt werden.',
	'FORMACCOUNT__USER' => 'Benutzer',
	'FORMACCOUNT__PRESET_USER' => 'Benutzername für diesen Mailaccount',
	'FORMACCOUNT__HELP_USER' => 'Benutzername für diesen Mailaccount',

	'FORMACCOUNT__PROTOCOL' => 'Protokoll',
	'FORMACCOUNT__PROTOCOL_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
	'FORMACCOUNT__HELP_PROTOCOL' => 'Wähle eine Protokoll für die Verbindung zum Server.',
	'FORMACCOUNT__AUTH' => 'Passwort-Sicherheit',
	'FORMACCOUNT__AUTH_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
	'FORMACCOUNT__HELP_AUTH' => 'Wähle ein Sicherheitslevel für das Passwort.',
	'FORMACCOUNT__CONNSECURITY' => 'Verbindungssicherheit',
	'FORMACCOUNT__CONNSECURITY_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
	'FORMACCOUNT__HELP_CONNSECURITY' => 'Wähle ein Level für die Verbindungssicherheit.',
	'FORMACCOUNT__SUBINFO' => 'Das Laden der nächsten Seite kann etwas dauern, da versucht wird, eine Verbindung zum Mailserver herzustellen.',

	// showDeleteAccount
	'SHOWDELETEACCOUNT__TITLE' => 'Mailaccount löschen',
	'SHOWDELETEACCOUNT__POPUP_DELETE_HEADER_JS' => 'Mailaccount löschen?',
	'SHOWDELETEACCOUNT__POPUP_DELETE_HEADER' => 'Mailaccount "#name#" löschen?',
	'SHOWDELETEACCOUNT__POPUP_DELETE_CONTENT' => 'Willst du den Mailaccount wirklich löschen? Du wirst dann keine E-Mails mehr von diesem Mailaccount empfangen.',
	'SHOWDELETEACCOUNT__POPUP_DELETE_YES' => 'Ja, löschen.',
	'SHOWDELETEACCOUNT__POPUP_DELETE_NO' => 'Nein, abbrechen.',

	// deleteAccount
	'DELETEACCOUNT__ERROR' => '{$$$COMMON__ERROR}',
	'DELETEACCOUNT__SUCCESS' => 'Der Mailaccount wurde erfolgreich von System entfernt.',

	/* ***************** serverbox ***************************** */

	/* showListServerboxes */
	'SHOWLISTSERVERBOXES__EDIT' => '{$$$COMMON__EDIT}',
	'SHOWLISTSERVERBOXES__DELETE' => '{$$$COMMON__DELETE}',
	'SHOWLISTSERVERBOXES__NOSERVER' => 'Keine Serverboxen in dieser Liste.',
	'SHOWLISTSERVERBOXES__NAME' => 'Name',
	'SHOWLISTSERVERBOXES__FKMAILBOX' => 'Neue E-Mails verschieben nach...',
	'SHOWLISTSERVERBOXES__SERVERBOXES' => 'Serverboxen',

	// activateServerboxes
	'ACTIVATESERVERBOXES__SUCCESS' => 'Änderungen wurden gespeichert.',

	// showAddServerbox
	'SHOWADDSERVERBOX__H1' => 'Serverbox hinzufügen',
	'SHOWADDSERVERBOX__INFO' => 'Serverboxen sind die Mailboxen auf dem Server. Mails in dieser Serverbox werden in die korrespondierende Mailbox in diesem System geladen.',
	'SHOWADDSERVERBOX__SUBMIT' => 'Serverbox hinzufügen',
	'SHOWADDSERVERBOX__RESET' => 'Reset',
	'SHOWADDSERVERBOX__TOOVERVIEW' => '{$$$COMMON__BACKTOOVERVIEW}',
	'SHOWADDSERVERBOX__INVALIDINPUT' => 'Ungültige Daten. Bitte versuche es erneut!',

	// showEditServerbox
	'SHOWEDITSERVERBOX__H1' => 'Serverbox bearbeiten',
	'SHOWEDITSERVERBOX__INFO' => 'Über dieses Formular kannst du die Daten der Serverbox ändern.',
	'SHOWEDITSERVERBOX__SUBMIT' => 'Änderungen speichern',
	'SHOWEDITSERVERBOX__RESET' => 'Reset',
	'SHOWEDITSERVERBOX__TOOVERVIEW' => '{$$$COMMON__BACKTOOVERVIEW}',

	// showServerboxes
	'SHOWSERVERBOXES__H1' => 'Serverbox des Server "#servername#"',
	'SHOWSERVERBOXES__INFO' => 'Dies sind die Serverboxen, die für diesen Server registriert sind. Diese Serverboxen werden auf neue Mails überprüft und diese ggf. in die lokale Mailbox heruntergeladen.',
	'SHOWSERVERBOXES__NAME' => 'Name der Serverbox',
	'SHOWSERVERBOXES__TOMAILBOX' => 'Lokale Mailbox',
	'SHOWSERVERBOXES__EDIT' => '{$$$COMMON__EDIT}',
	'SHOWSERVERBOXES__DELETE' => '{$$$COMMON__DELETE}',
	'SHOWSERVERBOXES__NOSERVERBOXES' => 'Diesem Server wurde noch keine Serverbox hinzugefügt.',
	'SHOWSERVERBOXES__ADDSERVERBOX' => 'Serverbox hinzufügen',

	// formServerbox
	'FORMSERVERBOX__LEGEND' => 'Daten der Serverbox',
	'FORMSERVERBOX__NAME' => 'Name der Serverbox',
	'FORMSERVERBOX__SELECTMAILBOX' => 'Lokale Mailbox',
	'FORMSERVERBOX__SELECTMAILBOX_CREATENEW' => 'Neue Mailbox erstellen',
	'FORMSERVERBOX__TOBOX_CREATENEW' => 'Name der neuen Mailbox',
	'FORMSERVERBOX__PRESET_NAME' => 'Name der Serverbox',
	'FORMSERVERBOX__HELP_NAME' => 'Name der Serverbox, also der Name der Mailbox auf dem externen Mailserver, von dem du E-Mails herunterladen willst (z.B. "INBOX")',
	'FORMSERVERBOX__HELP_SELECTMAILBOX' => 'Wähle eine lokale Mailbox aus, in die neue Mails geladen werden sollen.',
	'FORMSERVERBOX__PRESET_NEWMAILBOX' => 'Name der neuen Mailbox',
	'FORMSERVERBOX__HELP_NEWMAILBOX' => 'Füge einen Name für die neue, lokale Mailbox ein.',

	// editServerbox
	'EDITSERVERBOX__INVALIDINPUT' => 'Ungültige Eingaben!',
	'EDITSERVERBOX__ERROROCCURRED' => 'Ein Fehler ist aufgetreten!',
	'EDITSERVERBOX__SUCCESS' => 'Die Änderungen wurden erfolgreich gespeichert.',

	// addServerbox
	'ADDSERVERBOX__INVALIDINPUT' => 'Ungültige Eingaben!',
	'ADDSERVERBOX__ERROROCCURRED' => 'Ein Fehler ist aufgetreten!',
	'ADDSERVERBOX__SUCCESS' => 'Serverbox wurde erfolgreich hinzugefügt',

	// showDeleteServerbox
	'SHOWDELETESERVERBOX__POPUP_DELETE_HEADER' => 'Serverbox #name# löschen?',
	'SHOWDELETESERVERBOX__POPUP_DELETE_CONTENT' => 'Willst du die Serverbox wirklich vom System entfernen?',
	'SHOWDELETESERVERBOX__POPUP_DELETE_YES' => 'Ja, entfernen.',
	'SHOWDELETESERVERBOX__POPUP_DELETE_NO' => 'Nein, abbrechen.',

	// deleteServerbox
	'DELETESERVERBOX__ERROR' => 'Ein Fehler ist aufgetreten. Bitte versuche es erneut!',
	'DELETESERVERBOX__SUCCESS' => 'Serverbox wurde erfolgreich gelöscht.',
	'SHOWEDITSERVERBOX__TODELETESERVERBOX' => 'Diese Serverbox löschen',

	/* ***************** smtps ********************************* */

	// showListSmtps
	'SHOWLISTSMTPS__EMAILNAME' => 'Absender',
	'SHOWLISTSMTPS__AUTH' => 'Sicherheit',
	'SHOWLISTSMTPS__EDIT' => 'Smtp-Server bearbeiten',
	'SHOWLISTSMTPS__DELETE' => 'Smtp-Server löschen',
	'SHOWLISTSMTPS__NOSMTPS' => 'Bislang sind noch keine Smtp-Server hinzugefügt worden.',
	'SHOWLISTSMTPS__DESCRIPTION' => 'Beschreibung',

	// showAddSmtp
	'SHOWADDSMTP__H1' => 'Smtp-Server hinzufügen',
	'SHOWADDSMTP__INFO' => 'Füge dieses Formular aus, um einen neuen Smtp-Server hinzuzufügen.',
	'SHOWADDSMTP__SUBMIT' => 'Smtp-Server hinzufügen',
	'SHOWADDSMTP__RESET' => '{$$$COMMON__RESET}',
	'SHOWADDSMTP__OVERVIEW' => '{$$$COMMON__TOBACK}',

	// addSmtp
	'ADDSMTP__SUCCESS' => 'Smtp-Server wurde erfolgreich hinzugefügt.',
	'ADDSMTP__ERROR' => 'Ein Fehler ist aufgetreten. Bitte versuche es erneut!',
	'ADDSMTP__INVALIDINPUT' => 'Ungültige Daten. Bitte überprüfe deine Eingaben!',
	'ADDSMTP__CONNERROR' => 'Verbindung konnte nicht hergestellt werden. Bitte gebe die Verbindungdaten selber ein und versuche es erneut.',

	// showEditSmtp
	'SHOWEDITSMTP__H1' => 'Smtp-Server bearbeiten',
	'SHOWEDITSMTP__INFO' => 'Über dieses Formular kannst du die Daten des Smtp-Servers ändern.',
	'SHOWEDITSMTP__SUBMIT' => 'Änderungen speichern',
	'SHOWEDITSMTP__RESET' => '{$$$COMMON__RESET}',
	'SHOWEDITSMTP__TOOVERVIEW' => '{$$$COMMON__TOBACK}',

	// editSmtp
	'EDITSMTP__SUCCESS' => 'Änderungen wurden gespeichert.',
	'EDITSMTP__ERROR' => 'Ein Fehler ist aufgetreten. Bitte versuche es erneut!',
	'EDITSMTP__INVALIDINPUT' => 'Ungültige Daten. Bitte überprüfe deine Eingaben!',
	'EDITSMTP__CONNERROR' => 'Verbindung konnte nicht hergestellt werden. Bitte gebe die Verbindungdaten manuell ein und versuche es erneut!',

	// formSmtp
	'FORMSMTP__LEGEND_SMTPACCOUNT' => 'SMTP-Daten',
	'FORMSMTP__MAILACCOUNT' => 'Mailaccount',
	'FORMSMTP__MAILACCOUNT_NOACCOUNT' => 'Mit keinem Account verbunden',
	'FORMSMTP__HELP_MAILACCOUNT' => 'Wähle einen Mailaccount, mit dem dieser SMTP-Server verbunden sein soll. Du kannst diesen SMTP-Server auch ohne eine solche Verbindung verwenden.',
	'FORMSMTP__EMAIL' => 'E-Mail',
	'FORMSMTP__PRESET_EMAIL' => 'E-Mail-Adresse',
	'FORMSMTP__HELP_EMAIL' => 'Deine E-Mail-Adresse.',
	'FORMSMTP__PASSWORD' => 'Passwort',
	'FORMSMTP__HELP_PASSWORD' => 'Das Passwort für diesen SMTP-Server.',
	'FORMACCOUNT__LEGEND_OPTIONALDATA' => 'Optionale SMTP-Daten',
	'FORMSMTP__EMAILNAME' => 'Dein Name',
	'FORMSMTP__PRESET_EMAILNAME' => 'Dein angezeigter Name',
	'FORMSMTP__HELP_EMAILNAME' => 'Dieser Name wird als Absender angezeigt werden (optional)',
	'FORMSMTP__DESCRIPTION' => 'Beschreibung',
	'FORMSMTP__PRESET_DESCRIPTION' => 'Eine kurze Beschreibung...',
	'FORMSMTP__HELP_DESCRIPTION' => 'Hier kannst du eine kurze Beschreibung einfügen. (optional)',
	'FORMSMTP__LEGEND_CONNECTION' => 'Verbindungseinstellungen',
	'FORMSMTP__HOST' => 'Host',
	'FORMSMTP__PRESET_HOST' => 'SMTP-Host',
	'FORMSMTP__HELP_HOST' => 'Gebe hier den Host des SMTP-Servers ein (etwas ähnlich zu "mail.abc.yz")',
	'FORMSMTP__PORT' => 'Port',
	'FORMSMTP__PRESET_PORT' => 'Verbindungsport',
	'FORMSMTP__HELP_PORT' => 'Verbindungsport, um sich zum SMTP-Server zu verbinden.',
	'FORMSMTP__USER' => 'Benutzer',
	'FORMSMTP__PRESET_USER' => 'SMTP-Benutzer',
	'FORMSMTP__HELP_USER' => 'Benutzer des SMTP-Servers',
	'FORMSMTP__CONNSECURITY' => 'Verbindungssicherheit',
	'FORMSMTP__CONNSECURITY_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
	'FORMSMTP__HELP_CONNSECURITY' => 'Wähle eine Verbindungssicherheit',
	'FORMSMTP__AUTH' => 'Passwort-Sicherheit',
	'FORMSMTP__AUTH_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
	'FORMSMTP__HELP_AUTH' => 'Wähle ein Level für die Passwortsicherheit.',

	// showDeleteSmtp
	'SHOWDELETESMTP__POPUP_DELETE_HEADER' => 'Smtp-Server #name# löschen?',
	'SHOWDELETESMTP__POPUP_DELETE_HEADER_JS' => 'Diesen Smtp-Server löschen?',
	'SHOWDELETESMTP__POPUP_DELETE_CONTENT' => 'Willst du diesen Smtp-Server wirklich von diesem System löschen?',
	'SHOWDELETESMTP__POPUP_DELETE_YES' => 'Ja, löschen.',
	'SHOWDELETESMTP__POPUP_DELETE_NO' => 'Nein, abbrechen',

	// deleteSmtp
	'DELETESMTP__ERROR' => 'Ein Fehler ist aufgetreten. Bitte versuche es erneut!',
	'DELETESMTP__SUCCESS' => 'Smtp-Server wurde erfolgreich gelöscht.',

	/* ***************** mail ********************************** */

	/* showMail */
	'SHOWMAIL__H1' => 'Deine Mail',
	'SHOWMAIL__DELTEMAIL' => 'Mail löschen',
	'SHOWMAIL__ANSWERMAIL' => 'Antwort schreiben',
	'SHOWMAIL__TOSHOWMAILBOX' => 'Zurück zur Mailbox',
	'SHOWMAIL__ATTACHMENTS' => 'Anhänge',
	'SHOWMAIL__NOIFRAMESUPPORT' => 'Dein Browser unterstützt leider keine iframes, so dass die E-Mail hier nicht eingefügt werden konnte...',
	'SHOWMAIL__NOIFRAMESUPPORT_OPENMAIL' => 'Mail in neuem Fenster öffnen',
	'SHOWMAIL__SENDER' => 'Absender',
	'SHOWMAIL__ADDRESSEE' => 'Empfänger',
	'SHOWMAIL__DATEOFMAIL' => 'Datum',

	/* showDeleteMail */
	'SHOWDELETEMAIL__POPUP_DELETE_HEADER' => 'Lösche die Mail "#name#"?',
	'SHOWDELETEMAIL__POPUP_DELETE_HEADER_JS' => 'Diese Mail löschen?',
	'SHOWDELETEMAIL__POPUP_DELETE_CONTENT' => 'Willst du dieser Mail wirklich löschen?',
	'SHOWDELETEMAIL__POPUP_DELETE_YES' => 'Ja, löschen',
	'SHOWDELETEMAIL__POPUP_DELETE_NO' => 'Nein, abbrechen',

	/* deleteMail */
	'DELETEMAIL__ERROR' => 'Die Mail konnte nicht versendet werden.',
	'DELETEMAIL__SUCCESS' => 'Die Mail wurde erfolgreich gelöscht.',

	// showSendMail
	'SHOWSENDMAIL__H1' => 'Mail senden',
	'SHOWSENDMAIL__INFO' => 'Fülle dieses Formular aus, um eine Mail zu senden.',
	'SHOWSENDMAIL__TOSHOWMAILBOXES' => 'Abbrechen und zeige alle Mailboxen',
	'SHOWSENDMAIL__LEGEND_HEADER' => 'Header der Mail',
	'SHOWSENDMAIL__LEGEND_CONTENT' => 'Inhalt der mail',
	'SHOWSENDMAIL__SUBMIT' => 'Mail absenden',
	'SHOWSENDMAIL__RESET' => 'Reset',
	'SHOWSENDMAIL__SENDER' => 'Sender',
	'SHOWSENDMAIL__LOCALSENDER' => 'Lokaler Sender',
	'SHOWSENDMAIL__ADDRESSEE' => 'Empfänger',
	'SHOWSENDMAIL__SENDER_HELP' => 'Wähle einen Sender für diese Mail',
	'SHOWSENDMAIL__ADDRESSEE_PRESET' => 'Empfänger dieser Mail',
	'SHOWSENDMAIL__ADDRESSEE_HELP' => 'E-Mailadresse der Empfänger (mit Semikolons getrennt)',
	'SHOWSENDMAIL__SUBJECT' => 'Betreff',
	'SHOWSENDMAIL__SUBJECT_PRESET' => 'Betreff dieser Mail',
	'SHOWSENDMAIL__SUBJECT_HELP' => 'Füge einen Betreff für diese Mail ein.',
	'SHOWSENDMAIL__CONTENT' => 'Nachricht',
	'SHOWSENDMAIL__CONTENT_PRESET' => 'Inhalt der Mail',
	'SHOWSENDMAIL__CONTENT_HELP' => 'Die Nachricht dieser Mail.',
	'SHOWSENDMAIL__ADDSMTPFIRST' => 'Bitte füge zuerst einen SMTP-Server hinzu, über den E-Mails versendet werden können!',

	/* sendMail */
	'SENDMAIL__INVALIDINPUT' => 'Bitte fülle alle erforderlichen Felder aus!',
	'SENDMAIL__SUCCESS' => 'Die Mail wurde erfolgreich versendet.',
	'SENDMAIL__INVALIDADDRESSEE' => 'Mindestens ein Adressat war ungültig!',
	'SENDMAIL__ERROR' => 'Ein Fehler ist aufgetreten. Die E-Mail konnte nicht gesendet werden.',

	/* ***************** _system_navigation ********************************* */

	'_NAVIGATION__SHOWMAILBOXES' => 'Deine Mailboxen',
	'_NAVIGATION__SHOWSENDMAIL' => 'Mail senden',
	'_NAVIGATION__SHOWMAILSETTINGS' => 'Maileinstellungen',
	'_NAVIGATION__SHOWMAILSERVERS' => 'Mailserver',
	'_NAVIGATION_HEADER' => 'Mail'
);
?>
