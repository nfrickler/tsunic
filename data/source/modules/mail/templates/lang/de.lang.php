<!-- | LANGUAGE german -->
<?php
$lang = array(
    'NAME' => 'Mail Modul',

    // types
    'TYPE__MAIL' => 'Nachricht',

    // tags
    'TAG__MAIL__SENDER' => 'Von',
    'TAG__MAIL__ADDRESSEE' => 'An',
    'TAG__MAIL__UID' => 'UID',
    'TAG__MAIL__DATE' => 'Datum',
    'TAG__MAIL__SUBJECT' => 'Betreff',
    'TAG__MAIL__PLAINCONTENT' => 'Textinhalt',
    'TAG__MAIL__HTMLCONTENT' => 'HTML-Inhalt',

    // classes
    'CLASS__SMTPLOCAL__NAME' => '(Lokal)',

    'CLASS__SERVERBOX__ADDATTACHMENTERROR' => 'Anhang konnte nicht heruntergeladen werden!',
    'CLASS__SERVERBOX__CREATEMAILERROR' => 'Eine Mail konnte nicht lokal gespeichert werden!',

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

    // access
    'ACCESS__USEIMAPSMTP' => 'IMAP/SMTP erlauben',
    'ACCESS__USEIMAPSMTP_DESCRIPTION' => 'Ist es erlaubt, dass man eigene Mail-Accounts über IMAP/SMTP mit diesem System verwaltet?',

    // general
    'INBOX__NAME' => 'Posteingang',
    'INBOX__DESCRIPTION' => 'Standard-Posteingang (nicht veränderbar)',

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

    /* ***************** mailbox ******************************* */

    // updateMailbox
    'UPDATEMAILBOX__SUCCESS' => 'Postfach aktualisiert.',

    // showMailboxes
    'SHOWMAILBOXES__TITLE' => 'Deine Postfächer',
    'SHOWMAILBOXES__H1' => 'Deine Postfächer',
    'SHOWMAILBOXES__INFOTEXT' => 'Hier siehst du deine Postfächer. Klicke auf den Namen eines Postfaches, um die darin enthaltenen Nachrichten zu angezeigt zu bekommen.',
    'SHOWMAILBOXES__TOCREATENEWMAILBOX' => 'Erstelle neues Postfach',
    'SHOWMAILBOXES__EDIT' => 'Bearbeiten',
    'SHOWMAILBOXES__DELETE' => 'Löschen',
    'SHOWMAILBOXES__NAME' => 'Name',
    'SHOWMAILBOXES__DESCRIPTION' => 'Beschreibung',
    'SHOWMAILBOXES__MAILNUMBER' => 'Zahl der Mails',
    'SHOWMAILBOXES__POPUP_DELETE_HEADER' => 'Postfach "#name#" löschen?',
    'SHOWMAILBOXES__POPUP_DELETE_HEADER_JS' => 'Postfach löschen?',
    'SHOWMAILBOXES__POPUP_DELETE_CONTENT' => 'Willst du wirklich dieses Postfach löschen?',
    'SHOWMAILBOXES__POPUP_DELETE_YES' => 'Ja, löschen.',
    'SHOWMAILBOXES__POPUP_DELETE_NO' => 'Nein, abbrechen.',

    // showMailbox
    'SHOWMAILBOX__TITLE' => 'Postfach anzeigen',
    'SHOWMAILBOX__H1' => 'Postfach | #name#',
    'SHOWMAILBOX__NUMBEROFMAILS' => 'Mailanzahl:',
    'SHOWMAILBOX__FROMADDRESS' => 'Von',
    'SHOWMAILBOX__SUBJECT' => 'Betreff',
    'SHOWMAILBOX__TIMESTAMP' => 'Datum',
    'SHOWMAILBOX__NOMAILINBOX' => 'In diesem Postfach sind keine Mails...',
    'SHOWMAILBOX__TOSHOWMAILBOXES' => 'Zurück zu allen Postfächern',
    'SHOWMAILBOX__TOSHOWWRITEMAIL' => 'Mail schreiben',
    'SHOWMAILBOX__JS_UPDATER' => 'Suche neue Mails...',
    'SHOWMAILBOX__OPTIONMAILBOX_NEWMAILS_HEADER' => 'Neue Mails',
    'SHOWMAILBOX__OPTIONMAILBOX_NEWMAILS_CONTENT' => 'Es wurden neue Mails heruntergeladen. Bitte aktualisiere diese Seite, um die neuen Mails angezeigt zu bekommen.',
    'SHOWMAILBOX__OPTIONMAILBOX_NEWMAILS_YES' => 'Aktualisieren',
    'SHOWMAILBOX__OPTIONMAILBOX_NEWMAILS_NO' => 'Abbrechen',
    'SHOWMAILBOX__UPDATER_NONEWMAILS' => 'Keine neuen Mails gefunden',
    'SHOWMAILBOX__UPDATER_FAIL' => 'Aktualisierung des Postfachs ist fehlgeschlagen!',
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
    'SHOWADDMAILBOX__TITLE' => 'Neues Postfach erstellen',
    'SHOWADDMAILBOX__H1' => 'Postfach erstellen',
    'SHOWADDMAILBOX__INFO' => 'Bitte fülle das Formular aus, um ein neues lokales Postfach zu erstellen.',
    'SHOWADDMAILBOX__TOSHOWMAILBOXES' => 'Zurück zu allen Postfächern',
    'SHOWADDMAILBOX__SUBMIT' => 'Postfach erstellen',
    'SHOWADDMAILBOX__RESET' => 'Reset',

    // addMailbox
    'ADDMAILBOX__SUCCESS' => 'Das neue Postfach wurde erfolgreich erstellt',
    'ADDMAILBOX__INVALIDINPUT' => 'Bitte fülle alle erforderlichen Felder aus!',

    // showEditMailbox
    'SHOWEDITMAILBOX__TITLE' => 'Postfach bearbeiten',
    'SHOWEDITMAILBOX__H1' => 'Postfach "#name#" bearbeiten',
    'SHOWEDITMAILBOX__INFO' => 'Über dieses Formular kannst du die Daten des Postfaches bearbeiten.',
    'SHOWEDITAILMAILBOX__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITMAILBOX__RESET' => 'Reset',
    'SHOWEDITMAILBOX__TOSHOWMAILBOXES' => 'Zurück zu allen Postfächern',

    // editMailbox
    'EDITMAILBOX__SUCCESS' => 'Die Änderungen wurden erfolgreich gespeichert.',
    'EDITMAILBOX__INVALIDINPUT' => 'Bitte fülle alle erforderlichen Felder korrekt aus!',

    // formMailbox
    'FORMMAILBOX__LEGEND' => 'Dein lokales Postfach',
    'FORMMAILBOX__NAME' => 'Name',
    'FORMMAILBOX__PRESET_NAME' => 'Name deines lokalen Postfaches',
    'FORMMAILBOX__HELP_NAME' => 'Gebe einen beliebigen Namen für dein lokales Postfaches ein',
    'FORMMAILBOX__DESCRIPTION' => 'Beschreibung',
    'FORMMAILBOX__PRESET_DESCRIPTION' => 'Eine Beschreibung des Postfachs',
    'FORMMAILBOX__HELP_DESCRIPTION' => 'Gebe eine Beschreibung des Postfachs ein (optional).',
    'FORMMAILBOX_ERROR_INVALIDINPUT' => 'Bitte fülle alle erforderlichen Felder korrekt aus!',

    // showDeleteMailbox
    'SHOWDELETEMAILBOX__TITLE' => 'Postfach löschen',
    'SHOWDELETEMAILBOX__POPUP_DELETE_HEADER' => 'Postfach "#name#" löschen?',
    'SHOWDELETEMAILBOX__POPUP_DELETE_HEADER_JS' => 'Postfach löschen?',
    'SHOWDELETEMAILBOX__POPUP_DELETE_CONTENT' => 'Willst du dieses Postfach wirklich löschen?',
    'SHOWDELETEMAILBOX__POPUP_DELETE_YES' => 'Ja, löschen.',
    'SHOWDELETEMAILBOX__POPUP_DELETE_NO' => 'Nein, abbrechen.',

    // deleteMailbox
    'DELETEMAILBOX__SUCCESS' => 'Das Postfach wurde erfolgreich gelöscht',
    'DELETEMAILBOX__ERROR' => 'Das Postfach konnte nicht gelöscht werden.',

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
    'SHOWMAILACCOUNT__INFOTEXT' => 'Über Mailaccounts kannst du externe Postfächer mit deinen Mailboxen auf diesem System synchronisieren, d.h. deine Mails direkt hier empfangen und verwalten.',
    'SHOWMAILACCOUNT__NAME' => 'Name',
    'SHOWMAILACCOUNT__DESCRIPTION' => 'Beschreibung',
    'SHOWMAILACCOUNT__EMAIL' => 'E-Mail',
    'SHOWMAILACCOUNT__DATEOFCREATION' => 'Erstellungsdatum',
    'SHOWMAILACCOUNT__SERVERBOXES_H1' => 'Postfächer des Mailaccounts',
    'SHOWMAILACCOUNT__SERVERBOXES_INFO' => 'Die folgenden Postfächer existieren auf dem Mailaccount. Hier kannst du festlegen, ob und mit welchen lokalen Mailboxen du diese Postfächer verknüpfen und die darin enthaltenen Mails synchronisieren willst.',
    'SHOWMAILACCOUNT__SERVERBOXES_ADD' => 'Manuell eine weiteres Postfach synchronisieren',
    'SHOWMAILACCOUNT__SERVERBOXES_SUBMIT' => 'Synchronisation starten',
    'SHOWMAILACCOUNT__SERVERBOXES_REFRESH' => 'Postfächer-Liste aktualisieren',

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
    'FORMMAILACCOUNT__LEGEND_EMAILACCOUNT' => 'Daten des Mailaccounts',
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
    'SHOWADDSERVERBOX__INFO' => 'Serverboxen sind die Mailboxen auf dem Server. Mails in dieser Serverbox werden in das korrespondierende Postfach auf diesem System geladen.',
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
    'FORMSERVERBOX__SELECTMAILBOX' => 'Lokales Postfach',
    'FORMSERVERBOX__SELECTMAILBOX_CREATENEW' => 'Neues Postfach erstellen',
    'FORMSERVERBOX__TOMAILBOX_CREATENEW' => 'Name des neuen Postfachs',
    'FORMSERVERBOX__PRESET_NAME' => 'Name der Serverbox',
    'FORMSERVERBOX__HELP_NAME' => 'Name der Serverbox, also der Name der Mailbox auf dem externen Mailserver, von dem du E-Mails herunterladen willst (z.B. "INBOX")',
    'FORMSERVERBOX__HELP_SELECTMAILBOX' => 'Wähle ein lokales Postfach aus, in die neue Mails geladen werden sollen.',
    'FORMSERVERBOX__PRESET_NEWMAILBOX' => 'Name der neuen Postfachs',
    'FORMSERVERBOX__HELP_NEWMAILBOX' => 'Füge einen Name für das neue, lokale Postfach ein.',

    // editServerbox
    'EDITSERVERBOX__INVALIDINPUT' => 'Ungültige Eingaben!',
    'EDITSERVERBOX__ERROROCCURRED' => 'Ein Fehler ist aufgetreten!',
    'EDITSERVERBOX__SUCCESS' => 'Die Änderungen wurden erfolgreich gespeichert.',

    // addServerbox
    'ADDSERVERBOX__INVALIDINPUT' => 'Ungültige Eingaben!',
    'ADDSERVERBOX__ERROR' => 'Ein Fehler ist aufgetreten!',
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
    'SHOWLISTSMTPS__EDIT' => 'SMTP-Server bearbeiten',
    'SHOWLISTSMTPS__DELETE' => 'SMTP-Server löschen',
    'SHOWLISTSMTPS__NOSMTPS' => 'Bislang sind noch keine SMTP-Server hinzugefügt worden.',
    'SHOWLISTSMTPS__DESCRIPTION' => 'Beschreibung',

    // showAddSmtp
    'SHOWADDSMTP__TITLE' => 'SMTP-Server hinzufügen',
    'SHOWADDSMTP__H1' => 'SMTP-Server hinzufügen',
    'SHOWADDSMTP__INFO' => 'Fülle dieses Formular aus, um einen neuen SMTP-Server hinzuzufügen.',
    'SHOWADDSMTP__SUBMIT' => 'SMTP-Server hinzufügen',
    'SHOWADDSMTP__RESET' => '{$$$COMMON__RESET}',
    'SHOWADDSMTP__OVERVIEW' => '{$$$COMMON__TOBACK}',

    // addSmtp
    'ADDSMTP__SUCCESS' => 'SMTP-Server wurde erfolgreich hinzugefügt.',
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
    'SHOWDELETESMTP__POPUP_DELETE_HEADER' => 'SMTP-Server #name# löschen?',
    'SHOWDELETESMTP__POPUP_DELETE_HEADER_JS' => 'Diesen SMTP-Server löschen?',
    'SHOWDELETESMTP__POPUP_DELETE_CONTENT' => 'Willst du diesen SMTP-Server wirklich von diesem System löschen?',
    'SHOWDELETESMTP__POPUP_DELETE_YES' => 'Ja, löschen.',
    'SHOWDELETESMTP__POPUP_DELETE_NO' => 'Nein, abbrechen',

    // deleteSmtp
    'DELETESMTP__ERROR' => 'Ein Fehler ist aufgetreten. Bitte versuche es erneut!',
    'DELETESMTP__SUCCESS' => 'SMTP-Server wurde erfolgreich gelöscht.',

    /* ***************** mail ********************************** */

    // showMail
    'SHOWMAIL__TITLE' => 'Dein Mail',
    'SHOWMAIL__H1' => 'Deine Mail',
    'SHOWMAIL__DELTE' => 'Mail löschen',
    'SHOWMAIL__EDIT' => 'Mail bearbeiten',
    'SHOWMAIL__ANSWERMAIL' => 'Antwort schreiben',
    'SHOWMAIL__TOSHOWMAILBOX' => 'Zurück zum Postfach',
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
    'FORMMAIL__LEGEND_HEADER' => 'Allgemeine Informationen',
    'FORMMAIL__LEGEND_CONTENT' => 'Deine Nachricht',

    // showCreateMail
    'SHOWCREATEMAIL__TITLE' => 'Neue Nachricht',
    'SHOWCREATEMAIL__H1' => 'Neue Nachricht',
    'SHOWCREATEMAIL__INFO' => 'Verfasse hier eine neue Nachricht, die du dann an deine Kontakte versenden oder erstmal als Entwurf abspeichern kannst.',
    'SHOWCREATEMAIL__SUBMIT' => 'Nachricht senden',
    'SHOWCREATEMAIL__SUBMIT_SAVE' => 'Als Entwurf speichern',
    'SHOWCREATEMAIL__CANCEL' => 'Abbrechen',

    // showEditMail
    'SHOWEDITMAIL__NOTEXISTING' => 'Die zu bearbeitende Mail existiert gar nicht!',
    'SHOWEDITMAIL__TITLE' => 'Nachricht bearbeiten',
    'SHOWEDITMAIL__H1' => 'Nachricht bearbeiten',
    'SHOWEDITMAIL__INFO' => 'Hier kannst du eine Nachricht bearbeiten, speichern oder diese an deine Kontakte versenden.',
    'SHOWEDITMAIL__SUBMIT' => 'Nachricht senden',
    'SHOWEDITMAIL__SUBMIT_SAVE' => 'Änderungen speichern',
    'SHOWEDITMAIL__CANCEL' => 'Abbrechen',

    // updateMail
    'UPDATEMAIL__ERROR' => 'Beim Speichern der Nachricht ist ein Fehler aufgetreten!',
    'UPDATEMAIL__NOTEXISTING' => 'Die zu bearbeitende Nachricht existiert gar nicht!',
    'UPDATEMAIL__INVALIDSENDER' => 'Ungültiger Sender ausgewählt!',
    'UPDATEMAIL__ERRORADDSENDER' => 'Sender konnte nicht gespeichert werden!',
    'UPDATEMAIL__ERRORADDCONTENT' => 'Inhalt der Nachricht konnte nicht gespeichert werden!',
    'UPDATEMAIL__INVALIDVALUE' => 'Ungültige Eingabe!',
    'UPDATEMAIL__SENDERROR' => 'Beim Senden der Nachricht ist ein Fehler aufgetreten!',
    'UPDATEMAIL__SENDSUCCESS' => 'Die Nachricht wurde gesendet.',
    'UPDATEMAIL__SAVESUCCESS' => 'Die Nachricht wurde gespeichert.',

    /* ***************** _system_navigation ********************************* */

    '_NAVIGATION__SHOWMAILBOXES' => 'Deine Postfächer',
    '_NAVIGATION__SHOWCREATEMAIL' => 'Neue Nachricht',
    '_NAVIGATION__SHOWMAILSETTINGS' => 'Maileinstellungen',
    '_NAVIGATION__SHOWMAILSERVERS' => 'Mailserver',
    '_NAVIGATION_HEADER' => 'Mail'
);
?>
