<!-- | LANGUAGE english -->
<?php
$lang = array(
    'NAME' => 'Filesystem module',

    // special
    'CLASS__FSDIRECTORY__ROOTDIR' => 'Root directory',

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
    'SHOWINDEX__TOSHOWCREATEFSDIRECTORY' => 'Create new directory',
    'SHOWINDEX__TOSHOWCREATEFSFILE' => 'Upload new file',
    'SHOWINDEX__TOSHOWEDITFSDIRECTORY' => 'Edit directory',
    'SHOWINDEX__NAME' => 'Name',
    'SHOWINDEX__PERMISSIONS' => 'Permissions',
    'SHOWINDEX__DATEOFCREATION' => 'Date of creation',
    'SHOWINDEX__DATEOFUPDATE' => 'Date of update',
    'SHOWINDEX__ACTION' => 'Action',
    'SHOWINDEX__DELETE' => 'Delete',
    'SHOWINDEX__EDIT' => 'Rename/Move',

    // formFsDirectory
    'FORMFSDIRECTORY__NAME' => 'Name',
    'FORMFSDIRECTORY__NAME_PRESET' => 'Name of directory',
    'FORMFSDIRECTORY__LEGEND' => 'Directory',
    'FORMFSDIRECTORY__NAME_HELP' => 'Fill in a name for this directory.',
    'FORMFSDIRECTORY__PARENT' => 'Parent directory',
    'FORMFSDIRECTORY__PARENT_HELP' => 'Please choose a parent directory.',
    'FORMFSDIRECTORY__OPTION_ROOTDIR' => 'Root Directory',

    // showCreateFsDirectory
    'SHOWCREATEFSDIRECTORY__TITLE' => 'Create new directory',
    'SHOWCREATEFSDIRECTORY__H1' => 'Create new directory',
    'SHOWCREATEFSDIRECTORY__TOPARENT' => 'Back to directory',
    'SHOWCREATEFSDIRECTORY__INFOTEXT' => 'Fill in the following form to create a new filesystem directory.',
    'SHOWCREATEFSDIRECTORY__SUBMIT' => 'Create directory',
    'SHOWCREATEFSDIRECTORY__CANCEL' => 'Cancel',

    // createFsDirectory
    'CREATEFSDIRECTORY__SUCCESS' => 'Directory created.',
    'CREATEFSDIRECTORY__ERROR' => 'Directory could not be created!',
    'CREATEFSDIRECTORY__INVALIDNAME' => 'The name is invalid!',
    'CREATEFSDIRECTORY__INVALIDPARENT' => 'The parent directory is invalid!',

    // showEditFsDirectory
    'SHOWEDITFSDIRECTORY__TITLE' => 'Edit directory',
    'SHOWEDITFSDIRECTORY__H1' => 'Edit directory "#name#"',
    'SHOWEDITFSDIRECTORY__TOPARENT' => 'Back to directory',
    'SHOWEDITFSDIRECTORY__INFOTEXT' => 'Via the following formular you can edit the directory.',
    'SHOWEDITFSDIRECTORY__SUBMIT' => 'Save changes',
    'SHOWEDITFSDIRECTORY__CANCEL' => 'Cancel',

    // editFsDirectory
    'EDITFSDIRECTORY__SUCCESS' => 'Changes has been saved.',
    'EDITFSDIRECTORY__ERROR' => 'Changes could not be saved!',
    'EDITFSDIRECTORY__INVALIDNAME' => 'The name is invalid!',
    'EDITFSDIRECTORY__INVALIDPARENT' => 'The parent directory is invalid!',

    // showDeleteFsDirectory
    'SHOWDELETEFSDIRECTORY__TITLE' => 'Delete directory',
    'SHOWDELETEFSDIRECTORY__H1' => 'Delete directory #name#?',
    'SHOWDELETEFSDIRECTORY__INFOTEXT' => 'Do you really want to delete this directory?',
    'SHOWDELETEFSDIRECTORY__SUBMIT' => 'Yes, delete.',
    'SHOWDELETEFSDIRECTORY__CANCEL' => 'No, cancel.',
    'SHOWDELETEFSDIRECTORY__NOTEMPTY' => 'The directory has to be empty before you can delete it!',

    // deleteFsDirectory
    'DELETEFSDIRECTORY__SUCCESS' => 'Directory deleted.',
    'DELETEFSDIRECTORY__ERROR' => 'Directory could not be deleted!',

    // formFsFile
    'FORMFSFILE__NAME' => 'Name',
    'FORMFSFILE__NAME_PRESET' => 'Name of file',
    'FORMFSFILE__NAME_HELP' => 'A name for this file.',
    'FORMFSFILE__FILE' => 'File',
    'FORMFSFILE__FILE_HELP' => 'Choose a file to upload to TSunic.',
    'FORMFSFILE__LEGEND' => 'File',
    'FORMFSFILE__DIRECTORY' => 'Directory of file',
    'FORMFSFILE__DIRECTORY_HELP' => 'Please choose a directory, this file is saved in.',
    'FORMFSFILE__OPTION_ROOTDIR' => 'Root Directory',

    // showCreateFsFile
    'SHOWCREATEFSFILE__TITLE' => 'Upload file',
    'SHOWCREATEFSFILE__H1' => 'Upload file',
    'SHOWCREATEFSFILE__TOPARENT' => 'Back to directory',
    'SHOWCREATEFSFILE__INFOTEXT' => 'Fill in the following form to upload a file to TSunic.',
    'SHOWCREATEFSFILE__SUBMIT' => 'Upload file',
    'SHOWCREATEFSFILE__CANCEL' => 'Cancel',

    // createFsFile
    'CREATEFSFILE__SUCCESS' => 'File uploaded.',
    'CREATEFSFILE__ERROR' => 'File could not be uploaded!',
    'CREATEFSFILE__INVALIDFILESIZE' => 'The file is to big!',
    'CREATEFSFILE__INVALIDQUOTA' => 'Uploading this file would exceed the filesystem quota!',
    'CREATEFSFILE__INVALIDDIRECTORY' => 'The directory is invalid!',

    // showEditFsFile
    'SHOWEDITFSFILE__TITLE' => 'Edit file',
    'SHOWEDITFSFILE__H1' => 'Edit file "#name#"',
    'SHOWEDITFSFILE__TOPARENT' => 'Back to directory',
    'SHOWEDITFSFILE__INFOTEXT' => 'Via the following formular you can rename or move the file.',
    'SHOWEDITFSFILE__SUBMIT' => 'Save changes',
    'SHOWEDITFSFILE__CANCEL' => 'Cancel',

    // editFsFile
    'EDITFSFILE__SUCCESS' => 'Changes has been saved.',
    'EDITFSFILE__ERROR' => 'Changes could not be saved!',
    'EDITFSFILE__INVALIDNAME' => 'The name is invalid!',
    'EDITFSFILE__INVALIDPARENT' => 'The directory is invalid!',

    // showDeleteFsFile
    'SHOWDELETEFSFILE__TITLE' => 'Delete file',
    'SHOWDELETEFSFILE__H1' => 'Delete file #name#?',
    'SHOWDELETEFSFILE__INFOTEXT' => 'Do you really want to delete this file?',
    'SHOWDELETEFSFILE__SUBMIT' => 'Yes, delete.',
    'SHOWDELETEFSFILE__CANCEL' => 'No, cancel.',

    // deleteFsFile
    'DELETEFSFILE__SUCCESS' => 'File deleted.',
    'DELETEFSFILE__ERROR' => 'File could not be deleted!',

    /* ***************** navigation ******************** */

    '_HEADER_NAVIGATION__SHOWINDEX' => 'Filesystem',
    '_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Filesystem'
);
?>
