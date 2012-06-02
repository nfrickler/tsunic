<!-- | LANGUAGE german -->
<?php
$lang = array(
    'NAME' => 'Usersystem Modul',

    // special
    'ISROOTPASSWORD__FAILED' => 'Bitte setze ein Passwort für den Administrator-Account "root", bevor du weitere Nutzer anlegst!',
    'CLASS__FSDIRECTORY__ROOTDIR' => 'Root Verzeichnis',

    // config
    'CONFIG__MAXFILESIZE' => 'Maximale Dateigröße (Bytes)',
    'CONFIG__MAXFILESIZE__DESCRIPTION' => 'Dies legt die maximal erlaubte Dateigröße für Dateien zum Hochladen fest.',
    'CONFIG__FILESYSTEM_QUOTA' => 'Speicherplatz (Bytes)',
    'CONFIG__FILESYSTEM_QUOTA__DESCRIPTION' => 'Dieser Wert in Bytes begrenzt das jedem Nutzer zur Verfügung stehende Speichervolumen.',

    // access
    'ACCESS__DELETEALLUSERS' => 'Alle Nutzer löschen',
    'ACCESS__DELETEALLUSERS_DESCRIPTION' => 'Mit dieser Berechtigung kann man jeden beliebigen Nutzer vom System löschen.',
    'ACCESS__EDITALLACCESS' => 'Berechtigungen bearbeiten',
    'ACCESS__EDITALLACCESS_DESCRIPTION' => 'Diese Berechtigung erlaubt das Vergeben von sämtlichen Nutzerrechten.',
    'ACCESS__EDITALLUSERS' => 'Alle Nutzer bearbeiten',
    'ACCESS__EDITALLUSERS_DESCRIPTION' => 'Mit diesem Recht kann man die Account Daten aller Nutzer auf dem System bearbeiten.',
    'ACCESS__LISTALLUSERS' => 'Alle Nutzer auflisten',
    'ACCESS__LISTALLUSERS_DESCRIPTION' => 'Hiermit darf man eine Liste aller Nutzer dieses Systems einsehen.',
    'ACCESS__SEEALLACCESS' => 'Berechtigungen aller Nutzer einsehen',
    'ACCESS__SEEALLACCESS_DESCRIPTION' => 'Mit diesem Recht kann man die Berechtigungen aller Nutzer auf dem System einsehen.',
    'ACCESS__SEEALLDATA' => 'Administratorblick auf Nutzerdaten',
    'ACCESS__SEEALLDATA_DESCRIPTION' => 'Diese Berechtigung erlaubt die Anzeige aller persönlichen Nutzerdaten.',
    'ACCESS__SEEOWNACCESS' => 'Eigene Berechtigungen sehen',
    'ACCESS__SEEOWNACCESS_DESCRIPTION' => 'Dies erlaubt einem Nutzer seine eigenen Berechtigungen einzusehen.',
    'ACCESS__SEEALLCONFIG' => 'Einstellungen aller Nutzer einsehen',
    'ACCESS__SEEALLCONFIG_DESCRIPTION' => 'Mit diesem Recht kann man die Einstellungen aller Nutzer auf dem System einsehen.',
    'ACCESS__EDITALLCONFIG' => 'Einstellungen aller Nutzer bearbeiten',
    'ACCESS__EDITALLCONFIG_DESCRIPTION' => 'Mit diesem Recht kann man die Einstellungen aller Nutzer auf dem System bearbeiten.',

    // userheader
    'USERHEADER__LOGGEDINAS' => 'Du bist eingeloggt als #name#.',
    'USERHEADER__LOGOUT' => 'Logout',
    'USERHEADER__NOTLOGGEDIN' => 'Bitte logge dich ein, um weitere Funktionen von TSunic nutzen zu können!',

    // showIndex
    'SHOWINDEX__TITLE' => 'Startseite',
    'SHOWINDEX__H1' => 'Willkommen!',
    'SHOWINDEX__INFOTEXT' => 'Herzlich willkommen auf dem System! Bitte logge dich ein... Wenn du noch keinen Account hast, registriere dich bitte.',
    'SHOWINDEX__LOGIN_H1' => 'Login',
    'SHOWINDEX__REGISTER_H1' => 'Registration',
    'SHOWINDEX__REGISTER_INFOTEXT' => 'Fülle dieses Formular aus, um einen Account zu erstellen. Nur ein Account pro Benutzer!',
    'SHOWINDEX__RESET_H1' => 'Cookies löschen',
    'SHOWINDEX__RESET_INFOTEXT' => 'Wenn du dich an einem fremden Computer eingeloggt hast, solltest du die Cookies dieser Seite löschen und so z.B. das E-Mail/Benutzername-Feld im Loginformular zu leeren.',
    'SHOWINDEX__REGISTER_LINK' => 'Cookies dieser Seite löschen',

    /* *************** login and registration ****************** */

    // showLogin
    'SHOWLOGIN__TITLE' => 'Login',
    'SHOWLOGIN__H1' => 'Login',
    'SHOWLOGIN__INFOTEXT' => 'Füge hier deine Login-Daten ein, um dich einzuloggen. Wenn du noch keinen Account auf diesem System hast, registriere dich zuerst.',
    'SHOWLOGIN__RESET_H1' => 'Cookies löschen',
    'SHOWLOGIN__RESET_INFOTEXT' => 'Wenn du dich an einem fremden Computer eingeloggt hast, solltest du die Cookies dieser Seite löschen und so z.B. das E-Mail/Benutzername-Feld im Loginformular zu leeren.',
    'SHOWLOGIN__RESET_LINK' => 'Cookies dieser Seite löschen',

    // formLogin
    'FORMLOGIN__LEGEND' => 'Deine Login-Daten',
    'FORMLOGIN__EMAIL' => 'E-Mail oder Benutzername',
    'FORMLOGIN__EMAIL_PRESET' => 'Deine E-Mail oder Benutzername...',
    'FORMLOGIN__EMAIL_HELP' => 'Gebe deinen Benutzernamen oder deine E-Mail-Adresse ein.',
    'FORMLOGIN__PASSWORD' => 'Passwort',
    'FORMLOGIN__PASSWORD_HELP' => 'Gebe hier dein Passwort ein.',
    'FORMLOGIN__SUBMIT' => 'Einloggen',

    // doLogin
    'DOLOGIN__SUCCESS' => 'Du hast dich erfolgreich eingeloggt.',
    'DOLOGIN__FAILED' => 'Login fehlgeschlagen. Entweder E-Mail/Benutzername oder Passwort waren falsch.',

    // doLogout
    'DOLOGOUT__SUCCESS' => 'Du hast dich erfolgreich ausgeloggt.',

    // showRegistration
    'SHOWREGISTRATION__TITLE' => 'Registrierung',
    'SHOWREGISTRATION__H1' => 'Registrierung',
    'SHOWREGISTRATION__INFOTEXT' => 'Fülle dieses Formular aus, um einen Account zu erstellen. Nur ein Account pro Benutzer!',
    'SHOWREGISTRATION__SUBMIT' => 'Neuen Account erstellen',

    // do register
    'DOREGISTER__INVALIDREPEAT' => 'Das Passwort wurde falsch wiederholt!',
    'DOREGISTER__SUCCESS' => 'Du hast die erfolgreich registriert. Du kannst dich jetzt einloggen...',
    'DOREGISTER__ERROR' => 'Deine Registration ist fehlgeschlagen. Bitte versuche es erneut!',
    'DOREGISTER__INVALIDEMAIL' => 'Ungültige E-Mail-Adresse! Hast du dich vielleicht schon registriert?',
    'DOREGISTER__INVALIDPASSWORD' => 'Ungültiges Passwort! Dein Passwort muss mindestens 7 Zeichen haben.',
    'DOREGISTER__INVALIDNAME' => 'Ungültiger Benutzername! Vielleicht ist dieser Benutzername schon besetzt...',

    /* ***************** config ******************************* */

    // showConfig
    'SHOWCONFIG__TITLE' => 'Einstellungen',
    'SHOWCONFIG__H1' => 'Einstellungen',
    'SHOWCONFIG__INFOTEXT' => 'Hier kannst du die Einstellungen für deinen Account festlegen.',
    'SHOWCONFIG__NAME' => 'Name',
    'SHOWCONFIG__VALUE' => 'Wert',
    'SHOWCONFIG__DEFAULT' => 'Standard',
    'SHOWCONFIG__DESCRIPTION' => 'Beschreibung',
    'SHOWCONFIG__USEDEFAULT' => 'Standard verwenden',
    'SHOWCONFIG__SUBMIT' => 'Speichern',
    'SHOWCONFIG__CHOOSE_USER_LABEL' => 'Benutzer anzeigen',
    'SHOWCONFIG__CHOOSE_USER' => '---Benutzer wählen---',
    'SHOWCONFIG__CHOOSE_SUBMIT' => 'Anzeigen',
    'SHOWCONFIG__SHOWCONFIGFROM' => 'Einstellungen von "#name#"',

    // setConfig
    'SETCONFIG__ERROR' => 'Beim Speichern einer Einstellung ist ein Fehler aufgetreten.',
    'SETCONFIG__SUCCESS' => 'Einstellungen gespeichert.',

    /* ***************** access ******************************* */

    // showAccess
    'SHOWACCESS__TITLE' => 'Berechtigungen',
    'SHOWACCESS__H1' => 'Berechtigungen',
    'SHOWACCESS__TOACCESSGROUPS' => 'Accessgruppen bearbeiten',
    'SHOWACCESS__INFOTEXT' => 'Hier kannst du die Berechtigungen von Nutzern ändern',
    'SHOWACCESS__H_ACCESSOF' => 'Berechtigungen von #name#',
    'SHOWACCESS__NAME' => 'Name',
    'SHOWACCESS__VALUE' => 'Zugriff?',
    'SHOWACCESS__BYGROUPS' => 'Standard durch Gruppen',
    'SHOWACCESS__BYPARENT' => 'Standard durch übergeordnete Gruppen',
    'SHOWACCESS__DESCRIPTION' => 'Beschreibung',
    'SHOWACCESS__USEDEFAULT' => 'Standard verwenden',
    'SHOWACCESS__YES' => 'Ja',
    'SHOWACCESS__NO' => 'Nein',
    'SHOWACCESS__SUBMIT' => 'Speichern',
    'SHOWACCESS__RESET' => 'Reset',
    'SHOWACCESS__CHOOSE_USER_LABEL' => 'Benutzer anzeigen',
    'SHOWACCESS__CHOOSE_GROUP_LABEL' => 'Gruppe anzeigen',
    'SHOWACCESS__CHOOSE_USER' => '---Benutzer wählen---',
    'SHOWACCESS__CHOOSE_GROUP' => '---Gruppe wählen---',
    'SHOWACCESS__CHOOSE_SUBMIT' => 'Anzeigen',

    'SETACCESS__SUCCESS' => 'Die Berechtigungen wurden gespeichert.',
    'SETACCESS__ERROR' => 'Beim Speichern ist ein Fehler aufgetreten!',

    /* ***************** accessgroups *************************** */

    // showAccessgroups
    'SHOWACCESSGROUPS__TITLE' => 'Accessgruppen',
    'SHOWACCESSGROUPS__H1' => 'Accessgruppen',
    'SHOWACCESSGROUPS__INFOTEXT' => 'Hier sind alle Accessgruppen aufgelistet. Du kannst neue hinzufügen oder existierende bearbeiten und entfernen.',
    'SHOWACCESSGROUPS__TOCREATEACCESSGROUP' => 'Create new accessgroup',

    // showAccessgroup
    'SHOWACCESSGROUP__TITLE' => 'Berechtigungsgruppe',
    'SHOWACCESSGROUP__H1' => 'Berechtigungsgruppe #name#',
    'SHOWACCESSGROUP__TODELETEACCESSGROUP' => 'Berechtigungsgruppe löschen',
    'SHOWACCESSGROUP__TOSHOWACCESSGROUPMEMBERS' => 'Mitglieder verwalten',
    'SHOWACCESSGROUP__TOSHOWACCESSGROUPS' => 'Alle Berechtigungsgruppen',
    'SHOWACCESSGROUP__INFOTEXT' => 'Hier kannst du die Berechtigungsgruppe bearbeiten.',
    'SHOWACCESSGROUP__SUBMIT' => 'Änderungen speichern',
    'SHOWACCESSGROUP__CANCEL' => 'Abbrechen',

    // showCreateAccessgroup
    'SHOWCREATEACCESSGROUP__TITLE' => 'Neue Berechtigungsgruppe',
    'SHOWCREATEACCESSGROUP__H1' => 'Neue Berechtigungsgruppe',
    'SHOWCREATEACCESSGROUP__TOACCESSGROUPS' => 'Zurück zu den Berechtigungsgruppen',
    'SHOWCREATEACCESSGROUP__INFOTEXT' => 'Fülle das Formular aus, um eine neue Berechtigungsgruppe zu erstellen.',
    'SHOWCREATEACCESSGROUP__SUBMIT' => 'Gruppe erstellen',
    'SHOWCREATEACCESSGROUP__CANCEL' => 'Abbrechen',

    // editAccessgroup
    'EDITACCESSGROUP__INVALIDNAME' => 'Ungültiger Name!',
    'EDITACCESSGROUP__INVALIDPARENT' => 'Ungültige übergeordnete Gruppe!',
    'EDITACCESSGROUP__SUCCESS' => 'Änderungen wurden gespeichert!',
    'EDITACCESSGROUP__ERROR' => 'Es ist ein Fehler ist aufgetreten!',
    'EDITACCESSGROUP__INVALIDGROUP' => 'Berechtigungsgruppe existiert nicht!',

    // createAccessgroup
    'CREATEACCESSGROUP__INVALIDNAME' => 'Ungültiger Name!',
    'CREATEACCESSGROUP__INVALIDPARENT' => 'Ungültige übergeordnete Gruppe!',
    'CREATEACCESSGROUP__SUCCESS' => 'Die Berechtigungsgruppe wurde erstellt.',
    'CREATEACCESSGROUP__ERROR' => 'Es ist ein Fehler ist aufgetreten!',

    // formAccessgroup
    'FORMACCESSGROUP__NAME' => 'Name',
    'FORMACCESSGROUP__NAME_PRESET' => 'Name der Berechtigungsgruppe',
    'FORMACCESSGROUP__LEGEND' => 'Berechtigungsgruppe',
    'FORMACCESSGROUP__NAME_HELP' => 'Lege einen Namen für die Berechtigungsgruppe fest.',
    'FORMACCESSGROUP__PARENT' => 'Übergeordnete Gruppe',
    'FORMACCESSGROUP__PARENT_HELP' => 'Wähle eine übergeordnete Gruppe. Von dieser übergeordneten Gruppe wird diese Gruppe die Berechtigungen erben.',
    'FORMACCESSGROUP__OPTION_ALLGROUP' => 'Keine übergeordnete Gruppe',

    // showDeleteAccessgroup
    'SHOWDELETEACCESSGROUP__TITLE' => 'Berechtigungsgruppe löschen',
    'SHOWDELETEACCESSGROUP__H1' => 'Berechtigungsgruppe #name# löschen?',
    'SHOWDELETEACCESSGROUP__INFOTEXT' => 'Willst du diese Berechtigungsgruppe wirklich löschen?',
    'SHOWDELETEACCESSGROUP__SUBMIT' => 'Ja, löschen.',
    'SHOWDELETEACCESSGROUP__CANCEL' => 'Nein, abbrechen.',

    // deleteAccessgroup
    'DELETEACCESSGROUP__SUCCESS' => 'Berechtigungsgruppe wurde gelöscht.',
    'DELETEACCESSGROUP__ERROR' => 'Gruppe konnte nicht gelöscht werden.',

    // showAccessgroupmembers
    'SHOWACCESSGROUPMEMBERS__TITLE' => 'Mitglieder der Berechtigungsgruppe',
    'SHOWACCESSGROUPMEMBERS__H1' => 'Mitglieder der Berechtigungsgruppe "#name#"',
    'SHOWACCESSGROUPMEMBERS__INFOTEXT' => 'Hier kannst du die Mitglieder eine Berechtigungsgruppe verwalten.',
    'SHOWACCESSGROUPMEMBERS__TOSHOWADDACCESSGROUPMEMBER' => 'Weiteres Mitglied hinzufügen',
    'SHOWACCESSGROUPMEMBERS__TOSHOWACCESSGROUP' => 'Zurück zur Berechtungsgruppe',
    'SHOWACCESSGROUPMEMBERS__NAME' => 'Name',
    'SHOWACCESSGROUPMEMBERS__ACTION' => 'Aktion',
    'SHOWACCESSGROUPMEMBERS__DELETEMEMBER' => 'Aus Gruppe löschen',

    // showAddAccessgroupmember
    'SHOWADDACCESSGROUPMEMBER__TITLE' => 'Mitglied zur Berechtigungsgruppe hinzufügen',
    'SHOWADDACCESSGROUPMEMBER__H1' => 'Mitglied zur Berechtigungsgruppe "#name#" hinzufügen',
    'SHOWADDACCESSGROUPMEMBER__INFOTEXT' => 'Wähle einen Nutzer aus, um ihn dieser Benutzergruppe hinzuzufügen.',
    'SHOWADDACCESSGROUPMEMBER__LEGEND' => 'Benutzer wählen',
    'SHOWADDACCESSGROUPMEMBER__USER' => 'Benutzer',
    'SHOWADDACCESSGROUPMEMBER__USER_HELP' => 'Wähle einen Benutzer aus, den du zu dieser Berechtigungsgruppe hinzuzufügen.',
    'SHOWADDACCESSGROUPMEMBER__SUBMIT' => 'Hinzufügen',
    'SHOWADDACCESSGROUPMEMBER__CANCEL' => 'Abbrechen',

    // addAccessgroupmember
    'ADDACCESSGROUPMEMBER__SUCCESS' => 'Benutzer wurde erfolgreich hinzugefügt',
    'ADDACCESSGROUPMEMBER__ERROR' => 'Benutzer konnte nicht zur Gruppe hinzugefügt werden.',

    // showDeleteAccessgroupmembers
    'SHOWDELETEACCESSGROUPMEMBER__TITLE' => 'Benutzer von Berechtigungsgruppe entfernen',
    'SHOWDELETEACCESSGROUPMEMBER__H1' => 'Benutzer #username# von der Berechtungsgruppe #name# entfernen?',
    'SHOWDELETEACCESSGROUPMEMBER__INFOTEXT' => 'Willst du dieses Mitglied wirklich von dieser Berechtigungsgruppe entfernen?',
    'SHOWDELETEACCESSGROUPMEMBER__SUBMIT' => 'Ja, entfernen.',
    'SHOWDELETEACCESSGROUPMEMBER__CANCEL' => 'Nein, abbrechen.',

    // deleteAccessgroupmember
    'DELETEACCESSGROUPMEMBER__SUCCESS' => 'Benutzer wurde aus der Gruppe entfernt.',
    'DELETEACCESSGROUPMEMBER__ERROR' => 'Benutzer konnte nicht aus der Gruppe entfernt werden!',

    /* ***************** account ******************************* */

    // showAccount
    'SHOWACCOUNT__TITLE' => 'Account',
    'SHOWACCOUNT__H1' => 'Dein Account',
    'SHOWACCOUNT__TOEDITACCOUNT' => 'Account bearbeiten',
    'SHOWACCOUNT__TODELETEACCOUNT' => 'Account löschen',
    'SHOWACCOUNT__NAME' => 'Benutzername',
    'SHOWACCOUNT__EMAIL' => 'E-Mail',
    'SHOWACCOUNT__PASSWORD' => 'Passwort',
    'SHOWACCOUNT__DATEOFREGISTRATION' => 'Datum der Registration',
    'SHOWACCOUNT__DATEOFCHANGE' => 'Letzte Änderung der Daten',
    'SHOWACCOUNT__INFOTEXT' => 'Dein Account beinhaltet deine Logindaten. Alle diese Daten sind für andere Mitglieder standardmäßig nicht einsehbar.',

    // showEditAccount
    'SHOWEDITACCOUNT__TITLE' => 'Account bearbeiten',
    'SHOWEDITACCOUNT__H1' => 'Account bearbeiten',
    'SHOWEDITACCOUNT__INFOTEXT' => 'Um deinen Account zu bearbeiten, ändere die Daten im folgenden Formular.',
    'SHOWEDITACCOUNT__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITACCOUNT__CANCEL' => 'Abbrechen',

    // editAccount
    'EDITACCOUNT__INVALIDREPEAT' => 'Passwort wurde falsch wiederholt. Bitte versuche es erneut.',
    'EDITACCOUNT__SUCCESS' => 'Die Änderungen wurden erfolgreich gespeichert.',
    'EDITACCOUNT__ERROR' => 'Ein Fehler ist aufgetreten. Die Änderungen konnten nicht gespeichert werden.',
    'EDITACCOUNT__INVALIDNAME' => 'Ungültiger Name!',
    'EDITACCOUNT__INVALIDEMAIL' => 'Ungültige E-Mail-Adresse!',
    'EDITACCOUNT__INVALIDPASSWORD' => 'Ungültiges Passwort (mindestens 7 Zeichen)!',

    // formAccount
    'FORMACCOUNT__LEGEND' => 'Dein Account',
    'FORMACCOUNT__NAME' => 'Benutzername',
    'FORMACCOUNT__NAME_PRESET' => 'Dein Benutzername',
    'FORMACCOUNT__NAME_HELP' => 'Gebe hier einen Benutzernamen ein, der dir gefällt.',
    'FORMACCOUNT__EMAIL' => 'E-Mail',
    'FORMACCOUNT__EMAIL_PRESET' => 'Deine E-Mail-Adresse',
    'FORMACCOUNT__EMAIL_HELP' => 'E-Mail-Adresse für diesen Account.',
    'FORMACCOUNT__PASSWORD' => 'Neues Passwort',
    'FORMACCOUNT__PASSWORD_HELP' => 'Neues Passwort für deinen Account (mindestens 7 Zeichen). Lasse dieses Feld leer, wenn du dein Passwort nicht ändern willst.',
    'FORMACCOUNT__PASSWORDREPEAT' => 'Wiederhole neues Passwort',
    'FORMACCOUNT__PASSWORDREPEAT_HELP' => 'Bitte wiedehole dein Passwort (nur, wenn du dein Passwort geändert hast).',

    // showDeleteAccount
    'SHOWDELETEACCOUNT__TITLE' => 'Account löschen',
    'SHOWDELETEACCOUNT__H1' => 'Account löschen?',
    'SHOWDELETEACCOUNT__INFOTEXT' => 'Möchtest du deinen Account wirklich löschen? Alle deine Daten werden gelöscht und können nicht wiederherstellen!',
    'SHOWDELETEACCOUNT__LEGEND' => 'Bitte bestätige diese Aktion, indem du dein Passwort eingibst.',
    'SHOWDELETEACCOUNT__PASSWORD' => 'Passwort',
    'SHOWDELETEACCOUNT__SUBMIT' => 'Account löschen',
    'SHOWDELETEACCOUNT__TOSHOWACCOUNT' => 'Zurück zum Account',

    // deleteAccount
    'DELETEACCOUNT__ERROR' => 'Ein Fehler ist aufgetreten. Bitte versuche es erneut!',
    'DELETEACCOUNT__SUCCESS' => 'Dein Account wurde gelöscht.',
    'DELETEACCOUNT__WRONGPASSWORD' => 'Falsches Passwort!',

    // showDeleteUser
    'SHOWDELETEUSER__TITLE' => 'Benutzer löschen',
    'SHOWDELETEUSER__H1' => 'Benutzer #name# (#email#) löschen',
    'SHOWDELETEUSER__INFOTEXT' => 'Bist du dir sicher, dass du diesen Benutzer löschen willst? Der Nutzer und alle seine Daten werden ZERSTÖRT!',
    'SHOWDELETEUSER__OK' => 'Ja, Benutzer löschen',
    'SHOWDELETEUSER__CANCEL' => 'Nein, abbrechen',

    // deleteUser
    'DELETEUSER__ERROR' => 'Benutzer konnte nicht gelöscht werden!',
    'DELETEUSER__SUCCESS' => 'Benutzer gelöscht.',

    // showUserlist
    'SHOWUSERLIST__TITLE' => 'Benutzerliste',
    'SHOWUSERLIST__H1' => 'Benutzerliste',
    'SHOWUSERLIST__INFOTEXT' => 'Dies ist eine Liste aller Nutzer auf diesem System.',
    'SHOWUSERLIST__NAME' => 'Name',
    'SHOWUSERLIST__EMAIL' => 'E-Mail',
    'SHOWUSERLIST__DATEOFREGISTRATION' => 'Registration',
    'SHOWUSERLIST__DATEOFLASTLOGIN' => 'Letzer Login',
    'SHOWUSERLIST__ACTION' => 'Aktion',
    'SHOWUSERLIST__DELETEUSER' => 'Löschen',

    /* ***************** filesystem ******************** */

    // showFsDirectory
    'SHOWFSDIRECTORY__TITLE' => 'Verzeichnis anzeigen',
    'SHOWFSDIRECTORY__H1' => 'Verzeichnis "#name#"',
    'SHOWFSDIRECTORY__INFOTEXT' => 'Diese Seite zeigt dir den Inhalt des Verzeichnisses.',
    'SHOWFSDIRECTORY__TOSHOWCREATEFSDIRECTORY' => 'Neues Verzeichnis erstellen',
    'SHOWFSDIRECTORY__TOSHOWCREATEFSFILE' => 'Neue Datei hochladen',
    'SHOWFSDIRECTORY__TOSHOWEDITFSDIRECTORY' => 'Verzeichnis bearbeiten',
    'SHOWFSDIRECTORY__NAME' => 'Name',
    'SHOWFSDIRECTORY__PERMISSIONS' => 'Rechte',
    'SHOWFSDIRECTORY__DATEOFCREATION' => 'Erstellungsdatum',
    'SHOWFSDIRECTORY__DATEOFUPDATE' => 'Letzte Änderung',
    'SHOWFSDIRECTORY__ACTION' => 'Aktion',
    'SHOWFSDIRECTORY__DELETE' => 'Löschen',
    'SHOWFSDIRECTORY__EDIT' => 'Umbennenen/Verschieben',

    // formFsDirectory
    'FORMFSDIRECTORY__NAME' => 'Name',
    'FORMFSDIRECTORY__NAME_PRESET' => 'Verzeichnisname',
    'FORMFSDIRECTORY__LEGEND' => 'Verzeichnis',
    'FORMFSDIRECTORY__NAME_HELP' => 'Lege einen Namen für das Verzeichnis fest.',
    'FORMFSDIRECTORY__PARENT' => 'Übergeordnetes Verzeichnis',
    'FORMFSDIRECTORY__PARENT_HELP' => 'Wähle ein übergeordnetes Verzeichnis.',
    'FORMFSDIRECTORY__OPTION_ROOTDIR' => 'Root Verzeichnis',

    // showCreateFsDirectory
    'SHOWCREATEFSDIRECTORY__TITLE' => 'Neues Verzeichnis anlegen',
    'SHOWCREATEFSDIRECTORY__H1' => 'Neues Verzeichnis anlegen',
    'SHOWCREATEFSDIRECTORY__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWCREATEFSDIRECTORY__INFOTEXT' => 'Fülle das folgende Formular aus, um ein neues Verzeichnis anzulegen.',
    'SHOWCREATEFSDIRECTORY__SUBMIT' => 'Verzeichnis anlegen',
    'SHOWCREATEFSDIRECTORY__CANCEL' => 'Abbrechen',

    // createFsDirectory
    'CREATEFSDIRECTORY__SUCCESS' => 'Verzeichnis wurde angelegt.',
    'CREATEFSDIRECTORY__ERROR' => 'Verzeichnis konnte nicht angelegt werden!',
    'CREATEFSDIRECTORY__INVALIDNAME' => 'Der Name ist ungültig!',
    'CREATEFSDIRECTORY__INVALIDPARENT' => 'Das übergeordnete Verzeichnis ist ungültig!',

    // showEditFsDirectory
    'SHOWEDITFSDIRECTORY__TITLE' => 'Verzeichnis bearbeiten',
    'SHOWEDITFSDIRECTORY__H1' => 'Verzeichnis "#name#" bearbeiten',
    'SHOWEDITFSDIRECTORY__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWEDITFSDIRECTORY__INFOTEXT' => 'Über das folgende Formular kannst du das Verzeichnis bearbeiten',
    'SHOWEDITFSDIRECTORY__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITFSDIRECTORY__CANCEL' => 'Abbrechen',

    // editFsDirectory
    'EDITFSDIRECTORY__SUCCESS' => 'Änderungen wurden gespeichert.',
    'EDITFSDIRECTORY__ERROR' => 'Änderungen konnten nicht gespeichert werden!',
    'EDITFSDIRECTORY__INVALIDNAME' => 'Der Name ist ungültig!',
    'EDITFSDIRECTORY__INVALIDPARENT' => 'Das übergeordnete Verzeichnis ist ungültig!',

    // showDeleteFsDirectory
    'SHOWDELETEFSDIRECTORY__TITLE' => 'Verzeichnis löschen',
    'SHOWDELETEFSDIRECTORY__H1' => 'Verzeichnis #name# löschen?',
    'SHOWDELETEFSDIRECTORY__INFOTEXT' => 'Willst du dieses Verzeichnis wirklich löschen?',
    'SHOWDELETEFSDIRECTORY__SUBMIT' => 'Ja, löschen.',
    'SHOWDELETEFSDIRECTORY__CANCEL' => 'Nein, abbrechen.',
    'SHOWDELETEFSDIRECTORY__NOTEMPTY' => 'Das Verzeichnis muss leer sein, bevor es gelöscht werden kann!',

    // deleteFsDirectory
    'DELETEFSDIRECTORY__SUCCESS' => 'Verzeichnis wurde gelöscht',
    'DELETEFSDIRECTORY__ERROR' => 'Verzeichnis konnte nicht gelöscht werden!',

    // formFsFile
    'FORMFSFILE__NAME' => 'Name',
    'FORMFSFILE__NAME_PRESET' => 'Name der Datei',
    'FORMFSFILE__NAME_HELP' => 'Ein frei wählbarer Name für diese Datei.',
    'FORMFSFILE__FILE' => 'Datei',
    'FORMFSFILE__FILE_HELP' => 'Wähle eine Datei aus, die du hochladen willst.',
    'FORMFSFILE__LEGEND' => 'Datei',
    'FORMFSFILE__DIRECTORY' => 'Verzeichnis der Datei',
    'FORMFSFILE__DIRECTORY_HELP' => 'Verzeichnis, in dem die Datei gespeichert ist.',
    'FORMFSFILE__OPTION_ROOTDIR' => 'Root Verzeichnis',

    // showCreateFsFile
    'SHOWCREATEFSFILE__TITLE' => 'Neue Datei hochladen',
    'SHOWCREATEFSFILE__H1' => 'Neue Datei hochladen',
    'SHOWCREATEFSFILE__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWCREATEFSFILE__INFOTEXT' => 'Fülle das folgende Formular aus, um ein Datei hochzuladen.',
    'SHOWCREATEFSFILE__SUBMIT' => 'Datei hochladen',
    'SHOWCREATEFSFILE__CANCEL' => 'Abbrechen',

    // createFsFile
    'CREATEFSFILE__SUCCESS' => 'Datei wurde hochgeladen.',
    'CREATEFSFILE__ERROR' => 'Datei konnte nicht hochgeladen werden!',
    'CREATEFSFILE__INVALIDFILESIZE' => 'Die Datei ist zu groß!',
    'CREATEFSFILE__INVALIDQUOTA' => 'Der Upload dieser Datei würde das Speicherlimit überschreiten!',
    'CREATEFSFILE__INVALIDDIRECTORY' => 'Das Verzeichnis ist ungültig!',

    // showEditFsFile
    'SHOWEDITFSFILE__TITLE' => 'Datei bearbeiten',
    'SHOWEDITFSFILE__H1' => 'Datei "#name#" bearbeiten',
    'SHOWEDITFSFILE__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWEDITFSFILE__INFOTEXT' => 'Über das folgende Formular kannst du die Datei umbennenen oder verschieben',
    'SHOWEDITFSFILE__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITFSFILE__CANCEL' => 'Abbrechen',

    // editFsFile
    'EDITFSFILE__SUCCESS' => 'Änderungen wurden gespeichert.',
    'EDITFSFILE__ERROR' => 'Änderungen konnten nicht gespeichert werden!',
    'EDITFSFILE__INVALIDNAME' => 'Der Name ist ungültig!',
    'EDITFSFILE__INVALIDPARENT' => 'Das Verzeichnis ist ungültig!',

    // showDeleteFsFile
    'SHOWDELETEFSFILE__TITLE' => 'Datei löschen',
    'SHOWDELETEFSFILE__H1' => 'Datei #name# löschen?',
    'SHOWDELETEFSFILE__INFOTEXT' => 'Willst du dieses Datei wirklich löschen?',
    'SHOWDELETEFSFILE__SUBMIT' => 'Ja, löschen.',
    'SHOWDELETEFSFILE__CANCEL' => 'Nein, abbrechen.',

    // deleteFsFile
    'DELETEFSFILE__SUCCESS' => 'Datei wurde gelöscht',
    'DELETEFSFILE__ERROR' => 'Datei konnte nicht gelöscht werden!',

    /* ***************** navigation ******************** */

    '_SYSTEM_NAVIGATION__TOSHOWACCOUNT' => 'Dein Account',
    '_SYSTEM_NAVIGATION__TOSHOWCONFIG' => 'Einstellungen',
    '_SYSTEM_NAVIGATION__TOSHOWFILESYSTEM' => 'Dateisystem',
    '_SYSTEM_NAVIGATION__TOSHOWACCESS' => 'Berechtigungen',
    '_SYSTEM_NAVIGATION__TOSHOWUSERLIST' => 'Benutzerliste',
    '_SYSTEM_NAVIGATION__TODOLOGOUT' => 'Logout',
    '_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Index',
    '_HEADER_NAVIGATION__SHOWLOGIN' => 'Login',
    '_HEADER_NAVIGATION__SHOWREGISTRATION' => 'Registrierung'
);
?>
