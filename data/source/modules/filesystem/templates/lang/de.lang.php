<!-- | LANGUAGE german -->
<?php
$lang = array(
    'NAME' => 'Filesystem Modul',

    // types
    'TYPE__DIRECTORY' => 'Verzeichnis',
    'TYPE__FILE' => 'Datei',
    'TYPE__IMAGE' => 'Datei',

    // tags
    'TAG__DIRECTORY__NAME' => 'Verzeichnisname',
    'TAG__DIRECTORY__NAME__DESCRIPTION' => 'Verzeichnisname',
    'TAG__DIRECTORY__PARENT' => 'Übergeordnetes Verzeichnis',
    'TAG__DIRECTORY__PARENT__DESCRIPTION' => 'Übergeordnetes Verzeichnis',
    'TAG__FILE__NAME' => 'Dateiname',
    'TAG__FILE__NAME__DESCRIPTION' => 'Dateiname',
    'TAG__FILE__PARENT' => 'Übergeordnetes Verzeichnis',
    'TAG__FILE__PARENT__DESCRIPTION' => 'Übergeordnetes Verzeichnis',
    'TAG__FILE__SIZE' => 'Dateigröße',
    'TAG__FILE__SIZE__DESCRIPTION' => 'Dateigröße',
    'TAG__FILE' => 'Datei',
    'TAG__FILE__DESCRIPTION' => 'Eine Datei',
    'TAG__IMAGE' => 'Bild',
    'TAG__IMAGE__DESCRIPTION' => 'Eine Bilddatei',
    'TAG__DIRECTORY' => 'Verzeichnis',
    'TAG__DIRECTORY__DESCRIPTION' => 'Ein Verzeichnis',

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

    // showIndex
    'SHOWINDEX__TITLE' => 'Verzeichnis anzeigen',
    'SHOWINDEX__H1' => 'Verzeichnis "#name#"',
    'SHOWINDEX__INFOTEXT' => 'Diese Seite zeigt dir die Unterverzeichnisse und Dateien in diesem Verzeichnis an.',
    'SHOWINDEX__TOSHOWCREATEDIRECTORY' => 'Neues Unterverzeichnis erstellen',
    'SHOWINDEX__TOSHOWCREATEFILE' => 'Neue Datei hochladen',
    'SHOWINDEX__TOSHOWEDITDIRECTORY' => 'Verzeichnis bearbeiten',
    'SHOWINDEX__NAME' => 'Name',
    'SHOWINDEX__PERMISSIONS' => 'Rechte',
    'SHOWINDEX__DATEOFCREATION' => 'Erstellungsdatum',
    'SHOWINDEX__DATEOFUPDATE' => 'Letzte Änderung',
    'SHOWINDEX__ACTION' => 'Aktion',
    'SHOWINDEX__DELETE' => 'Löschen',
    'SHOWINDEX__EDIT' => 'Umbennenen',
    'SHOWINDEX__TOMOVEFILE' => 'Verschieben',
    'SHOWINDEX__MOVEFILE__H1' => 'Datei verschieben',
    'SHOWINDEX__MOVEFILE__INFOTEXT' => 'Bitte wähle das Verzeichnis, in das die Datei verschoben werden soll. Um die Datei ins Root-Verzeichnis zu verschieben, wähle nichts aus.',
    'SHOWINDEX__TOMOVEDIRECTORY' => 'Verschieben',
    'SHOWINDEX__MOVEDIRECTORY__H1' => 'Verzeichnis verschieben',
    'SHOWINDEX__MOVEDIRECTORY__INFOTEXT' => 'Bitte wähle das Verzeichnis, in das das Verzeichnis verschoben werden soll. Um das Verzeichnis ins Root-Verzeichnis zu schieben, wähle nichts aus.',
    'SHOWINDEX__EMPTYDIR' => 'Das Verzeichnis ist leer.',

    // formDirectory
    'FORMDIRECTORY__LEGEND' => 'Verzeichnis',

    // showCreateDirectory
    'SHOWCREATEDIRECTORY__TITLE' => 'Neues Verzeichnis anlegen',
    'SHOWCREATEDIRECTORY__H1' => 'Neues Verzeichnis anlegen',
    'SHOWCREATEDIRECTORY__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWCREATEDIRECTORY__INFOTEXT' => 'Fülle das folgende Formular aus, um ein neues Verzeichnis anzulegen.',
    'SHOWCREATEDIRECTORY__SUBMIT' => 'Verzeichnis anlegen',
    'SHOWCREATEDIRECTORY__CANCEL' => 'Abbrechen',

    // createDirectory
    'CREATEDIRECTORY__SUCCESS' => 'Verzeichnis wurde angelegt.',
    'CREATEDIRECTORY__ERROR' => 'Verzeichnis konnte nicht angelegt werden!',
    'CREATEDIRECTORY__INVALIDVALUE' => 'Ungültige Eingabe!',

    // showEditDirectory
    'SHOWEDITDIRECTORY__TITLE' => 'Verzeichnis bearbeiten',
    'SHOWEDITDIRECTORY__H1' => 'Verzeichnis "#name#" bearbeiten',
    'SHOWEDITDIRECTORY__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWEDITDIRECTORY__INFOTEXT' => 'Über das folgende Formular kannst du das Verzeichnis bearbeiten',
    'SHOWEDITDIRECTORY__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITDIRECTORY__CANCEL' => 'Abbrechen',

    // editDirectory
    'EDITDIRECTORY__SUCCESS' => 'Änderungen wurden gespeichert.',
    'EDITDIRECTORY__ERROR' => 'Änderungen konnten nicht gespeichert werden!',
    'EDITDIRECTORY__INVALIDNAME' => 'Der Name ist ungültig!',
    'EDITDIRECTORY__INVALIDPARENT' => 'Das übergeordnete Verzeichnis ist ungültig!',

    // showDeleteDirectory
    'SHOWDELETEDIRECTORY__TITLE' => 'Verzeichnis löschen',
    'SHOWDELETEDIRECTORY__POPUP_DELETE_HEADER' => 'Verzeichnis "#name#" wirklich löschen?',
    'SHOWDELETEDIRECTORY__POPUP_DELETE_HEADER_JS' => 'Verzeichnis löschen?',
    'SHOWDELETEDIRECTORY__POPUP_DELETE_CONTENT' => 'Willst du das Verzeichnis wirklich endgültig löschen?',
    'SHOWDELETEDIRECTORY__POPUP_DELETE_YES' => 'Ja, löschen.',
    'SHOWDELETEDIRECTORY__POPUP_DELETE_NO' => 'Nein, abbrechen.',
    'SHOWDELETEDIRECTORY__NOTEMPTY' => 'Das Verzeichnis muss leer sein, bevor es gelöscht werden kann!',

    // deleteDirectory
    'DELETEDIRECTORY__SUCCESS' => 'Verzeichnis wurde gelöscht',
    'DELETEDIRECTORY__ERROR' => 'Verzeichnis konnte nicht gelöscht werden!',

    // formFile
    'FORMFILE__FILE' => 'Datei',
    'FORMFILE__LEGEND' => 'Datei',

    // showCreateFile
    'SHOWCREATEFILE__TITLE' => 'Neue Datei hochladen',
    'SHOWCREATEFILE__H1' => 'Neue Datei hochladen',
    'SHOWCREATEFILE__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWCREATEFILE__INFOTEXT' => 'Fülle das folgende Formular aus, um ein Datei hochzuladen.',
    'SHOWCREATEFILE__SUBMIT' => 'Datei hochladen',
    'SHOWCREATEFILE__CANCEL' => 'Abbrechen',

    // createFile
    'CREATEFILE__SUCCESS' => 'Datei wurde hochgeladen.',
    'CREATEFILE__ERROR' => 'Datei konnte nicht hochgeladen werden!',
    'CREATEFILE__INVALIDFILESIZE' => 'Die Datei ist zu groß!',
    'CREATEFILE__INVALIDQUOTA' => 'Der Upload dieser Datei würde das Speicherlimit überschreiten!',
    'CREATEFILE__INVALIDDIRECTORY' => 'Das Verzeichnis ist ungültig!',

    // showEditFile
    'SHOWEDITFILE__TITLE' => 'Datei bearbeiten',
    'SHOWEDITFILE__H1' => 'Datei "#name#" bearbeiten',
    'SHOWEDITFILE__TOPARENT' => 'Zurück zum Verzeichnis',
    'SHOWEDITFILE__INFOTEXT' => 'Über das folgende Formular kannst du die Datei umbennenen oder verschieben',
    'SHOWEDITFILE__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITFILE__CANCEL' => 'Abbrechen',

    // editFile
    'EDITFILE__SUCCESS' => 'Änderungen wurden gespeichert.',
    'EDITFILE__ERROR' => 'Änderungen konnten nicht gespeichert werden!',
    'EDITFILE__INVALIDNAME' => 'Der Name ist ungültig!',
    'EDITFILE__INVALIDPARENT' => 'Das Verzeichnis ist ungültig!',

    // showDeleteFile
    'SHOWDELETEFILE__TITLE' => 'Datei löschen',
    'SHOWDELETEFILE__POPUP_DELETE_HEADER' => 'Datei "#name#" wirklich löschen?',
    'SHOWDELETEFILE__POPUP_DELETE_HEADER_JS' => 'Datei löschen?',
    'SHOWDELETEFILE__POPUP_DELETE_CONTENT' => 'Willst du die Datei wirklich endgültig löschen?',
    'SHOWDELETEFILE__POPUP_DELETE_YES' => 'Ja, löschen.',
    'SHOWDELETEFILE__POPUP_DELETE_NO' => 'Nein, abbrechen.',

    // deleteFile
    'DELETEFILE__SUCCESS' => 'Datei wurde gelöscht',
    'DELETEFILE__ERROR' => 'Datei konnte nicht gelöscht werden!',

    /* ***************** navigation ******************** */

    '_HEADER_NAVIGATION__SHOWINDEX' => 'Dateisystem',
    '_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Dateisystem'
);
?>
