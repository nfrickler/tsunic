<!-- | LANGUAGE german -->
<?php
$lang = array(
    'NAME' => 'Filesystem Modul',

    // special
    'CLASS__FSDIRECTORY__ROOTDIR' => 'Root Verzeichnis',

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
    'SHOWINDEX__TOSHOWCREATEFSDIRECTORY' => 'Neues Verzeichnis erstellen',
    'SHOWINDEX__TOSHOWCREATEFSFILE' => 'Neue Datei hochladen',
    'SHOWINDEX__TOSHOWEDITFSDIRECTORY' => 'Verzeichnis bearbeiten',
    'SHOWINDEX__NAME' => 'Name',
    'SHOWINDEX__PERMISSIONS' => 'Rechte',
    'SHOWINDEX__DATEOFCREATION' => 'Erstellungsdatum',
    'SHOWINDEX__DATEOFUPDATE' => 'Letzte Änderung',
    'SHOWINDEX__ACTION' => 'Aktion',
    'SHOWINDEX__DELETE' => 'Löschen',
    'SHOWINDEX__EDIT' => 'Umbennenen/Verschieben',

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

    '_HEADER_NAVIGATION__SHOWINDEX' => 'Dateisystem',
    '_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Dateisystem'
);
?>
