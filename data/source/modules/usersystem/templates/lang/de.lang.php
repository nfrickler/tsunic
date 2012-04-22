<!-- | language file german -->
<?php
$lang = array(

	// special
	'ISROOTPASSWORD__FAILED' => 'Bitte setze ein Passwort für den Administrator-Account "root", bevor du weitere Nutzer anlegst!',

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
	'SHOWREGISTRATION__RESET' => 'Reset',

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
	'SHOWCONFIG__RESET' => 'Reset',

	// setConfig
	'SETCONFIG__ERROR' => 'Beim Speichern einer Einstellung ist ein Fehler aufgetreten.',
	'SETCONFIG__SUCCESS' => 'Einstellungen gespeichert.',

	/* ***************** access ******************************* */

	// showAccess
	'SHOWACCESS__TITLE' => 'Berechtigungen',
	'SHOWACCESS__H1' => 'Berechtigungen',
	'SHOWACCESS__INFOTEXT' => 'Hier kannst du die Berechtigungen von Nutzern ändern',
	'SHOWACCESS__H_ACCESSOF' => 'Berechtigungen von #name#',
	'SHOWACCESS__NAME' => 'Name',
	'SHOWACCESS__VALUE' => 'Zugriff?',
	'SHOWACCESS__BYGROUPS' => 'Standard durch Gruppen',
	'SHOWACCESS__DESCRIPTION' => 'Beschreibung',
	'SHOWACCESS__USEDEFAULT' => 'Standard verwenden',
	'SHOWACCESS__YES' => 'Ja',
	'SHOWACCESS__NO' => 'Nein',
	'SHOWACCESS__SUBMIT' => 'Speichern',
	'SHOWACCESS__RESET' => 'Reset',

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
	'SHOWEDITACCOUNT__TOSHOWACCOUNT' => 'Zurück zum Account',
	'SHOWEDITACCOUNT__SUBMIT' => 'Änderungen speichern',
	'SHOWEDITACCOUNT__RESET' => 'Reset',

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

	/* ***************** navigation ******************** */

	'_SYSTEM_NAVIGATION__TOSHOWACCOUNT' => 'Dein Account',
	'_SYSTEM_NAVIGATION__TOSHOWCONFIG' => 'Einstellungen',
	'_SYSTEM_NAVIGATION__TOSHOWACCESS' => 'Berechtigungen',
	'_SYSTEM_NAVIGATION__TODOLOGOUT' => 'Logout',
	'_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Index',
	'_HEADER_NAVIGATION__SHOWLOGIN' => 'Login',
	'_HEADER_NAVIGATION__SHOWREGISTRATION' => 'Registrierung'
);
?>
