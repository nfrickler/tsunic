<!-- | LANGUAGE german -->
<?php
$lang = array(
    'NAME' => 'Bits&Bytes Modul',

    // types
    'TYPE__INT' => 'Ganzzahl',
    'TYPE__DOUBLE' => 'Gleitpunktzahl',
    'TYPE__STRING' => 'Einzeiliger Text',
    'TYPE__TEXT' => 'Mehrzeiliger Text',
    'TYPE__SELECTION' => 'Mehrfachauswahl',
    'TYPE__RADIO' => 'Einfachauswahl',
    'TYPE__FK' => 'Irgendein Objekt',

    // showBit
    'SHOWBIT__TOEDITOBJECT' => 'Ändern',
    'SHOWBIT__TODELETEOBJECT' => 'Löschen',
    'SHOWBIT__TOUNLINKTAG' => 'Tag entfernen',

    // formBit
    'FORMBIT__PLEASECHOOSE' => '---Bitte wählen---',
    'FORMBIT__FK_DISABLED' => 'Kann nur in der Profilansicht geändert werden.',

    // showTags
    'SHOWTAGS__TITLE' => 'Tags',
    'SHOWTAGS__H1' => 'Tags',
    'SHOWTAGS__INFOTEXT' => 'Dies sind alle verfügbaren Tags. Du kannst neue hinzufügen und bestehende bearbeiten oder löschen.',
    'SHOWTAGS__TOCREATETAG' => 'Neuen Tag erstellen',
    'SHOWTAGS__NAME' => 'Name',
    'SHOWTAGS__TAGTITLE' => 'Titel',
    'SHOWTAGS__DESCRIPTION' => 'Beschreibung',
    'SHOWTAGS__ACTIONS' => 'Aktionen',
    'SHOWTAGS__TODELETE' => 'Löschen',

    // showCreateTag
    'SHOWCREATETAG__TITLE' => 'Tags',
    'SHOWCREATETAG__H1' => 'Tags',
    'SHOWCREATETAG__TOSHOWTAGS' => 'Zur Tag-Übersicht',
    'SHOWCREATETAG__INFOTEXT' => 'Über das folgenden Formular kannst du einen neuen Tag erstellen.',
    'SHOWCREATETAG__SUBMIT' => 'Neuen Tag erstellen',
    'SHOWCREATETAG__CANCEL' => 'Abbrechen',

    // showEditTag
    'SHOWEDITTAG__TITLE' => 'Tags',
    'SHOWEDITTAG__H1' => 'Tags',
    'SHOWEDITTAG__TOSHOWTAGS' => 'Zur Tag-Übersicht',
    'SHOWEDITTAG__INFOTEXT' => 'Über das folgenden Formular kannst du den Tag bearbeiten.',
    'SHOWEDITTAG__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITTAG__CANCEL' => 'Abbrechen',

    'SHOWEDITTAG__H_SELECTIONS' => 'Auswahlmöglichkeiten',
    'SHOWEDITTAG__TOCREATESELECTION' => 'Neue Auswahlmöglichkeit hinzufügen',
    'SHOWEDITTAG__SELECTIONS__INFOTEXT' => 'Verwalte hier die Auswahlmöglichkeiten für dieses Feld.',

    // formTag
    'FORMTAG__LEGEND' => 'Tag',
    'FORMTAG__FK_TYPE' => 'Typ',
    'FORMTAG__FK_TYPE_PLEASECHOOSE' => '---Bitte wählen---',
    'FORMTAG__FK_TYPE_HELP' => 'Bitte wählen einen Typ für diesen Tag.',
    'FORMTAG__NAME' => 'Name',
    'FORMTAG__NAME_PRESET' => 'Eindeutiger Name',
    'FORMTAG__NAME_HELP' => 'Eindeutiger Name für diesen Tag.',
    'FORMTAG__TITLE' => 'Titel',
    'FORMTAG__TITLE_PRESET' => 'Titel',
    'FORMTAG__TITLE_HELP' => 'Der Anzeigename für diesen Tag',
    'FORMTAG__DESCRIPTION' => 'Beschreibung',
    'FORMTAG__DESCRIPTION_PRESET' => 'Beschreibung',
    'FORMTAG__DESCRIPTION_HELP' => 'Optionale Beschreibung für diesen Tag.',

    // createTag
    'CREATETAG__INVALIDFKTYPE' => 'Ungültiger Typ!',
    'CREATETAG__INVALIDNAME' => 'Ungültiger Name!',
    'CREATETAG__INVALIDTITLE' => 'Ungültiger Titel!',
    'CREATETAG__INVALIDDESCRIPTION' => 'Ungültige Beschreibung!',
    'CREATETAG__SUCCESS' => 'Änderungen wurden gespeichert.',
    'CREATETAG__ERROR' => 'Ein Fehler ist aufgetreten!',

    // editTag
    'EDITTAG__INVALIDFKTYPE' => 'Ungültiger Typ!',
    'EDITTAG__INVALIDNAME' => 'Ungültiger Name!',
    'EDITTAG__INVALIDTITLE' => 'Ungültiger Titel!',
    'EDITTAG__INVALIDDESCRIPTION' => 'Ungültige Beschreibung!',
    'EDITTAG__SUCCESS' => 'Änderungen wurden gespeichert.',
    'EDITTAG__ERROR' => 'Ein Fehler ist aufgetreten!',

    // deleteTag
    'SHOWDELETETAG__TITLE' => 'Tag löschen',
    'SHOWDELETETAG__POPUP_DELETE_HEADER' => 'Tag "#name#" löschen?',
    'SHOWDELETETAG__POPUP_DELETE_CONTENT' => 'Willst du diesen Tag wirklich löschen?',
    'SHOWDELETETAG__POPUP_DELETE_YES' => 'Ja, Tag löschen',
    'SHOWDELETETAG__POPUP_DELETE_NO' => 'Nein, abbrechen',

    // deleteTag
    'DELETETAG__ERROR' => 'Ein Fehler ist aufgetreten!',
    'DELETETAG__SUCCESS' => 'Der Tag wurde gelöscht.',

    // showListSelections
    'SHOWLISTSELECTIONS__NOSELECTIONS' => 'Keine Auswahlmöglichkeiten verfügbar.',
    'SHOWLISTSELECTIONS__NAME' => 'Name',
    'SHOWLISTSELECTIONS__DESCRIPTION' => 'Beschreibung',
    'SHOWLISTSELECTIONS__ACTIONS' => 'Aktionen',

    // showDeleteSelection
    'SHOWDELETESELECTION__TITLE' => 'Auswahlmöglichkeit löschen?',
    'SHOWDELETESELECTION__POPUP_DELETE_HEADER_JS' => 'Auswahlmöglichkeit löschen?',
    'SHOWDELETESELECTION__POPUP_DELETE_HEADER' => 'Auswahlmöglichkeit "#name#" löschen?',
    'SHOWDELETESELECTION__POPUP_DELETE_CONTENT' => 'Möchtest du diese Auswahlmöglichkeit wirklich löschen?',
    'SHOWDELETESELECTION__POPUP_DELETE_YES' => 'Ja, löschen',
    'SHOWDELETESELECTION__POPUP_DELETE_NO' => 'Nein, abbrechen',

    // showCreateSelection
    'SHOWCREATESELECTION__TITLE' => 'Auswahlmöglichkeit hinzufügen',
    'SHOWCREATESELECTION__H1' => 'Auswahlmöglichkeit hinzufügen',
    'SHOWCREATESELECTION__TOBACKTOTAG' => 'Zurück zum Tag',
    'SHOWCREATESELECTION__INFOTEXT' => 'Hier kannst du eine neue Auswahlmöglichkeit erstellen.',
    'SHOWCREATESELECTION__SUBMIT' => 'Auswahlmöglichkeit erstellen',
    'SHOWCREATESELECTION__CANCEL' => 'Abbrechen',

    // showEditSelection
    'SHOWEDITSELECTION__TITLE' => 'Auswahlmöglichkeit bearbeiten',
    'SHOWEDITSELECTION__H1' => 'Auswahlmöglichkeit bearbeiten',
    'SHOWEDITSELECTION__TOBACKTOTAG' => 'Zurück zum Tag',
    'SHOWEDITSELECTION__INFOTEXT' => 'Hier kannst du die Auswahlmöglichkeit bearbeiten.',
    'SHOWEDITSELECTION__SUBMIT' => 'Änderungen speichern',
    'SHOWEDITSELECTION__CANCEL' => 'Abbrechen',

    // formSelection
    'FORMSELECTION__LEGEND' => 'Auswahlmöglichkeit',
    'FORMSELECTION__FK_TAG' => 'Tag',
    'FORMSELECTION__FK_TAG_PLEASECHOOSE' => '---Bitte wählen---',
    'FORMSELECTION__FK_TAG_HELP' => 'Wähle den Tag aus, zu dem diese Auswahlmöglichkeit gehört.',
    'FORMSELECTION__NAME' => 'Name',
    'FORMSELECTION__NAME_PRESET' => 'Name',
    'FORMSELECTION__NAME_HELP' => 'Name dieser Auswahlmöglichkeit',
    'FORMSELECTION__DESCRIPTION' => 'Beschreibung',
    'FORMSELECTION__DESCRIPTION_PRESET' => 'Beschreibung',
    'FORMSELECTION__DESCRIPTION_HELP' => 'Optionale Beschreibung dieser Auswahlmöglichkeit',

    // createSelection
    'CREATESELECTION__INVALIDFKTAG' => 'Ungültiger Tag ausgewählt!',
    'CREATESELECTION__INVALIDNAME' => 'Ungültiger Name!',
    'CREATESELECTION__INVALIDDESCRIPTION' => 'Ungültige Beschreibung!',
    'CREATESELECTION__ERROR' => 'Ein Fehler ist aufgetreten!',
    'CREATESELECTION__SUCCESS' => 'Auswahlmöglichkeit wurde hinzugefügt.',

    // editSelection
    'EDITSELECTION__INVALIDFKTAG' => 'Ungültiger Tag ausgewählt!',
    'EDITSELECTION__INVALIDNAME' => 'Ungültiger Name!',
    'EDITSELECTION__INVALIDDESCRIPTION' => 'Ungültige Beschreibung!',
    'EDITSELECTION__ERROR' => 'Ein Fehler ist aufgetreten!',
    'EDITSELECTION__SUCCESS' => 'Änderungen gespeichert.',

    // showAddTag
    'SHOWADDTAG__TITLE' => 'Tag hinzufügen',
    'SHOWADDTAG__H1' => 'Tag hinzufügen',
    'SHOWADDTAG__INFOTEXT' => 'Tag zum Profil hinzufügen.',
    'SHOWADDTAG__SUBMIT' => 'Tag hinzufügen',
    'SHOWADDTAG__CANCEL' => 'Abbrechen',

    // formAddTag
    'FORMADDTAG__LEGEND' => 'Tag hinzufügen',
    'FORMADDTAG__FK_TAG' => 'Tag',
    'FORMADDTAG__FK_TAG_HELP' => 'Bitte wähle einen Tag, den du dem Profil hinzufügen willst.',
    'FORMADDTAG__FK_TAG_PLEASECHOOSE' => '---Bitte auswählen---',

    // addTag
    'ADDTAG__INVALIDFKTYPE' => 'Ungültiger Tag',
    'ADDTAG__ERROR' => 'Es ist ein Fehler aufgetreten',
    'ADDTAG__SUCCESS' => 'Tag erfolgreich hinzugefügt',

    // showDeleteObject
    'SHOWDELETEOBJECT__TITLE' => 'Objekt löschen?',
    'SHOWDELETEOBJECT__POPUP_DELETE_HEADER_JS' => 'Objekt löschen?',
    'SHOWDELETEOBJECT__POPUP_DELETE_HEADER' => 'Objekt "#name#" löschen?',
    'SHOWDELETEOBJECT__POPUP_DELETE_CONTENT' => 'Möchtest du diese Objekt wirklich löschen?',
    'SHOWDELETEOBJECT__POPUP_DELETE_YES' => 'Ja, löschen',
    'SHOWDELETEOBJECT__POPUP_DELETE_NO' => 'Nein, abbrechen',
    'SHOWDELETEOBJECT__ERROR' => 'Ein Fehler ist aufgetreten!',

    // deleteObject
    'DELETEOBJECT__ERROR' => 'Objekt konnte nicht gelöscht werden!',
    'DELETEOBJECT__SUCCESS' => 'Objekt gelöscht.',

    // unlinkTag
    'UNLINKTAG__SUCCESS' => 'Tag entfernt',
    'UNLINKTAG__ERROR' => 'Tag konnte nicht entfernt werden!',

    // showChooseObject
    'SHOWCHOOSEOBJECT__TITLE' => 'Objekt auswählen',
    'SHOWCHOOSEOBJECT__H1' => 'Objekt auswählen',
    'SHOWCHOOSEOBJECT__INFOTEXT' => 'Bite wähle ein Objekt aus der Liste aus.',
    'SHOWCHOOSEOBJECT__SUBMIT' => 'Auswahl speichern',
    'SHOWCHOOSEOBJECT__CANCEL' => 'Abbrechen',

    // formChooseObject
    'FORMCHOOSEOBJECT__LEGEND' => 'Bitte wähle ein Objekt aus.',


    // chooseObject
    'CHOOSEOBJECT__SUCCESS' => 'Auswahl gespeichert.',
    'CHOOSEOBJECT__ERROR' => 'Auswahl konnte nicht gespeichert werden!',

    // navigation
    '_SYSTEM_NAVIGATION__TOSHOWTAGS' => 'Tag-Liste'
);
?>
