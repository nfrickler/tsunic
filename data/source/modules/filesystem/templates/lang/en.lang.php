<!-- | LANGUAGE english -->
<?php
$lang = array(
    'NAME' => 'Filesystem module',

    // types
    'TYPE__DIRECTORY' => 'Directory',
    'TYPE__FILE' => 'File',
    'TYPE__IMAGE' => 'Image',

    // tags
    'TAG__DIRECTORY__NAME' => 'Directory name',
    'TAG__DIRECTORY__NAME__DESCRIPTION' => 'Name of directory',
    'TAG__DIRECTORY__PARENT' => 'Parent directory',
    'TAG__DIRECTORY__PARENT__DESCRIPTION' => 'Parent directory',
    'TAG__FILE__NAME' => 'File name',
    'TAG__FILE__NAMEDESCRIPTION' => 'File name',
    'TAG__FILE__PARENT' => 'Containig directory',
    'TAG__FILE__DESCRIPTION' => 'Containig directory',
    'TAG__FILE__SIZE' => 'File size',
    'TAG__FILE__SIZE__DESCRIPTION' => 'File size',
    'TAG__FILE' => 'File',
    'TAG__FILE__DESCRIPTION' => 'File',
    'TAG__IMAGE' => 'Image',
    'TAG__IMAGE__DESCRIPTION' => 'An image file',
    'TAG__DIRECTORY' => 'Directory',
    'TAG__DIRECTORY__DESCRIPTION' => 'A directory',

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

    // showIndex
    'SHOWINDEX__TITLE' => 'Show directory',
    'SHOWINDEX__H1' => 'Directory "#name#"',
    'SHOWINDEX__INFOTEXT' => 'This page shows you the content of your filesystem directory.',
    'SHOWINDEX__TOSHOWCREATEDIRECTORY' => 'Create new subdirectory',
    'SHOWINDEX__TOSHOWCREATEFILE' => 'Upload new file',
    'SHOWINDEX__TOSHOWEDITDIRECTORY' => 'Edit directory',
    'SHOWINDEX__NAME' => 'Name',
    'SHOWINDEX__PERMISSIONS' => 'Permissions',
    'SHOWINDEX__DATEOFCREATION' => 'Date of creation',
    'SHOWINDEX__DATEOFUPDATE' => 'Date of update',
    'SHOWINDEX__ACTION' => 'Action',
    'SHOWINDEX__DELETE' => 'Delete',
    'SHOWINDEX__EDIT' => 'Rename',
    'SHOWINDEX__TOMOVEFILE' => 'Move',
    'SHOWINDEX__MOVEFILE__H1' => 'Move file',
    'SHOWINDEX__MOVEFILE__INFOTEXT' => 'Choose directory to move file to. To move it to root directory, choose nothing.',
    'SHOWINDEX__TOMOVEDIRECTORY' => 'Move',
    'SHOWINDEX__MOVEDIRECTORY__H1' => 'Move directory',
    'SHOWINDEX__MOVEDIRECTORY__INFOTEXT' => 'Choose directoy to move directory into. To move it to root directory, choose nothing.',
    'SHOWINDEX__EMPTYDIR' => 'The directory is empty.',

    // formDirectory
    'FORMDIRECTORY__LEGEND' => 'Directory',

    // showCreateDirectory
    'SHOWCREATEDIRECTORY__TITLE' => 'Create new directory',
    'SHOWCREATEDIRECTORY__H1' => 'Create new directory',
    'SHOWCREATEDIRECTORY__TOPARENT' => 'Back to directory',
    'SHOWCREATEDIRECTORY__INFOTEXT' => 'Fill in the following form to create a new filesystem directory.',
    'SHOWCREATEDIRECTORY__SUBMIT' => 'Create directory',
    'SHOWCREATEDIRECTORY__CANCEL' => 'Cancel',

    // createDirectory
    'CREATEDIRECTORY__SUCCESS' => 'Directory created.',
    'CREATEDIRECTORY__ERROR' => 'Directory could not be created!',
    'CREATEDIRECTORY__INVALIDVALUE' => 'Invalid value!',

    // showEditDirectory
    'SHOWEDITDIRECTORY__TITLE' => 'Edit directory',
    'SHOWEDITDIRECTORY__H1' => 'Edit directory "#name#"',
    'SHOWEDITDIRECTORY__TOPARENT' => 'Back to directory',
    'SHOWEDITDIRECTORY__INFOTEXT' => 'Via the following formular you can edit the directory.',
    'SHOWEDITDIRECTORY__SUBMIT' => 'Save changes',
    'SHOWEDITDIRECTORY__CANCEL' => 'Cancel',

    // editDirectory
    'EDITDIRECTORY__SUCCESS' => 'Changes has been saved.',
    'EDITDIRECTORY__ERROR' => 'Changes could not be saved!',
    'EDITDIRECTORY__INVALIDNAME' => 'The name is invalid!',
    'EDITDIRECTORY__INVALIDPARENT' => 'The parent directory is invalid!',

    // showDeleteDirectory
    'SHOWDELETEDIRECTORY__TITLE' => 'Delete directory',
    'SHOWDELETEDIRECTORY__POPUP_DELETE_HEADER' => 'Delete directory  "#name#"?',
    'SHOWDELETEDIRECTORY__POPUP_DELETE_HEADER_JS' => 'Delete directory?',
    'SHOWDELETEDIRECTORY__POPUP_DELETE_CONTENT' => 'Do you really want to delete this directory?',
    'SHOWDELETEDIRECTORY__POPUP_DELETE_YES' => 'Yes, delete.',
    'SHOWDELETEDIRECTORY__POPUP_DELETE_NO' => 'No, cancel.',
    'SHOWDELETEDIRECTORY__NOTEMPTY' => 'The directory has to be empty before you can delete it!',

    // deleteDirectory
    'DELETEDIRECTORY__SUCCESS' => 'Directory deleted.',
    'DELETEDIRECTORY__ERROR' => 'Directory could not be deleted!',

    // formFile
    'FORMFILE__FILE' => 'File',
    'FORMFILE__LEGEND' => 'File',

    // showCreateFile
    'SHOWCREATEFILE__TITLE' => 'Upload file',
    'SHOWCREATEFILE__H1' => 'Upload file',
    'SHOWCREATEFILE__TOPARENT' => 'Back to directory',
    'SHOWCREATEFILE__INFOTEXT' => 'Fill in the following form to upload a file to TSunic.',
    'SHOWCREATEFILE__SUBMIT' => 'Upload file',
    'SHOWCREATEFILE__CANCEL' => 'Cancel',

    // createFile
    'CREATEFILE__SUCCESS' => 'File uploaded.',
    'CREATEFILE__ERROR' => 'File could not be uploaded!',
    'CREATEFILE__INVALIDFILESIZE' => 'The file is to big!',
    'CREATEFILE__INVALIDQUOTA' => 'Uploading this file would exceed the filesystem quota!',
    'CREATEFILE__INVALIDDIRECTORY' => 'The directory is invalid!',

    // showEditFile
    'SHOWEDITFILE__TITLE' => 'Edit file',
    'SHOWEDITFILE__H1' => 'Edit file "#name#"',
    'SHOWEDITFILE__TOPARENT' => 'Back to directory',
    'SHOWEDITFILE__INFOTEXT' => 'Via the following formular you can rename or move the file.',
    'SHOWEDITFILE__SUBMIT' => 'Save changes',
    'SHOWEDITFILE__CANCEL' => 'Cancel',

    // editFile
    'EDITFILE__SUCCESS' => 'Changes has been saved.',
    'EDITFILE__ERROR' => 'Changes could not be saved!',
    'EDITFILE__INVALIDNAME' => 'The name is invalid!',
    'EDITFILE__INVALIDPARENT' => 'The directory is invalid!',

    // showDeleteFile
    'SHOWDELETEFILE__TITLE' => 'Delete file',
    'SHOWDELETEFILE__POPUP_DELETE_HEADER' => 'Delete file "#name#"?',
    'SHOWDELETEFILE__POPUP_DELETE_HEADER_JS' => 'Delete file?',
    'SHOWDELETEFILE__POPUP_DELETE_CONTENT' => 'Do you really want to delete this file?',
    'SHOWDELETEFILE__POPUP_DELETE_YES' => 'Yes, delete.',
    'SHOWDELETEFILE__POPUP_DELETE_NO' => 'No, cancel.',

    // deleteFile
    'DELETEFILE__SUCCESS' => 'File deleted.',
    'DELETEFILE__ERROR' => 'File could not be deleted!',

    /* ***************** navigation ******************** */

    '_HEADER_NAVIGATION__SHOWINDEX' => 'Filesystem',
    '_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Filesystem'
);
?>
