<!-- | language file german -->
<?php
$lang = array(

	// errors
	'ERROR__PLEASELOGIN' => 'Bitte logge dich zunächst ein!',
	'ERROR__UNKNOWNERROR' => 'Es ist ein Fehler aufgetreten!',
	'ERROR__LOGINERROR' => 'Beim Login ist ein Fehler aufgetreten!',
	'ERROR__INITDATABASE' => 'Fehler beim initialisieren der Datenbank!',
	'ERROR__CLASSMODULE__PREPARSE' => 'PreParsing failed!',
	'ERROR__CLASSSTYLE__PREPARSE' => 'PreParsing failed!',

	// info
	'INFO__SAVED' => 'Einstellungen gespeichert.',
	'INFO__INITDATABASE' => 'Datenbank wurde erfolgreich eingerichtet.',
	'INFO__SETPASSWORD' => 'Bitte lege zunächst ein Passwort für das Backend fest!',

	// class
	'MODULE__CLASS__STATUS_ERROR' => 'Fehlerhaftes Modul',
	'MODULE__CLASS__STATUS_UNINSTALLED' => 'Deinstalliert',
	'MODULE__CLASS__STATUS_UPDATEWAITING' => 'Update wartet...',
	'MODULE__CLASS__STATUS_INSTALLED' => 'Installiert',
	'MODULE__CLASS__STATUS_AVAILABLE' => 'Verfügbar',
	'MODULE__CLASS__STATUS_PREPARSINGERROR' => 'PreParser-Fehler',
	'MODULE__CLASS__STATUS_PARSED' => 'Verwendet',
	'STYLE__CLASS__STATUS_ERROR' => 'Fehlerhafter Style',
	'STYLE__CLASS__STATUS_AVAILABLE' => 'Verfügbar',
	'STYLE__CLASS__STATUS_PREPARSINGERROR' => 'PreParser-Fehler',
	'STYLE__CLASS__STATUS_PARSED' => 'Verwendet',
	'STYLE__CLASS__STATUS_DEFAULT' => 'Standard',

	// showLogin
	'SHOWLOGIN__TITLE' => 'Login',
	'SHOWLOGIN__H1' => 'TS_Admin | Login',
	'SHOWLOGIN__INFOTEXT' => 'Bitte gebe das Administrations-Passwort ein, um das System zu verwalten.',
	'SHOWLOGIN__LEGEND' => 'Bitte Passwort eingeben...',
	'SHOWLOGIN__PASSWORD' => 'Administrations-Passwort',
	'SHOWLOGIN__SUBMIT' => 'Einloggen',

	// setLogin
	'SHOWSETLOGIN__TITLE' => 'Passwort festlegen',
	'SHOWSETLOGIN__H1' => 'TS_Admin | Passwort festlegen',
	'SHOWSETLOGIN__INFOTEXT' => 'Lege hier das Passwort für den Administrationsbereich fest. Der Administrationsbereich wird nur noch über dieses Passwort zugänglich sein. Du kannst das Passwort jederzeit wieder ändern.',
	'SHOWSETLOGIN__LEGEND' => 'Bitte ein gewünschtes Passwort eingeben...',
	'SHOWSETLOGIN__PASSWORD' => 'Administrations-Passwort',
	'SHOWSETLOGIN__SUBMIT' => 'Passwort speichern',

	// showIndex
	'SHOWINDEX__TITLE' => 'Übersicht',
	'SHOWINDEX__H1' => 'TS_Admin | Übersicht',
	'SHOWINDEX__INFOTEXT' => 'Du bist im Administrations-Backend von TSunic. Hier kannst du grundlegende Einstellungen der Software ändern und deren Module verwalten.',
	'SHOWINDEX__H2_INDEX' => 'Deine Möglichkeiten im Überlick',
	'SHOWINDEX__DT_MODULES' => 'Module verwalten/installieren/updaten/deinstallieren',
	'SHOWINDEX__DD_MODULES' => 'Administriere alle Module von TSunic, füge neue hinzu oder lösche welche. Diese Seite bietet dir eine einfache Verwaltung an.',
	'SHOWINDEX__DT_CONFIG' => 'Verwalte die Einstellungen',
	'SHOWINDEX__DD_CONFIG' => 'Ändere grundlegende Einstellungen von TSunic.',
	'SHOWINDEX__DT_TOOLS' => 'Optimiere die Software',
	'SHOWINDEX__DD_TOOLS' => 'Benutze nützliche Werkzeuge zur Optimierung von TSunic.',
	'SHOWINDEX__DT_SETLOGIN' => 'Passwort ändern',
	'SHOWINDEX__DD_SETLOGIN' => 'Ändere das Passwort für dieses Administrations-Backend.',
	'SHOWINDEX__DT_SYSTEMCHECK' => 'System überprüfen',
	'SHOWINDEX__DD_SYSTEMCHECK' => 'Überprüfe die Einstellungen deines Servers und den Status des Systems.',

	// showModules
	'SHOWMODULES__TITLE' => 'Modules',
	'SHOWMODULES__H1' => 'TS_Admin | Module verwalten',
	'SHOWMODULES__INFOTEXT' => 'Hier kannst du Module installieren/updaten/deinstallieren und verwalten.',
	'SHOWMODULES__MODNAME' => 'Modulname',
	'SHOWMODULES__VERSION' => 'Version',
	'SHOWMODULES__MODDESCRIPTION' => 'Beschreibung',
	'SHOWMODULES__STATUS' => 'Status',
	'SHOWMODULES__AUTHOR' => 'Autor',
	'SHOWMODULES__RENDER' => 'TSunic rendern',
	'SHOWMODULES__SUBMIT' => 'Einstellungen speichern',
	'SHOWMODULES__RESET' => 'Reset',
	'SHOWMODULES__ID' => 'ID',
	'SHOWMODULES__ACTION' => 'Aktion',
	'SHOWMODULES__ACTION_DELETE' => 'Löschen',
	'SHOWMODULES__ACTION_UNINSTALL' => 'Deinstallieren',
	'SHOWMODULES__ACTION_INSTALL' => 'Installieren',
	'SHOWMODULES__ACTION_UPDATE' => 'Updaten',

	// installModule
	'ERROR__INSTALLMODULE' => 'Fehler bei der Installation!',
	'INFO__INSTALLMODULE' => 'Modul installiert.',

	// updateModule
	'ERROR__UPDATEMODULE' => 'Fehler beim Update!',
	'INFO__UPDATEMODULE' => 'Modul upgedatet.',

	// uninstallModule
	'ERROR__UNINSTALLMODULE' => 'Fehler beim Deinstallieren!',
	'INFO__UNINSTALLMODULE' => 'Modul deinstalliert.',

	// deleteModule
	'ERROR__DELETEMODULE' => 'Fehler beim Löschen!',
	'INFO__DELETEMODULE' => 'Modul gelöscht.',

	// setModules
	'INFO__SETMODULES_SUCCESS' => 'Änderungen wurden erfolgreich gespeichert.',

	// render
	'INFO__RENDER_SUCCESS' => 'Rendern der Software erfolgreich.',
	'ERROR__RENDER' => 'Beim Rendern ist ein Fehler aufgetreten!',

	// showStyles
	'SHOWSTYLES__TITLE' => 'Styles',
	'SHOWSTYLES__H1' => 'TS_Admin | Styles verwalten',
	'SHOWSTYLES__INFOTEXT' => 'Hier siehst du alle Styles auf einen Blick und kannst sie aktivieren/deaktieren oder ganz löschen.',
	'SHOWSTYLES__MODNAME' => 'Stylename',
	'SHOWSTYLES__VERSION' => 'Version',
	'SHOWSTYLES__MODDESCRIPTION' => 'Beschreibung',
	'SHOWSTYLES__STATUS' => 'Status',
	'SHOWSTYLES__AUTHOR' => 'Autor',
	'SHOWSTYLES__SUBMIT' => 'Einstellungen speichern',
	'SHOWSTYLES__RESET' => 'Reset',
	'SHOWSTYLES__ID' => 'ID',
	'SHOWSTYLES__ACTION' => 'Aktion',
	'SHOWSTYLES__ACTION_DELETE' => 'Löschen',
	'SHOWSTYLES__ACTION_SETDEFAULT' => 'Als Standard',

	// setStyles
	'INFO__SETSTYLES_SUCCESS' => 'Änderungen gespeichert.',

	// setDefaultStyle
	'ERROR__SETDEFAULTSTYLE' => 'Beim Setzen des Standards ist ein Fehler aufgetreten.',
	'INFO__SETDEFAULTSTYLE' => 'Standard wurde gesetzt.',

	// deleteStyle
	'ERROR__DELETESTYLE' => 'Fehler beim Löschen!',
	'INFO__DELETESTYLE' => 'Style gelöscht.',

	// showTools
	'SHOWTOOLS__TITLE' => 'Optimieren',
	'SHOWTOOLS__H1' => 'TS_Admin | Optimieren',
	'SHOWTOOLS__INFOTEXT' => 'Hier kannst du mithilfe verschiedener Werkzeuge TSunic optimieren.',
	'SHOWTOOLS__DT_INITDATABASE' => 'Datenbank initialisieren',
	'SHOWTOOLS__DD_INITDATABASE' => 'Bevor TSunic verwendet werden kann, muss die Datenbank dafür vorbereitet werden und grundlegende Strukturen/Tabellen angelegt werden. Dies lässt sich einfach über dieses Tool erledigen.',
	'SHOWTOOLS__DT_RESETALL' => 'TSunic zurücksetzen',
	'SHOWTOOLS__DD_RESETALL' => 'Hier kann TSunic auf die "Werkseinstellungen" zurückgesetzt werden. Alle Daten gehen dabei verloren!',

	// showInitDatabase
	'SHOWINITDATABASE__TITLE' => 'Datenbank einrichten',
	'SHOWINITDATABASE__H1' => 'TS_Admin | Datenbank einrichten',
	'SHOWINITDATABASE__INFOTEXT' => 'TSunic benötigt bestimmte Tabellen, um Module zu verwalten. Diese Tabellen sollten spätestens jetzt zur Verfügung stehen.',
	'SHOWINITDATABASE__DONE' => 'Die benötigten Tabellen sind funktionstüchtig.',
	'SHOWINITDATABASE__ERROR' => 'Tabellen sind nicht vorhanden!',
	'SHOWINITDATABASE__ERROR_LINK' => 'Initialisierung erneut versuchen',

	// showResetAll
	'SHOWRESETALL__TITLE' => 'Alles zurücksetzen',
	'SHOWRESETALL__H1' => 'TS_Admin | Alles zurücksetzen',
	'SHOWRESETALL__INFOTEXT' => 'Mit diesem Tool kann man TSunic komplett zurücksetzen und alle Daten löschen (außer eventuelle Backups im Backup-Ordner). Diese Funktion sollte mit großer Vorsicht verwendet werden und niemals bei einem laufenden System, es sei denn, man möchte es zerstören.',
	'SHOWRESETALL__WARNING' => 'Mit einem Klick auf "SHOWRESETALL__RESETALL", werden alle Daten zerstört!!!',
	'SHOWRESETALL__RESETALL' => 'TSunic jetzt zurücksetzen',

	// resetAll
	'INFO__ALLRESET_SUCCESS' => 'TSunic wurde erfolgreich zurückgesetzt.',

	// showConfig
	'SHOWCONFIG__TITLE' => 'Einstellungen bearbeiten',
	'SHOWCONFIG__H1' => 'TS_Admin | Einstellungen bearbeiten',
	'SHOWCONFIG__INFOTEXT' => 'Verwalte hier die grundlegenden Einstellungen von TSunic.',
	'SHOWCONFIG__LEGEND_DATABASE' => 'Datenbank',
	'SHOWCONFIG__DB_CLASS' => 'Datenbank-Typ',
	'SHOWCONFIG__DB_CLASS_INFO' => 'Wähle hier den Typ deiner Datenbank aus.',
	'SHOWCONFIG__DB_HOST' => 'Host',
	'SHOWCONFIG__DB_HOST_INFO' => 'Der Host deiner Datenbank. Oftmals ist dieser "localhost"...',
	'SHOWCONFIG__DB_USER' => 'User',
	'SHOWCONFIG__DB_USER_INFO' => 'Der Benutzer deiner Datenbank.',
	'SHOWCONFIG__DB_PASS' => 'Passwort',
	'SHOWCONFIG__DB_PASS_INFO' => 'Das Passwort für deine Datenbank.',
	'SHOWCONFIG__DB_DATABASE' => 'Datenbank',
	'SHOWCONFIG__DB_DATABASE_INFO' => 'Der Name der Datenbank, in der die Daten gespeichert werden sollen.',
	'SHOWCONFIG__PREFFIX' => 'Preffix',
	'SHOWCONFIG__PREFFIX_INFO' => 'Dieses Preffix wird zu den Namen aller Tabellen von TSunic in der Datenbank hinzugefügt. Dies kann verhindern, dass TSunic mit anderer Software in Konflikt gerät und ermöglicht mehrere Instanzen mit einer einzigen Datenbank. Falls du nicht weißt, was du hier eintragen sollst, lasse das Feld einfach leer! Auf einem laufenden System sollte diese Einstellung nicht geändert werden...',
	'SHOWCONFIG__LEGEND_ENCRYPTION' => 'Verschlüsselung',
	'SHOWCONFIG__ENCRYPTION_CLASS' => 'Verschlüsselungstyp',
	'SHOWCONFIG__ENCRYPTION_CLASS_INFO' => 'Wähle hier den Verschlüsselungstyp für TSunic aus. Diese Einstellung sollte auf keinen Fall bei einem laufenden System geändert werden, da dies Datenverlust zu Folge haben kann/wird!',
	'SHOWCONFIG__ENCRYPTION_ALGORITHM' => 'Algorithmus',
	'SHOWCONFIG__ENCRYPTION_ALGORITHM_INFO' => 'Wähle einen Verschlüsselungsalgorithmus aus. Diese Einstellung sollte auf keinen Fall bei einem laufenden System geändert werden, da dies Datenverlust zu Folge haben kann/wird!',
	'SHOWCONFIG__ENCRYPTION_MODE' => 'Modus',
	'SHOWCONFIG__ENCRYPTION_MODE_INFO' => 'Wähle einen Verschlüsselungsmodus. Diese Einstellung sollte auf keinen Fall bei einem laufenden System geändert werden, da dies Datenverlust zu Folge haben kann/wird!',
	'SHOWCONFIG__SYSTEM_SECRET' => 'Systemgeheimnis',
	'SHOWCONFIG__SYSTEM_SECRET_INFO' => 'Dies ist ein geheimes Passwort, das für die Verschlüsselung verwendet wird und bei jedem System unterschiedlich sein sollte. Diese Einstellung sollte auf keinen Fall bei einem laufenden System geändert werden, da dies Datenverlust zu Folge haben kann/wird!',
	'SHOWCONFIG__LEGEND_OTHERS' => 'Sonstige Einstellungen',
	'SHOWCONFIG__DEFAULT_LANGUAGE' => 'Standard-Sprache',
	'SHOWCONFIG__DEFAULT_LANGUAGE_INFO' => 'Wähle eine Sprache aus, die das System standardmäßig verwenden soll.',
	'SHOWCONFIG__SYSTEM_EMAIL' => 'System-E-Mail',
	'SHOWCONFIG__SYSTEM_EMAIL_INFO' => 'Von dieser E-Mail-Adresse aus werden System-Nachrichten verschickt.',
	'SHOWCONFIG__SUBMIT' => 'Einstellungen speichern',
	'SHOWCONFIG__RESET' => 'Reset',
	'SHOWCONFIG__DEBUG_MODE' => 'Debug-Modus',
	'SHOWCONFIG__DEBUG_MODE_INFO' => 'Ist der Debug-Modus aktiviert, so wird beim Rendern der Software nur das Nötigste ersetzt und die Dateien behalten so ihre ursprünglichen Zeilenzahlen. Auf diese Weise vereinfacht sich die Fehlersuche (allerdings auf Kosten der Performance).',
	'SHOWCONFIG__NO' => 'Nein',
	'SHOWCONFIG__YES' => 'Ja',
	'SHOWCONFIG__EMAIL_ENABLED' => 'E-Mail aktiviert',
	'SHOWCONFIG__EMAIL_ENABLED_INFO' => 'Ist diese Einstellung deaktivert, so wird das System keine E-Mails versenden. Die IMAP-/POP3-Funktionen sind davon nicht betroffen.',

	'SHOWCONFIG__LEGEND_PATHS' => 'Verzeichnis-Pfade',
	'SHOWCONFIG__ROOT_FOLDER' => 'Root-Verzeichnis',
	'SHOWCONFIG__ROOT_FOLDER_INFO' => 'Absoluter Pfad zum Root-Verzeichnis von TSunic.',
	'SHOWCONFIG__DATA_FOLDER' => 'Data-Verzeichnis',
	'SHOWCONFIG__DATA_FOLDER_INFO' => 'Pfad zum Data-Verzeichnis relativ zum Root-Verzeichnis. Dieses Data-Verzeichnis enthält Dateien, auf die TSunic zwar zugreift, die aber nicht übers Web erreichbar sein müssen und somit zur erhöhten Sicherheit außerhalb des Webverzeichnisses liegen können/sollten.',
	'SHOWCONFIG__SYSTEM_ONLINE' => 'Ist System online?',
	'SHOWCONFIG__SYSTEM_ONLINE_INFO' => 'Über diese Einstellung kann das System vorübergehend offline genommen werden. Alle Zugriffe auf das System werden nach "offline.php" umgeleitet. Diese Einstellung wird auch während des Renderns kurz aktiviert.',
	'SHOWCONFIG__ALLOW_REGISTRATION' => 'Registrierung erlaubt?',
	'SHOWCONFIG__ALLOW_REGISTRATION_INFO' => 'Deaktiviere diese Einstellung, um die Registrierung neuer Mitglieder zu unterbinden. Mitglieder, die bereits registriert sind, können sich ganz normal weiter einloggen.',

	// showSystemCheck
	'SHOWSYSTEMCHECK__TITLE' => 'System überprüfen',
	'SHOWSYSTEMCHECK__H1' => 'TS_Admin | System überprüfen',
	'SHOWSYSTEMCHECK__INFOTEXT' => 'Kann TSunic auf diesem Server problemlos laufen? Könnte man etwas verbessern? Hier findest du Antworten.',
	'SHOWSYSTEMCHECK__FOLDER_RUNTIME' => 'Verzeichnis "runtime" beschreibbar?',
	'SHOWSYSTEMCHECK__FOLDER_RUNTIME_INFO' => 'In diesem Verzeichnis wird TSunic die Programmdateien kompilieren. Dafür muss es in dieses Verzeichnis schreiben können. Bitte setze über einen FTP-Browser deiner Wahl die Verzeichnisrechte auf 755!',
	'SHOWSYSTEMCHECK__FOLDER_FILES' => 'Verzeichnis "files" beschreibbar?',
	'SHOWSYSTEMCHECK__FOLDER_FILES_INFO' => 'In dieses Verzeichnis wird TSunic Bilder und andere Dateien speichern. Dafür braucht TSunic Schreibrechte für dieses Verzeichnis. Bitte setze über einen FTP-Browser deiner Wahl die Verzeichnisrechte auf 755!',
	'SHOWSYSTEMCHECK__PHPVERSION' => 'PHP-Version',
	'SHOWSYSTEMCHECK__PHPVERSION_INFO' => 'Zum Funktionieren braucht TSunic mindestens PHP Version 5.3.',
	'SHOWSYSTEMCHECK__IMAPFUNCTIONS' => 'IMAP-Funktionen installiert?',
	'SHOWSYSTEMCHECK__IMAPFUNCTIONS_INFO' => 'TSunic bietet die Möglichkeit, über IMAP/POP3 auf E-Mail-Accounts zuzugreifen. Dies ist allerdings nur möglich, wenn die IMAP-Funktionen auf dem Server installiert sind. Zwar können diese Möglichkeiten dann nicht ausgeschöpft werden, aber TSunic funktioniert auch ohne diese Funktionen.',
	'SHOWSYSTEMCHECK__FOLDER_DATA' => 'Verzeichnis "data" beschreibbar?',
	'SHOWSYSTEMCHECK__FOLDER_DATA_INFO' => 'Dieses Verzeichnis beinhaltet sämtliche Daten, auf die TSunic zwar zugreifen können muss, die aber nicht im öffentlichen Web liegen müssen/sollten. TSunic benötigt Schreibrechte für dieses Verzeichnis inklusive der Unterverzeichnisse. Bitte setze über einen FTP-Browser deiner Wahl die Verzeichnisrechte auf 755!',

	// pagenotfound
	'PAGENOTFOUND__TITLE' => 'Seite nicht gefunden',
	'PAGENOTFOUND__H1' => 'Seite nicht gefunden!',
	'PAGENOTFOUND__INFOTEXT' => 'Die angeforderte Seite konnte nicht gefunden werden!',

	// html
	'HTML__INSTALLATIONPROGRESS' => 'Installationsfortschritt',
	'HTML__INDEX' => 'Übersicht',
	'HTML__MODULES' => 'Module',
	'HTML__CONFIG' => 'Einstellungen',
	'HTML__STYLES' => 'Styles',
	'HTML__TOOL' => 'Tools',
	'HTML__LOGOUT' => 'Logout',
	'HTML__LOGIN' => 'Login',
	'HTML__INSTALLATION_NEXT' => 'Installation fortsetzen'
);
?>
