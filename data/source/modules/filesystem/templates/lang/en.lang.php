<!-- | LANGUAGE english -->
<?php
$lang = array(
    'NAME' => 'Filesystem module',

    // types
    'TYPE__FK_DIRECTORY' => 'Directory',
    'TYPE__FK_FILE' => 'File',

    // tags
    'TAG__DIRECTORY__NAME' => 'Directory name',
    'TAG__DIRECTORY__PARENT' => 'Parent directory',
    'TAG__FILE__NAME' => 'File name',
    'TAG__FILE__PARENT' => 'Containig directory',
    'TAG__FILE__SIZE' => 'File size',

    // special
    'CLASS__DIRECTORY__ROOTDIR' => 'Root directory',

    // config
    'CONFIG__MAXFILESIZE' => 'Max file size (Bytes)',
    'CONFIG__MAXFILESIZE__DESCRIPTION' => 'This defines the maximal filesize for files being uploaded.',
    'CONFIG__QUOTA' => 'Filesystem quota (Bytes)',
    'CONFIG__QUOTA__DESCRIPTION' => 'This quota limits the space for the filesystem of each user.',

    // access
    'ACCESS__USEWEBDAV' => 'Delete all users',
    'ACCESS__WEBDAV_DESCRIPTION' => 'Allow users to use webdav accessing their files',

    /* ***************** filesystem ******************** */

    // showFsDirectory
    'SHOWINDEX__TITLE' => 'Show directory',
    'SHOWINDEX__H1' => 'Directory "#name#"',
    'SHOWINDEX__INFOTEXT' => 'This page shows you the content of your filesystem directory.',
    'SHOWINDEX__TOSHOWCREATEDIRECTORY' => 'Create new directory',
    'SHOWINDEX__TOSHOWCREATEFILE' => 'Upload new file',
    'SHOWINDEX__TOSHOWEDITDIRECTORY' => 'Edit directory',
    'SHOWINDEX__NAME' => 'Name',
    'SHOWINDEX__PERMISSIONS' => 'Permissions',
    'SHOWINDEX__DATEOFCREATION' => 'Date of creation',
    'SHOWINDEX__DATEOFUPDATE' => 'Date of update',
    'SHOWINDEX__ACTION' => 'Action',
    'SHOWINDEX__DELETE' => 'Delete',
    'SHOWINDEX__EDIT' => 'Rename',

    // formFsDirectory
    'FORMDIRECTORY__NAME' => 'Name',
    'FORMDIRECTORY__NAME_PRESET' => 'Name of directory',
    'FORMDIRECTORY__LEGEND' => 'Directory',
    'FORMDIRECTORY__NAME_HELP' => 'Fill in a name for this directory.',
    'FORMDIRECTORY__PARENT' => 'Parent directory',
    'FORMDIRECTORY__PARENT_HELP' => 'Please choose a parent directory.',
    'FORMDIRECTORY__OPTION_ROOTDIR' => 'Root Directory',

    // showCreateFsDirectory
    'SHOWCREATEDIRECTORY__TITLE' => 'Create new directory',
    'SHOWCREATEDIRECTORY__H1' => 'Create new directory',
    'SHOWCREATEDIRECTORY__TOPARENT' => 'Back to directory',
    'SHOWCREATEDIRECTORY__INFOTEXT' => 'Fill in the following form to create a new filesystem directory.',
    'SHOWCREATEDIRECTORY__SUBMIT' => 'Create directory',
    'SHOWCREATEDIRECTORY__CANCEL' => 'Cancel',

    // createFsDirectory
    'CREATEDIRECTORY__SUCCESS' => 'Directory created.',
    'CREATEDIRECTORY__ERROR' => 'Directory could not be created!',
    'CREATEDIRECTORY__INVALIDVALUE' => 'Invalid value!',

    // showEditFsDirectory
    'SHOWEDITDIRECTORY__TITLE' => 'Edit directory',
    'SHOWEDITDIRECTORY__H1' => 'Edit directory "#name#"',
    'SHOWEDITDIRECTORY__TOPARENT' => 'Back to directory',
    'SHOWEDITDIRECTORY__INFOTEXT' => 'Via the following formular you can edit the directory.',
    'SHOWEDITDIRECTORY__SUBMIT' => 'Save changes',
    'SHOWEDITDIRECTORY__CANCEL' => 'Cancel',

    // editFsDirectory
    'EDITDIRECTORY__SUCCESS' => 'Changes has been saved.',
    'EDITDIRECTORY__ERROR' => 'Changes could not be saved!',
    'EDITDIRECTORY__INVALIDNAME' => 'The name is invalid!',
    'EDITDIRECTORY__INVALIDPARENT' => 'The parent directory is invalid!',

    // showDeleteFsDirectory
    'SHOWDELETEDIRECTORY__TITLE' => 'Delete directory',
    'SHOWDELETEDIRECTORY__H1' => 'Delete directory #name#?',
    'SHOWDELETEDIRECTORY__INFOTEXT' => 'Do you really want to delete this directory?',
    'SHOWDELETEDIRECTORY__SUBMIT' => 'Yes, delete.',
    'SHOWDELETEDIRECTORY__CANCEL' => 'No, cancel.',
    'SHOWDELETEDIRECTORY__NOTEMPTY' => 'The directory has to be empty before you can delete it!',

    // deleteFsDirectory
    'DELETEDIRECTORY__SUCCESS' => 'Directory deleted.',
    'DELETEDIRECTORY__ERROR' => 'Directory could not be deleted!',

    // formFsFile
    'FORMFILE__NAME' => 'Name',
    'FORMFILE__NAME_PRESET' => 'Name of file',
    'FORMFILE__NAME_HELP' => 'A name for this file.',
    'FORMFILE__FILE' => 'File',
    'FORMFILE__FILE_HELP' => 'Choose a file to upload to TSunic.',
    'FORMFILE__LEGEND' => 'File',
    'FORMFILE__DIRECTORY' => 'Directory of file',
    'FORMFILE__DIRECTORY_HELP' => 'Please choose a directory, this file is saved in.',
    'FORMFILE__OPTION_ROOTDIR' => 'Root Directory',

    // showCreateFsFile
    'SHOWCREATEFILE__TITLE' => 'Upload file',
    'SHOWCREATEFILE__H1' => 'Upload file',
    'SHOWCREATEFILE__TOPARENT' => 'Back to directory',
    'SHOWCREATEFILE__INFOTEXT' => 'Fill in the following form to upload a file to TSunic.',
    'SHOWCREATEFILE__SUBMIT' => 'Upload file',
    'SHOWCREATEFILE__CANCEL' => 'Cancel',

    // createFsFile
    'CREATEFILE__SUCCESS' => 'File uploaded.',
    'CREATEFILE__ERROR' => 'File could not be uploaded!',
    'CREATEFILE__INVALIDFILESIZE' => 'The file is to big!',
    'CREATEFILE__INVALIDQUOTA' => 'Uploading this file would exceed the filesystem quota!',
    'CREATEFILE__INVALIDDIRECTORY' => 'The directory is invalid!',

    // showEditFsFile
    'SHOWEDITFILE__TITLE' => 'Edit file',
    'SHOWEDITFILE__H1' => 'Edit file "#name#"',
    'SHOWEDITFILE__TOPARENT' => 'Back to directory',
    'SHOWEDITFILE__INFOTEXT' => 'Via the following formular you can rename or move the file.',
    'SHOWEDITFILE__SUBMIT' => 'Save changes',
    'SHOWEDITFILE__CANCEL' => 'Cancel',

    // editFsFile
    'EDITFILE__SUCCESS' => 'Changes has been saved.',
    'EDITFILE__ERROR' => 'Changes could not be saved!',
    'EDITFILE__INVALIDNAME' => 'The name is invalid!',
    'EDITFILE__INVALIDPARENT' => 'The directory is invalid!',

    // showDeleteFsFile
    'SHOWDELETEFILE__TITLE' => 'Delete file',
    'SHOWDELETEFILE__H1' => 'Delete file #name#?',
    'SHOWDELETEFILE__INFOTEXT' => 'Do you really want to delete this file?',
    'SHOWDELETEFILE__SUBMIT' => 'Yes, delete.',
    'SHOWDELETEFILE__CANCEL' => 'No, cancel.',

    // deleteFsFile
    'DELETEFILE__SUCCESS' => 'File deleted.',
    'DELETEFILE__ERROR' => 'File could not be deleted!',

    /* ***************** navigation ******************** */

    '_HEADER_NAVIGATION__SHOWINDEX' => 'Filesystem',
    '_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Filesystem'
);
?>
