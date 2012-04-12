<!-- | language file german -->
<?php
$lang = array(

	// userheader
	'USERHEADER__LOGGEDINAS' => 'Du bist eingeloggt als #name#.',
	'USERHEADER__LOGOUT' => 'Logout',
	'USERHEADER__NOTLOGGEDIN' => 'Bitte logge dich ein!',

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

	/* ***************** profile ******************************* */

	// showProfile
	'SHOWPROFILE__TITLE' => 'Profil',
	'SHOWPROFILE__H1' => 'Dein Profil',
	'SHOWACCOUNT__TOEDITPROFILE' => 'Profil bearbeiten',
	'SHOWPROFILE__INFOTEXT' => 'Dies ist ein Profil. Alle Informationen deines Profils sind für andere Mitglieder sichtbar.',
	'SHOWPROFILE__NAME' => 'Benutzername',

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

	/* ***************** _system_navigation ******************** */

	'_SYSTEM_NAVIGATION__TOSHOWACCOUNT' => 'Dein Account',
	'_SYSTEM_NAVIGATION__TOSHOWPROFILE' => 'Dein Profil',
	'_SYSTEM_NAVIGATION__TODOLOGOUT' => 'Logout',
	'_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Index',
	'_HEADER_NAVIGATION__SHOWLOGIN' => 'Login',
	'_HEADER_NAVIGATION__SHOWREGISTRATION' => 'Registrierung'
);
?>
