<!-- | LANGUAGE english -->
<?php
$lang = array(
    'NAME' => 'Bits&Bytes module',

    // types
    'TYPE__INT' => 'Integer',
    'TYPE__DOUBLE' => 'Floating point',
    'TYPE__STRING' => 'String',
    'TYPE__TEXT' => 'Multiline Text',
    'TYPE__SELECTION' => 'Multiple selection',
    'TYPE__RADIO' => 'Single selection',
    'TYPE__FK' => 'Any object',

    // formBit
    'FORMBIT__PLEASECHOOSE' => '---Choose please---',

    // showTags
    'SHOWTAGS__TITLE' => 'Tags',
    'SHOWTAGS__H1' => 'Tags',
    'SHOWTAGS__INFOTEXT' => 'This are all available tags. You can add, edit and delete them.',
    'SHOWTAGS__TOCREATETAG' => 'Create new tag',
    'SHOWTAGS__NAME' => 'Name',
    'SHOWTAGS__TAGTITLE' => 'Title',
    'SHOWTAGS__DESCRIPTION' => 'Description',
    'SHOWTAGS__ACTIONS' => 'Actions',
    'SHOWTAGS__TODELETE' => 'Delete',

    // showCreateTag
    'SHOWCREATETAG__TITLE' => 'Create tag',
    'SHOWCREATETAG__H1' => 'Create tag',
    'SHOWCREATETAG__TOSHOWTAGS' => 'Back to Tag summary',
    'SHOWCREATETAG__INFOTEXT' => 'Create a new tag via the following form.',
    'SHOWCREATETAG__SUBMIT' => 'Create new tag',
    'SHOWCREATETAG__CANCEL' => 'Cancel',

    // showEditTag
    'SHOWEDITTAG__TITLE' => 'Edit tag',
    'SHOWEDITTAG__H1' => 'Edit tag',
    'SHOWEDITTAG__TOSHOWTAGS' => 'Back to Tag summary',
    'SHOWEDITTAG__INFOTEXT' => 'Edit the tag via the following form.',
    'SHOWEDITTAG__SUBMIT' => 'Save changes',
    'SHOWEDITTAG__CANCEL' => 'Cancel',

    'SHOWEDITTAG__H_SELECTIONS' => 'Options',
    'SHOWEDITTAG__TOCREATESELECTION' => 'Add new option',
    'SHOWEDITTAG__SELECTIONS__INFOTEXT' => 'Administrate the options for this selection or radio field.',

    // formTag
    'FORMTAG__LEGEND' => 'Tag',
    'FORMTAG__FK_TYPE' => 'Type',
    'FORMTAG__FK_TYPE_PLEASECHOOSE' => '---Choose please---',
    'FORMTAG__FK_TYPE_HELP' => 'Please choose a type for this tag.',
    'FORMTAG__NAME' => 'Name',
    'FORMTAG__NAME_PRESET' => 'Unique name',
    'FORMTAG__NAME_HELP' => 'Unique name of this tag.',
    'FORMTAG__TITLE' => 'Title',
    'FORMTAG__TITLE_PRESET' => 'Title',
    'FORMTAG__TITLE_HELP' => 'A name how this tag should be called.',
    'FORMTAG__DESCRIPTION' => 'Description',
    'FORMTAG__DESCRIPTION_PRESET' => 'Description',
    'FORMTAG__DESCRIPTION_HELP' => 'Optional description for this tag',

    // createTag
    'CREATETAG__INVALIDFKTYPE' => 'Invalid type!',
    'CREATETAG__INVALIDNAME' => 'Invalid name!',
    'CREATETAG__INVALIDTITLE' => 'Invalid title!',
    'CREATETAG__INVALIDDESCRIPTION' => 'Invalid description!',
    'CREATETAG__SUCCESS' => 'Changes has been saved.',
    'CREATETAG__ERROR' => 'An error occurred!',

    // editTag
    'EDITTAG__INVALIDFKTYPE' => 'Invalid type!',
    'EDITTAG__INVALIDNAME' => 'Invalid name!',
    'EDITTAG__INVALIDTITLE' => 'Invalid title!',
    'EDITTAG__INVALIDDESCRIPTION' => 'Invalid description!',
    'EDITTAG__SUCCESS' => 'Changes has been saved.',
    'EDITTAG__ERROR' => 'An error occurred!',

    // deleteTag
    'SHOWDELETETAG__TITLE' => 'Delete tag',
    'SHOWDELETETAG__POPUP_DELETE_HEADER' => 'Delete tag "#name#"?',
    'SHOWDELETETAG__POPUP_DELETE_CONTENT' => 'Do you really want to delete this tag?',
    'SHOWDELETETAG__POPUP_DELETE_YES' => 'Yes, delete tag',
    'SHOWDELETETAG__POPUP_DELETE_NO' => 'No, cancel',

    // deleteTag
    'DELETETAG__ERROR' => 'An error occurred!',
    'DELETETAG__SUCCESS' => 'Tag has been deleted.',

    // showListSelections
    'SHOWLISTSELECTIONS__NOSELECTIONS' => 'No options available.',
    'SHOWLISTSELECTIONS__NAME' => 'Name',
    'SHOWLISTSELECTIONS__DESCRIPTION' => 'Description',
    'SHOWLISTSELECTIONS__ACTIONS' => 'Actions',

    // showDeleteSelection
    'SHOWDELETESELECTION__TITLE' => 'Delete option?',
    'SHOWDELETESELECTION__POPUP_DELETE_HEADER_JS' => 'Delete this option?',
    'SHOWDELETESELECTION__POPUP_DELETE_HEADER' => 'Delete option "#name#"?',
    'SHOWDELETESELECTION__POPUP_DELETE_CONTENT' => 'Do you really want to delete this option?',
    'SHOWDELETESELECTION__POPUP_DELETE_YES' => 'Yes, delete',
    'SHOWDELETESELECTION__POPUP_DELETE_NO' => 'No, cancel',

    // showCreateSelection
    'SHOWCREATESELECTION__TITLE' => 'Create selection',
    'SHOWCREATESELECTION__H1' => 'Create selection',
    'SHOWCREATESELECTION__TOBACKTOTAG' => 'Back to tag',
    'SHOWCREATESELECTION__INFOTEXT' => 'Create a new option via the following form.',
    'SHOWCREATESELECTION__SUBMIT' => 'Create selection',
    'SHOWCREATESELECTION__CANCEL' => 'Cancel',

    // showEditSelection
    'SHOWEDITSELECTION__TITLE' => 'Edit selection',
    'SHOWEDITSELECTION__H1' => 'Edit selection',
    'SHOWEDITSELECTION__TOBACKTOTAG' => 'Back to tag',
    'SHOWEDITSELECTION__INFOTEXT' => 'Edit this option via the following form.',
    'SHOWEDITSELECTION__SUBMIT' => 'Save changes',
    'SHOWEDITSELECTION__CANCEL' => 'Cancel',

    // formSelection
    'FORMSELECTION__LEGEND' => 'Option',
    'FORMSELECTION__FK_TAG' => 'Tag',
    'FORMSELECTION__FK_TAG_PLEASECHOOSE' => '---Choose please---',
    'FORMSELECTION__FK_TAG_HELP' => 'Select the selection/radio tag this option shall belong to.',
    'FORMSELECTION__NAME' => 'Name',
    'FORMSELECTION__NAME_PRESET' => 'Name',
    'FORMSELECTION__NAME_HELP' => 'Name of this option',
    'FORMSELECTION__DESCRIPTION' => 'Description',
    'FORMSELECTION__DESCRIPTION_PRESET' => 'Description',
    'FORMSELECTION__DESCRIPTION_HELP' => 'Optional description of this option',

    // createSelection
    'CREATESELECTION__INVALIDFKTAG' => 'Invalid tag selected!',
    'CREATESELECTION__INVALIDNAME' => 'Invalid name!',
    'CREATESELECTION__INVALIDDESCRIPTION' => 'Invalid description!',
    'CREATESELECTION__ERROR' => 'An error occurred!',
    'CREATESELECTION__SUCCESS' => 'Option has been added.',

    // editSelection
    'EDITSELECTION__INVALIDFKTAG' => 'Invalid tag selected!',
    'EDITSELECTION__INVALIDNAME' => 'Invalid name!',
    'EDITSELECTION__INVALIDDESCRIPTION' => 'Invalid description!',
    'EDITSELECTION__ERROR' => 'An error occurred!',
    'EDITSELECTION__SUCCESS' => 'Changes saved.',

    // showAddTag
    'SHOWADDTAG__TITLE' => 'Add tag to profile',
    'SHOWADDTAG__H1' => 'Add tag to profile',
    'SHOWADDTAG__INFOTEXT' => 'Add a tag to profile.',
    'SHOWADDTAG__SUBMIT' => 'Add tag',
    'SHOWADDTAG__CANCEL' => 'Cancel',

    // formAddTag
    'FORMADDTAG__LEGEND' => 'Add tag',
    'FORMADDTAG__FK_TAG' => 'Tag',
    'FORMADDTAG__FK_TAG_HELP' => 'Please choose a tag to add to this profile.',
    'FORMADDTAG__FK_TAG_PLEASECHOOSE' => '---Please choose---',

    // addTag
    'ADDTAG__INVALIDFKTYPE' => 'Invalid tag',
    'ADDTAG__ERROR' => 'An error occurred',
    'ADDTAG__SUCCESS' => 'Tag added to profile',

    // navigation
    '_SYSTEM_NAVIGATION__TOSHOWTAGS' => 'List tags'
);
?>
