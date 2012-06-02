<!-- | LANGUAGE german -->
<?php
$lang = array(
    'NAME' => 'Mail Modul',

    // classes
    'CLASS__SENDERLOCAL__HOST' => 'Localhost',
    'CLASS__SENDERLOCAL__USER' => 'Lokaler Benutzer',
    'CLASS__SENDERLOCAL__NAME' => 'Lokaler SMTP-Server',

    'CLASS__SERVERBOX__ADDATTACHMENTERROR' => 'Anhang konnte nicht heruntergeladen werden!',

    'CLASS__MAILACCOUNT__AUTHS_NORMAL' => 'Normal',
    'CLASS__MAILACCOUNT__AUTHS_ENCRYPTEDPWD' => 'Verschlüsseltes Passwort',
    'CLASS__MAILACCOUNT__AUTHS_NTLM' => 'NTLM',
    'CLASS__MAILACCOUNT__AUTHS_KERBEROS_GSSAPI' => 'Kerberos/GSSAPI',
    'CLASS__MAILACCOUNT__PROTOCOLS_IMAP' => 'IMAP',
    'CLASS__MAILACCOUNT__PROTOCOLS_POP3' => 'POP3',
    'CLASS__MAILACCOUNT__CONNSECURITIES_NONE' => 'None',
    'CLASS__MAILACCOUNT__CONNSECURITIES_STARTTLS' => 'STARTTLS',
    'CLASS__MAILACCOUNT__CONNSECURITIES_SSLTLS' => 'SLL/TLS',
    'CLASS__MAILACCOUNT__CONNSECURITIES_SSLTLSNOVAL' => 'SSL/TLS (invalid certificate)',
    'CLASS__MAILACCOUNT__NOCONNECTION' => 'Serververbindung konnte nicht eingerichet werden!',

    'CLASS__SMTP__AUTHS_NORMAL' => 'Normal',
    'CLASS__SMTP__AUTHS_ENCRYPTEDPWD' => 'Verschlüsseltes Passwort',
    'CLASS__SMTP__AUTHS_NTLM' => 'NTLM',
    'CLASS__SMTP__AUTHS_KERBEROS_GSSAPI' => 'Kerberos/GSSAPI',
    'CLASS__SMTP__AUTHS_NOAUTH' => 'Keine Authentifizierung',
    'CLASS__SMTP__CONNSECURITIES_NONE' => 'Kein',
    'CLASS__SMTP__CONNSECURITIES_STARTTLS' => 'STARTTLS',
    'CLASS__SMTP__CONNSECURITIES_SSLTLS' => 'SLL/TLS',

    // general
    'INBOX__NAME' => 'Posteingang',
    'INBOX__DESCRIPTION' => 'Standard Posteingang des Benutzers (nicht veränderbar)',

    // common
    'COMMON__BACKTOOVERVIEW' => 'Zurück zur Übersicht',
    'COMMON__RESET' => 'Reset',
    'COMMON__DELETE' => 'Löschen',
    'COMMON__EDIT' => 'Bearbeiten',
    'COMMON_MISSINGINPUT' => 'Fehlende Eingaben! Bitte fülle alle notwendigen Felder aus!',
    'COMMON__INVALIDINPUT' => '{$$$COMMON_MISSINGINPUT}',
    'COMMON__TOBACK' => 'Zurück',
    'COMMON__ERROR' => 'Es ist ein Fehler aufgetreten. Bitte versuche es erneut!',
    'COMMON__CHOOSEPLEASE' => '--Bitte wählen--',

    // showMain
    'SHOWMAIN__TITLE' => 'Deine Mails',
    'SHOWMAIN__H1' => 'Deine Mails',
    'SHOWMAIN__INFO' => 'Dies ist deine Mail-Verwaltung. Um Mails von deinen E-Mail-Postfächern zu empfangen, füge bitte deinen Mailaccount in der Rubrik "Mailserver" hinzu. Um E-Mails über SMTP zu versenden, füge bitte an gleicher Stelle einen SMTP-Server hinzu.',

    /* ***************** mailbox ******************************* */

    // updateMailbox
    'UPDATEMAILBOX__SUCCESS' => 'Mailbox aktualisiert.',

    // showMailboxes
    'SHOWMAILBOXES__TITLE' => 'Deine Mailboxen',
    'SHOWMAILBOXES__YOURMAILBOXES' => 'Deine Mailboxen',
    'SHOWMAILBOXES__TOCREATENEWMAILBOX' => 'Erstelle neue Mailbox',
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

    // showMailbox
    'SHOWMAILBOX__TITLE' => 'Mailbox anzeigen',
    'SHOWMAILBOX__H1' => 'Mailbox | #name#',
    'SHOWMAILBOX__NUMBEROFMAILS' => 'Mailanzahl:',
    'SHOWMAILBOX__FROMADDRESS' => 'Von',
    'SHOWMAILBOX__SUBJECT' => 'Betreff',
    'SHOWMAILBOX__NOMAILINBOX' => 'In dieser Mailbox sind keine Mails...',
    'SHOWMAILBOX__TOSHOWMAILBOXES' => 'Zurück zu allen Mailboxen',
    'SHOWMAILBOX__TOSHOWWRITEMAIL' => 'Mail schreiben',
    'SHOWMAILBOX__JS_UPDATER' => 'Suche neue Mails...',
    'SHOWMAILBOX__OPTIONMAILBOX_NEWMAILS_HEADER' => 'Neue Mails',
    'SHOWMAILBOX__OPTIONMAILBOX_NEWMAILS_CONTENT' => 'Es wurden neue Mails heruntergeladen. Bitte aktualisiere diese Seite, um die neuen Mails angezeigt zu bekommen.',
    'SHOWMAILBOX__OPTIONMAILBOX_NEWMAILS_YES' => 'Aktualisieren',
    'SHOWMAILBOX__OPTIONMAILBOX_NEWMAILS_NO' => 'Abbrechen',
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

    // showAddMailbox
    'SHOWADDMAILBOX__TITLE' => 'Mailbox erstellen',
    'SHOWADDMAILBOX__H1' => 'Mailbox erstellen',
    'SHOWADDMAILBOX__INFO' => 'Bitte fülle das Formular aus, um eine neue lokale Mailbox zu erstellen.',
    'SHOWADDMAILBOX__TOSHOWMAILBOXES' => 'Zurück zu allen Mailboxen',
    'SHOWADDMAILBOX__SUBMIT' => 'Mailbox erstellen',
    'SHOWADDMAILBOX__RESET' => 'Reset',

    // addMailbox
    'ADDMAILBOX__SUCCESS' => 'Die neue Mailbox wurde erfolgreich erstellt',
    'ADDMAILBOX__INVALIDINPUT' => 'Bitte fülle alle erforderlichen Felder aus!',

    // showEditMailbox
    'SHOWEDITMAILBOX__TITLE' => 'Mailbox bearbeiten',
    'SHOWEDITMAILBOX__H1' => 'Mailbox "#0#" bearbeiten',
    'SHOWEDITMAILBOX__INFO' => 'Über dieses Formular kannst du die Daten der Mailbox bearbeiten.',
    'SHOWEDITAILMAILBOX__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITMAILBOX__RESET' => 'Reset',
    'SHOWEDITMAILBOX__TOSHOWMAILBOXES' => 'Zurück zu allen Mailboxen',

    // editMailbox
    'EDITMAILBOX__SUCCESS' => 'Die Änderungen wurden erfolgreich gespeichert.',
    'EDITMAILBOX__INVALIDINPUT' => 'Bitte fülle alle erforderlichen Felder korrekt aus!',

    // formMailbox
    'FORMMAILBOX__LEGEND' => 'Deine lokale Mailbox',
    'FORMMAILBOX__NAME' => 'Name',
    'FORMMAILBOX__PRESET_NAME' => 'Name deiner lokalen Mailbox',
    'FORMMAILBOX__HELP_NAME' => 'Gebe einen beliebigen Namen für deine lokale Mailbox ein',
    'FORMMAILBOX__DESCRIPTION' => 'Beschreibung',
    'FORMMAILBOX__PRESET_DESCRIPTION' => 'Eine Beschreibung der Mailbox',
    'FORMMAILBOX__HELP_DESCRIPTION' => 'Gebe eine Beschreibung der Mailbox ein (optional).',
    'FORMMAILBOX_ERROR_INVALIDINPUT' => 'Bitte fülle alle erforderlichen Felder korrekt aus!',

    // showDeleteMailbox
    'SHOWDELETEMAILBOX__TITLE' => 'Mailbox löschen',
    'SHOWDELETEMAILBOX__POPUP_DELETE_HEADER' => 'Mailbox "#name#" löschen?',
    'SHOWDELETEMAILBOX__POPUP_DELETE_HEADER_JS' => 'Mailbox löschen?',
    'SHOWDELETEMAILBOX__POPUP_DELETE_CONTENT' => 'Willst du diese Mailbox wirklich löschen?',
    'SHOWDELETEMAILBOX__POPUP_DELETE_YES' => 'Ja, löschen.',
    'SHOWDELETEMAILBOX__POPUP_DELETE_NO' => 'Nein, abbrechen.',

    // deleteMailbox
    'DELETEMAILBOX__SUCCESS' => 'Die Mailbox wurde erfolgreich gelöscht',
    'DELETEMAILBOX__ERROR' => 'Die Mailbox konnte nicht gelöscht werden.',

    /* ********************** mailservers *********************************** */

    // showMailservers
    'SHOWMAILSERVERS__TITLE' => 'Deine Mailserver',
    'SHOWMAILSERVERS__H1' => 'Deine Mailserver',
    'SHOWMAILSERVERS__INFOTEXT' => 'Dies ist eine Liste deiner Mailaccounts und SMTP-Server, die du zu deinem Mailaccount auf diesem System hinzugefügt hast.',
    'SHOWMAILSERVERS__MAILACCOUNTS_H1' => 'Deine Mailaccounts',
    'SHOWMAILSERVERS__MAILACCOUNTS_INFO' => 'Hier sind alle Mailaccounts aufgelistet, die du mit diesem System verbunden hast. Du kannst einen weiteren hinzufügen, ihre Einstellungen ändern oder welche von diesem System wieder entfernen. Mithilfe von Mailaccounts kannst du über IMAP/POP3 E-Mails von deinen E-Mail-Mailaccounts empfangen, über SMTP-Server kannst du E-Mails versenden.',
    'SHOWMAILSERVERS__MAILACCOUNTS_ADD' => 'Mailaccount hinzufügen',
    'SHOWMAILSERVERS__SMTPS_H1' => 'Deine SMTP-Server',
    'SHOWMAILSERVERS__SMTPS_INFO' => 'Dies ist eine Liste aller SMTP-Server, die du mit diesem System verbunden hast. Von diesen SMTP-Servern aus kannst du E-Mails versenden.',
    'SHOWMAILSERVERS__SMTPS_ADD' => 'SMTP-Server hinzufügen',

    /* ************************* mailaccount ******************************** */

    // showMailaccount
    'SHOWMAILACCOUNT__TITLE' => 'Mailaccount',
    'SHOWMAILACCOUNT__H1' => 'Mailaccount "#name#"',
    'SHOWMAILACCOUNT__TOEDITMAILACCOUNT' => 'Bearbeiten',
    'SHOWMAILACCOUNT__TODELETEMAILACCOUNT' => 'Löschen',
    'SHOWMAILACCOUNT__INFOTEXT' => 'Mailaccounts ermöglichen dir, E-Mails über IMAP/POP3 von deinen E-Mail-Mailaccounts zu empfangen.',
    'SHOWMAILACCOUNT__NAME' => 'Name',
    'SHOWMAILACCOUNT__DESCRIPTION' => 'Beschreibung',
    'SHOWMAILACCOUNT__EMAIL' => 'E-Mail',
    'SHOWMAILACCOUNT__DATEOFCREATION' => 'Erstellungsdatum',
    'SHOWMAILACCOUNT__SERVERBOXES_H1' => 'Serverboxen des Mailaccounts',
    'SHOWMAILACCOUNT__SERVERBOXES_INFO' => 'Serverboxen sind die Mailboxen deines externen E-Mailaccounts. Aktiviere eine Serverbox, um E-Mails aus dieser Box in eine lokale Mailbox zu laden.',
    'SHOWMAILACCOUNT__SERVERBOXES_ADD' => 'Manuell eine weitere Serverbox hinzufügen',
    'SHOWMAILACCOUNT__SERVERBOXES_SUBMIT' => 'Serverboxen de-/aktivieren',
    'SHOWMAILACCOUNT__SERVERBOXES_REFRESH' => 'Serverbox-Liste aktualisieren',
    'SHOWMAILACCOUNT__SMTPS_H1' => 'SMTP-Server des Mailaccounts',
    'SHOWMAILACCOUNT__SMTPS_INFO' => 'Diese Liste zeigt dir alle SMTP-Server, die zu diesem Mailaccount hinzugefügt sind.',
    'SHOWMAILACCOUNT__SMTPS_ADD' => 'Add SMTP-server',

    // refresh serverboxes
    'REFRESHSERVERBOXES__SUCCESS' => 'Die Serverbox-Liste wurde aktualisiert.',
    'REFRESHSERVERBOXES__ERROR' => 'Beim Aktualisieren der Serverbox-Liste ist ein Fehler aufgetreten!',

    // showListMailaccounts
    'SHOWLISTMAILACCOUNTS__NAME' => 'Name',
    'SHOWLISTMAILACCOUNTS__DESCRIPTION' => 'Beschreibung',
    'SHOWLISTMAILACCOUNTS__EMAIL' => 'E-Mail',
    'SHOWLISTMAILACCOUNTS__NOMAILACCOUNTS' => 'Es wurden noch keine Mailaccounts hinzugefügt.',

    // showEditMailaccount
    'SHOWEDITMAILACCOUNT__H1' => 'Mailaccount bearbeiten',
    'SHOWEDITMAILACCOUNT__INFO' => 'Über dieses Formular kannst du den Mailaccount bearbeiten.',
    'SHOWEDITMAILACCOUNT__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITMAILACCOUNT__RESET' => '{$$$COMMON__RESET}',
    'SHOWEDITMAILACCOUNT__TITLE' => 'Mailaccount bearbeiten',
    'SHOWEDITMAILACCOUNT__TOBACK' => '{$$$COMMON__BACKTOOVERVIEW}',

    // editMailaccount
    'EDITMAILACCOUNT__INVALIDINPUT' => '{$$$COMMON__INVALIDINPUT}',
    'EDITMAILACCOUNT__ERROR' => '{$$$COMMON__ERROR}',
    'EDITMAILACCOUNT__SUCCESS' => 'Die Änderungen wurden erfolgreich gespeichert.',
    'EDITMAILACCOUNT__CONNERROR' => 'Verbindung zum Server konnte nicht hergestellt werden. Hast du das richtige Passwort angegeben? Ansonsten fülle bitte die Verbindungsdaten manuell aus und versuche es erneut!',

    // showAddMailaccount
    'SHOWADDMAILACCOUNT__TITLE' => 'Mailaccount hinzufügen',
    'SHOWADDMAILACCOUNT__H1' => 'Mailaccount hinzufügen',
    'SHOWADDMAILACCOUNT__INFO' => 'Mit diesem Formular kannst du einen Mailaccount zu diesem System hinzufügen. Das System wird versuchen, die richtigen Servereinstellungen selber zu finden, wenn die entsprechenden Felder freigelassen werden.',
    'SHOWADDMAILACCOUNT__SUBMIT' => 'Mailaccount hinzufügen',
    'SHOWADDMAILACCOUNT__RESET' => '{$$$COMMON__RESET}',
    'SHOWADDMAILACCOUNT__TOBACK' => '{$$$COMMON__BACKTOOVERVIEW}',

    // addMailaccount
    'ADDMAILACCOUNT__INVALIDINPUT' => '{$$$COMMON__INVALIDINPUT}',
    'ADDMAILACCOUNT__ERROR' => 'Ein Fehler ist aufgetreten. Bitte versuche es erneut!',
    'ADDMAILACCOUNT__SUCCESS' => 'Der Mailaccount wurde erfolgreich hinzugefügt.',
    'ADDMAILACCOUNT__CONNERROR' => 'Verbindung zum Server konnte nicht hergestellt werden. Hast du das richtige Passwort angegeben? Ansonsten fülle bitte die Verbindungsdaten manuell aus und versuche es erneut!',

    // formMailaccount
    'FORMMAILACCOUNT__LEGEND_EMAILMAILACCOUNT' => 'Daten des Mailaccounts',
    'FORMMAILACCOUNT__NAME' => 'Name',
    'FORMMAILACCOUNT__PRESET_NAME' => 'Optionaler Name',
    'FORMMAILACCOUNT__HELP_NAME' => 'Gebe dem Mailaccount einen optionalen Namen.',
    'FORMMAILACCOUNT__DESCRIPTION' => 'Beschreibung',
    'FORMMAILACCOUNT__PRESET_DESCRIPTION' => 'Kurze Beschreibung',
    'FORMMAILACCOUNT__HELP_DESCRIPTION' => 'Hier kannst du eine kurze Beschreibung des Mailaccount einfügen.',
    'FORMMAILACCOUNT__EMAIL' => 'E-Mail-Adresse',
    'FORMMAILACCOUNT__PRESET_EMAIL' => 'E-Mailadresse des Mailaccounts',
    'FORMMAILACCOUNT__HELP_EMAIL' => 'Gebe hier die E-Mailadresse des Mailaccounts an.',
    'FORMMAILACCOUNT__PASSWORD' => 'Passwort',
    'FORMMAILACCOUNT__HELP_PASSWORD' => 'Passwort des Mailaccounts.',
    'FORMMAILACCOUNT__LEGEND_LOGINDATA' => 'Deine Login-Daten des Mailaccounts',
    'FORMMAILACCOUNT__LEGEND_CONNECTION' => 'Verbindungsdaten',
    'FORMMAILACCOUNT__HOST' => 'Host',
    'FORMMAILACCOUNT__PRESET_HOST' => 'Hostserver',
    'FORMMAILACCOUNT__HELP_HOST' => 'Du kannst den Hostserver bei deinem E-Mailanbieter erfragen (sollte etwas so aussehen wie "mail.abc.yz")',
    'FORMMAILACCOUNT__PORT' => 'Port',
    'FORMMAILACCOUNT__PRESET_PORT' => 'Verbindungsport',
    'FORMMAILACCOUNT__HELP_PORT' => 'Die Portnummer, über die der Mailserver erreichbar ist. Diese Information kann ebenfalls beim Anbieter eingeholt werden.',
    'FORMMAILACCOUNT__USER' => 'Benutzer',
    'FORMMAILACCOUNT__PRESET_USER' => 'Benutzername für diesen Mailaccount',
    'FORMMAILACCOUNT__HELP_USER' => 'Benutzername für diesen Mailaccount',

    'FORMMAILACCOUNT__PROTOCOL' => 'Protokoll',
    'FORMMAILACCOUNT__PROTOCOL_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
    'FORMMAILACCOUNT__HELP_PROTOCOL' => 'Wähle eine Protokoll für die Verbindung zum Server.',
    'FORMMAILACCOUNT__AUTH' => 'Passwort-Sicherheit',
    'FORMMAILACCOUNT__AUTH_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
    'FORMMAILACCOUNT__HELP_AUTH' => 'Wähle ein Sicherheitslevel für das Passwort.',
    'FORMMAILACCOUNT__CONNSECURITY' => 'Verbindungssicherheit',
    'FORMMAILACCOUNT__CONNSECURITY_CHOOSE' => '{$$$COMMON__CHOOSEPLEASE}',
    'FORMMAILACCOUNT__HELP_CONNSECURITY' => 'Wähle ein Level für die Verbindungssicherheit.',
    'FORMMAILACCOUNT__SUBINFO' => 'Das Laden der nächsten Seite kann etwas dauern, da versucht wird, eine Verbindung zum Mailserver herzustellen.',

    // showDeleteMailaccount
    'SHOWDELETEMAILACCOUNT__TITLE' => 'Mailaccount löschen',
    'SHOWDELETEMAILACCOUNT__POPUP_DELETE_HEADER_JS' => 'Mailaccount löschen?',
    'SHOWDELETEMAILACCOUNT__POPUP_DELETE_HEADER' => 'Mailaccount "#name#" löschen?',
    'SHOWDELETEMAILACCOUNT__POPUP_DELETE_CONTENT' => 'Willst du den Mailaccount wirklich löschen? Du wirst dann keine E-Mails mehr von diesem Mailaccount empfangen.',
    'SHOWDELETEMAILACCOUNT__POPUP_DELETE_YES' => 'Ja, löschen.',
    'SHOWDELETEMAILACCOUNT__POPUP_DELETE_NO' => 'Nein, abbrechen.',

    // deleteMailaccount
    'DELETEMAILACCOUNT__ERROR' => '{$$$COMMON__ERROR}',
    'DELETEMAILACCOUNT__SUCCESS' => 'Der Mailaccount wurde erfolgreich von System entfernt.',

    /* ***************** serverbox ***************************** */

    // showListServerboxes
    'SHOWLISTSERVERBOXES__EDIT' => '{$$$COMMON__EDIT}',
    'SHOWLISTSERVERBOXES__DELETE' => '{$$$COMMON__DELETE}',
    'SHOWLISTSERVERBOXES__NOSERVER' => 'Keine Serverboxen in dieser Liste.',
    'SHOWLISTSERVERBOXES__NAME' => 'Name',
    'SHOWLISTSERVERBOXES__FKMAILBOX' => 'Neue E-Mails verschieben nach...',
    'SHOWLISTSERVERBOXES__SERVERBOXES' => 'Serverboxen',

    // activateServerboxes
    'ACTIVATESERVERBOXES__SUCCESS' => 'Änderungen wurden gespeichert.',

    // showAddServerbox
    'SHOWADDSERVERBOX__TITLE' => 'Serverbox hinzufügen',
    'SHOWADDSERVERBOX__H1' => 'Serverbox hinzufügen',
    'SHOWADDSERVERBOX__INFO' => 'Serverboxen sind die Mailboxen auf dem Server. Mails in dieser Serverbox werden in die korrespondierende Mailbox in diesem System geladen.',
    'SHOWADDSERVERBOX__SUBMIT' => 'Serverbox hinzufügen',
    'SHOWADDSERVERBOX__RESET' => 'Reset',
    'SHOWADDSERVERBOX__TOOVERVIEW' => '{$$$COMMON__BACKTOOVERVIEW}',
    'SHOWADDSERVERBOX__INVALIDINPUT' => 'Ungültige Daten. Bitte versuche es erneut!',

    // showEditServerbox
    'SHOWEDITSERVERBOX__TITLE' => 'Serverbox bearbeiten',
    'SHOWEDITSERVERBOX__H1' => 'Serverbox bearbeiten',
    'SHOWEDITSERVERBOX__INFO' => 'Über dieses Formular kannst du die Daten der Serverbox ändern.',
    'SHOWEDITSERVERBOX__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITSERVERBOX__RESET' => 'Reset',
    'SHOWEDITSERVERBOX__TOOVERVIEW' => '{$$$COMMON__BACKTOOVERVIEW}',

    // formServerbox
    'FORMSERVERBOX__LEGEND' => 'Daten der Serverbox',
    'FORMSERVERBOX__NAME' => 'Name der Serverbox',
    'FORMSERVERBOX__SELECTMAILBOX' => 'Lokale Mailbox',
    'FORMSERVERBOX__SELECTMAILBOX_CREATENEW' => 'Neue Mailbox erstellen',
    'FORMSERVERBOX__TOMAILBOX_CREATENEW' => 'Name der neuen Mailbox',
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
    'SHOWDELETESERVERBOX__TITLE' => 'Serverbox löschen',
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
    'SHOWADDSMTP__TITLE' => 'SMTP-Server hinzufügen',
    'SHOWADDSMTP__H1' => 'SMTP-Server hinzufügen',
    'SHOWADDSMTP__INFO' => 'Füge dieses Formular aus, um einen neuen SMTP-Server hinzuzufügen.',
    'SHOWADDSMTP__SUBMIT' => 'SMTP-Server hinzufügen',
    'SHOWADDSMTP__RESET' => '{$$$COMMON__RESET}',
    'SHOWADDSMTP__OVERVIEW' => '{$$$COMMON__TOBACK}',

    // addSmtp
    'ADDSMTP__SUCCESS' => 'Smtp-Server wurde erfolgreich hinzugefügt.',
    'ADDSMTP__ERROR' => 'Ein Fehler ist aufgetreten. Bitte versuche es erneut!',
    'ADDSMTP__INVALIDINPUT' => 'Ungültige Daten. Bitte überprüfe deine Eingaben!',
    'ADDSMTP__CONNERROR' => 'Verbindung konnte nicht hergestellt werden. Bitte gebe die Verbindungdaten selber ein und versuche es erneut.',

    // showEditSmtp
    'SHOWEDITSMTP__TITLE' => 'SMTP-Server bearbeiten',
    'SHOWEDITSMTP__H1' => 'SMTP-Server bearbeiten',
    'SHOWEDITSMTP__INFO' => 'Über dieses Formular kannst du die Daten des SMTP-Servers ändern.',
    'SHOWEDITSMTP__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITSMTP__RESET' => '{$$$COMMON__RESET}',
    'SHOWEDITSMTP__TOOVERVIEW' => '{$$$COMMON__TOBACK}',

    // editSmtp
    'EDITSMTP__SUCCESS' => 'Änderungen wurden gespeichert.',
    'EDITSMTP__ERROR' => 'Ein Fehler ist aufgetreten. Bitte versuche es erneut!',
    'EDITSMTP__INVALIDINPUT' => 'Ungültige Daten. Bitte überprüfe deine Eingaben!',
    'EDITSMTP__CONNERROR' => 'Verbindung konnte nicht hergestellt werden. Bitte gebe die Verbindungdaten manuell ein und versuche es erneut!',

    // formSmtp
    'FORMSMTP__LEGEND_SMTPMAILACCOUNT' => 'SMTP-Daten',
    'FORMSMTP__MAILMAILACCOUNT' => 'Mailaccount',
    'FORMSMTP__MAILMAILACCOUNT_NOMAILACCOUNT' => 'Mit keinem Mailaccount verbunden',
    'FORMSMTP__HELP_MAILMAILACCOUNT' => 'Wähle einen Mailaccount, mit dem dieser SMTP-Server verbunden sein soll. Du kannst diesen SMTP-Server auch ohne eine solche Verbindung verwenden.',
    'FORMSMTP__EMAIL' => 'E-Mail',
    'FORMSMTP__PRESET_EMAIL' => 'E-Mail-Adresse',
    'FORMSMTP__HELP_EMAIL' => 'Deine E-Mail-Adresse.',
    'FORMSMTP__PASSWORD' => 'Passwort',
    'FORMSMTP__HELP_PASSWORD' => 'Das Passwort für diesen SMTP-Server.',
    'FORMMAILACCOUNT__LEGEND_OPTIONALDATA' => 'Optionale SMTP-Daten',
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
    'SHOWDELETESMTP__TITLE' => 'SMTP löschen',
    'SHOWDELETESMTP__POPUP_DELETE_HEADER' => 'Smtp-Server #name# löschen?',
    'SHOWDELETESMTP__POPUP_DELETE_HEADER_JS' => 'Diesen Smtp-Server löschen?',
    'SHOWDELETESMTP__POPUP_DELETE_CONTENT' => 'Willst du diesen Smtp-Server wirklich von diesem System löschen?',
    'SHOWDELETESMTP__POPUP_DELETE_YES' => 'Ja, löschen.',
    'SHOWDELETESMTP__POPUP_DELETE_NO' => 'Nein, abbrechen',

    // deleteSmtp
    'DELETESMTP__ERROR' => 'Ein Fehler ist aufgetreten. Bitte versuche es erneut!',
    'DELETESMTP__SUCCESS' => 'Smtp-Server wurde erfolgreich gelöscht.',

    /* ***************** mail ********************************** */

    // showMail
    'SHOWMAIL__TITLE' => 'Dein Mail',
    'SHOWMAIL__H1' => 'Deine Mail',
    'SHOWMAIL__DELTE' => 'Mail löschen',
    'SHOWMAIL__EDIT' => 'Mail bearbeiten',
    'SHOWMAIL__ANSWERMAIL' => 'Antwort schreiben',
    'SHOWMAIL__TOSHOWMAILBOX' => 'Zurück zur Mailbox',
    'SHOWMAIL__ATTACHMENTS' => 'Anhänge',
    'SHOWMAIL__NOIFRAMESUPPORT' => 'Dein Browser unterstützt leider keine iframes, so dass die E-Mail hier nicht eingefügt werden konnte...',
    'SHOWMAIL__NOIFRAMESUPPORT_OPENMAIL' => 'Mail in neuem Fenster öffnen',
    'SHOWMAIL__SENDER' => 'Absender',
    'SHOWMAIL__ADDRESSEE' => 'Empfänger',
    'SHOWMAIL__DATEOFMAIL' => 'Datum',

    // showDeleteMail
    'SHOWDELETEMAIL__TITLE' => 'Mail löschen',
    'SHOWDELETEMAIL__POPUP_DELETE_HEADER' => 'Lösche die Mail "#name#"?',
    'SHOWDELETEMAIL__POPUP_DELETE_HEADER_JS' => 'Diese Mail löschen?',
    'SHOWDELETEMAIL__POPUP_DELETE_CONTENT' => 'Willst du dieser Mail wirklich löschen?',
    'SHOWDELETEMAIL__POPUP_DELETE_YES' => 'Ja, löschen',
    'SHOWDELETEMAIL__POPUP_DELETE_NO' => 'Nein, abbrechen',

    // deleteMail
    'DELETEMAIL__ERROR' => 'Die Mail konnte nicht versendet werden.',
    'DELETEMAIL__SUCCESS' => 'Die Mail wurde erfolgreich gelöscht.',

    // formMail
    'FORMMAIL__LEGEND_HEADER' => 'Mail Header',
    'FORMMAIL__SENDER' => 'Absender',
    'FORMMAIL__HELP_SENDER' => 'Wähle den Smtp-Server aus, von dem diese Mail verschickt werden soll.',
    'FORMMAIL__ADDRESSEE' => 'Empfänger',
    'FORMMAIL__PRESET_ADDRESSEE' => 'E-Mail-Adresse des Empfängers',
    'FORMMAIL__HELP_ADDRESSEE' => 'Hier kommt die E-Mail-Adresse des Empfänger dieser Mail hin.',
    'FORMMAIL__SUBJECT' => 'Thema',
    'FORMMAIL__PRESET_SUBJECT' => 'Thema der Mail',
    'FORMMAIL__HELP_SUBJECT' => 'Dies ist das Thema, die Überschrift dieser Mail',
    'FORMMAIL__CONTENT' => 'Nachricht',
    'FORMMAIL__PRESET_CONTENT' => 'Deine Nachricht...',
    'FORMMAIL__HELP_CONTENT' => 'Dies ist die eigentliche Nachricht derr Mail',
    'FORMMAIL__LEGEND_CONTENT' => 'Mail Inhalt',

    // showCreateMail
    'SHOWCREATEMAIL__TITLE' => 'Neue Mail erstellen',
    'SHOWCREATEMAIL__H1' => 'Neue Mail erstellen',
    'SHOWCREATEMAIL__INFO' => 'Erstelle hier eine neue Mail, die du als Entwurf speichern oder gleich über einen deiner SMTP-Server versenden kannst.',
    'SHOWCREATEMAIL__SUBMIT' => 'Mail senden',
    'SHOWCREATEMAIL__SUBMIT_SAVE' => 'Als Entwurf speichern',
    'SHOWCREATEMAIL__CANCEL' => 'Abbrechen',

    // showCreateMail
    'SHOWEDITMAIL__TITLE' => 'Mail bearbeiten',
    'SHOWEDITMAIL__H1' => 'Mail bearbeiten',
    'SHOWEDITMAIL__INFO' => 'Hier kannst du eine Mail bearbeiten und speichern oder diese über einen deiner SMTP-Server versenden.',
    'SHOWEDITMAIL__SUBMIT' => 'Mail senden',
    'SHOWEDITMAIL__SUBMIT_SAVE' => 'Änderungen speichern',
    'SHOWEDITMAIL__CANCEL' => 'Abbrechen',

    // saveMail
    'SAVEMAIL__NOTEXISTING' => 'Die zu bearbeitende Mail existiert gar nicht!',
    'SAVEMAIL__INVALIDINPUT' => 'Ungültige Eingaben!',
    'SAVEMAIL__INVALIDSENDER' => 'Ungültiger Smtp-Server ausgewählt!',
    'SAVEMAIL__EDITERROR' => 'Beim Speichern der Änderungen ist ein Fehler aufgetreten!',
    'SAVEMAIL__CREATEERROR' => 'Beim Erstellen der Mail ist ein Fehler aufgetreten!',
    'SAVEMAIL__SUCCESS' => 'Die Mail wurde erfolgreich gespeichert.',
    'SAVEMAIL__SUCCESS_SEND' => 'Die Mail wurde erfolgreich versandt.',

    /* ***************** _system_navigation ********************************* */

    '_NAVIGATION__SHOWMAILBOXES' => 'Deine Mailboxen',
    '_NAVIGATION__SHOWCREATEMAIL' => 'Neue Mail',
    '_NAVIGATION__SHOWMAILSETTINGS' => 'Maileinstellungen',
    '_NAVIGATION__SHOWMAILSERVERS' => 'Mailserver',
    '_NAVIGATION_HEADER' => 'Mail'
);
?>
