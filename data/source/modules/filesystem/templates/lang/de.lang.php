<!-- | LANGUAGE german -->
<?php
$lang = array(
    'NAME' => 'Filesystem Modul',

    // types
    'TYPE__FK_DIRECTORY' => 'Verzeichnis',
    'TYPE__FK_FILE' => 'Datei',

    // tags
    'TAG__DIRECTORY__NAME' => 'Verzeichnisname',
    'TAG__DIRECTORY__PARENT' => 'Übergeordnetes Verzeichnis',
    'TAG__FILE__NAME' => 'Dateiname',
    'TAG__FILE__PARENT' => 'Übergeordnetes Verzeichnis',
    'TAG__FILE__SIZE' => 'Dateigröße',

    // special
    'CLASS__DIRECTORY__ROOTDIR' => 'Root Verzeichnis',

    // config
    'CONFIG__MAXFILESIZE' => 'Maximale Dateigröße (Bytes)',
    'CONFIG__MAXFILESIZE__DESCRIPTION' => 'Dies legt die maximal erlaubte Dateigröße für Dateien zum Hochladen fest.',
    'CONFIG__QUOTA' => 'Speicherplatz (Bytes)',
    'CONFIG__QUOTA__DESCRIPTION' => 'Dieser Wert in Bytes begrenzt das jedem Nutzer zur Verfügung stehende Speichervolumen.',

    // access
    'ACCESS__USEWEBDAV' => 'webDAV nutzen',
    'ACCESS__USEWEBDAV_DESCRIPTION' => 'Ermöglicht es Nutzern, webdav zu verwenden, um auf ihre Dateien zuzugreifen.',

    /* ***************** filesystem ******************** */

    // showFsDirectory
    'SHOWINDEX__TITLE' => 'Verzeichnis anzeigen',
    'SHOWINDEX__H1' => 'Verzeichnis "#name#"',
    'SHOWINDEX__INFOTEXT' => 'Diese Seite zeigt dir den Inhalt des Verzeichnisses.',
    'SHOWINDEX__TOSHOWCREATEDIRECTORY' => 'Neues Verzeichnis erstellen',
    'SHOWINDEX__TOSHOWCREATEFILE' => 'Neue Datei hochladen',
    'SHOWINDEX__TOSHOWEDITDIRECTORY' => 'Verzeichnis bearbeiten',
    'SHOWINDEX__NAME' => 'Name',
    'SHOWINDEX__PERMISSIONS' => 'Rechte',
    'SHOWINDEX__DATEOFCREATION' => 'Erstellungsdatum',
    'SHOWINDEX__DATEOFUPDATE' => 'Letzte Änderung',
    'SHOWINDEX__ACTION' => 'Aktion',
    'SHOWINDEX__DELETE' => 'Löschen',
    'SHOWINDEX__EDIT' => 'Umbennenen',

    // formFsDirectory
    'FORMDIRECTORY__NAME' => 'Name',
    'FORMDIRECTORY__NAME_PRESET' => 'Verzeichnisname',
    'FORMDIRECTORY__LEGEND' => 'Verzeichnis',
    'FORMDIRECTORY__NAME_HELP' => 'Lege einen Namen für das Verzeichnis fest.',
    'FORMDIRECTORY__PARENT' => 'Übergeordnetes Verzeichnis',
    'FORMDIRECTORY__PARENT_HELP' => 'Wähle ein übergeordnetes Verzeichnis.',
    'FORMDIRECTORY__OPTION_ROOTDIR' => 'Root Verzeichnis',

    // showCreateFsDirectory
    'SHOWCREATEDIRECTORY__TITLE' => 'Neues Verzeichnis anlegen',
    'SHOWCREATEDIRECTORY__H1' => 'Neues Verzeichnis anlegen',
    'SHOWCREATEDIRECTORY__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWCREATEDIRECTORY__INFOTEXT' => 'Fülle das folgende Formular aus, um ein neues Verzeichnis anzulegen.',
    'SHOWCREATEDIRECTORY__SUBMIT' => 'Verzeichnis anlegen',
    'SHOWCREATEDIRECTORY__CANCEL' => 'Abbrechen',

    // createFsDirectory
    'CREATEDIRECTORY__SUCCESS' => 'Verzeichnis wurde angelegt.',
    'CREATEDIRECTORY__ERROR' => 'Verzeichnis konnte nicht angelegt werden!',
    'CREATEDIRECTORY__INVALIDVALUE' => 'Ungültige Eingabe!',

    // showEditFsDirectory
    'SHOWEDITDIRECTORY__TITLE' => 'Verzeichnis bearbeiten',
    'SHOWEDITDIRECTORY__H1' => 'Verzeichnis "#name#" bearbeiten',
    'SHOWEDITDIRECTORY__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWEDITDIRECTORY__INFOTEXT' => 'Über das folgende Formular kannst du das Verzeichnis bearbeiten',
    'SHOWEDITDIRECTORY__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITDIRECTORY__CANCEL' => 'Abbrechen',

    // editFsDirectory
    'EDITDIRECTORY__SUCCESS' => 'Änderungen wurden gespeichert.',
    'EDITDIRECTORY__ERROR' => 'Änderungen konnten nicht gespeichert werden!',
    'EDITDIRECTORY__INVALIDNAME' => 'Der Name ist ungültig!',
    'EDITDIRECTORY__INVALIDPARENT' => 'Das übergeordnete Verzeichnis ist ungültig!',

    // showDeleteFsDirectory
    'SHOWDELETEDIRECTORY__TITLE' => 'Verzeichnis löschen',
    'SHOWDELETEDIRECTORY__H1' => 'Verzeichnis #name# löschen?',
    'SHOWDELETEDIRECTORY__INFOTEXT' => 'Willst du dieses Verzeichnis wirklich löschen?',
    'SHOWDELETEDIRECTORY__SUBMIT' => 'Ja, löschen.',
    'SHOWDELETEDIRECTORY__CANCEL' => 'Nein, abbrechen.',
    'SHOWDELETEDIRECTORY__NOTEMPTY' => 'Das Verzeichnis muss leer sein, bevor es gelöscht werden kann!',

    // deleteFsDirectory
    'DELETEDIRECTORY__SUCCESS' => 'Verzeichnis wurde gelöscht',
    'DELETEDIRECTORY__ERROR' => 'Verzeichnis konnte nicht gelöscht werden!',

    // formFsFile
    'FORMFILE__NAME' => 'Name',
    'FORMFILE__NAME_PRESET' => 'Name der Datei',
    'FORMFILE__NAME_HELP' => 'Ein frei wählbarer Name für diese Datei.',
    'FORMFILE__FILE' => 'Datei',
    'FORMFILE__FILE_HELP' => 'Wähle eine Datei aus, die du hochladen willst.',
    'FORMFILE__LEGEND' => 'Datei',
    'FORMFILE__DIRECTORY' => 'Verzeichnis der Datei',
    'FORMFILE__DIRECTORY_HELP' => 'Verzeichnis, in dem die Datei gespeichert ist.',
    'FORMFILE__OPTION_ROOTDIR' => 'Root Verzeichnis',

    // showCreateFsFile
    'SHOWCREATEFILE__TITLE' => 'Neue Datei hochladen',
    'SHOWCREATEFILE__H1' => 'Neue Datei hochladen',
    'SHOWCREATEFILE__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWCREATEFILE__INFOTEXT' => 'Fülle das folgende Formular aus, um ein Datei hochzuladen.',
    'SHOWCREATEFILE__SUBMIT' => 'Datei hochladen',
    'SHOWCREATEFILE__CANCEL' => 'Abbrechen',

    // createFsFile
    'CREATEFILE__SUCCESS' => 'Datei wurde hochgeladen.',
    'CREATEFILE__ERROR' => 'Datei konnte nicht hochgeladen werden!',
    'CREATEFILE__INVALIDFILESIZE' => 'Die Datei ist zu groß!',
    'CREATEFILE__INVALIDQUOTA' => 'Der Upload dieser Datei würde das Speicherlimit überschreiten!',
    'CREATEFILE__INVALIDDIRECTORY' => 'Das Verzeichnis ist ungültig!',

    // showEditFsFile
    'SHOWEDITFILE__TITLE' => 'Datei bearbeiten',
    'SHOWEDITFILE__H1' => 'Datei "#name#" bearbeiten',
    'SHOWEDITFILE__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWEDITFILE__INFOTEXT' => 'Über das folgende Formular kannst du die Datei umbennenen oder verschieben',
    'SHOWEDITFILE__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITFILE__CANCEL' => 'Abbrechen',

    // editFsFile
    'EDITFILE__SUCCESS' => 'Änderungen wurden gespeichert.',
    'EDITFILE__ERROR' => 'Änderungen konnten nicht gespeichert werden!',
    'EDITFILE__INVALIDNAME' => 'Der Name ist ungültig!',
    'EDITFILE__INVALIDPARENT' => 'Das Verzeichnis ist ungültig!',

    // showDeleteFsFile
    'SHOWDELETEFILE__TITLE' => 'Datei löschen',
    'SHOWDELETEFILE__H1' => 'Datei #name# löschen?',
    'SHOWDELETEFILE__INFOTEXT' => 'Willst du dieses Datei wirklich löschen?',
    'SHOWDELETEFILE__SUBMIT' => 'Ja, löschen.',
    'SHOWDELETEFILE__CANCEL' => 'Nein, abbrechen.',

    // deleteFsFile
    'DELETEFILE__SUCCESS' => 'Datei wurde gelöscht',
    'DELETEFILE__ERROR' => 'Datei konnte nicht gelöscht werden!',

    /* ***************** navigation ******************** */

    '_HEADER_NAVIGATION__SHOWINDEX' => 'Dateisystem',
    '_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Dateisystem'
);
?>
