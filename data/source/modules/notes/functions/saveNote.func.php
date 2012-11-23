<!-- | FUNCTION save note -->
<?php
function $$$saveNote () {
    global $TSunic;

    // get params
    $id_fsfile = $TSunic->Temp->getPost('$$$showNote__id');
    $filename = $TSunic->Temp->getPost('$$$showNote__filename');
    $content = $TSunic->Temp->getPost('$$$showNote__content');

    // get FsFile and FsDirectory object
    $FsFile = $TSunic->get('$filesystem$FsFile', $id_fsfile);

    // split filename into dir and file
    $filename_file = $filename;
    $filename_dir = "";
    if (strstr($filename, "/")) {
	$filename_file = substr(strrchr($filename, '/'), 1);
	$filename_dir = substr($filename, 0, (strlen($filename)-strlen($filename_file)-1));
    }

    // get FsDir
    $FsDir = $FsFile->path2dir($filename_dir);
    if (!$FsDir) {
	$TSunic->Log->alert('error', "{SAVENOTE__ERROR_INVALIDFILENAMEDIR}");
	$TSunic->redirect('$$$showNote', array('$$$id' => $FsFile->getInfo('id')));
    }

    // validate filename
    if (!$FsFile->isValidName($filename_file)) {
	$TSunic->Log->alert('error', "{SAVENOTE__ERROR_INVALIDFILENAME}");
	$TSunic->redirect('$$$showNote', array('$$$id' => $FsFile->getInfo('id')));
    }

    // create new file
    if (!$id_fsfile) {
	if ($FsFile->create($FsDir->getInfo('id'), $filename_file, $content)) {
	    $TSunic->Log->alert('info', "{SAVENOTE__SUCCESS_CREATE}");
	} else {
	    $TSunic->Log->alert('error', "{SAVENOTE__ERROR_CREATE}");
	}
	$TSunic->redirect('$$$showNote', array('$$$id' => $FsFile->getInfo('id')));
    }

    // set name
    if (!$FsFile->edit($filename_file, $FsDir->getInfo('id'))) {
	$TSunic->Log->alert('error', "{SAVENOTE__ERROR_SETFILENAME}");
	$TSunic->redirect('$$$showNote', array('$$$id' => $FsFile->getInfo('id')));
    }
    if (!$FsFile->setContent($content)) {
	$TSunic->Log->alert('error', "{SAVENOTE__ERROR_SETCONTENT}");
	$TSunic->redirect('$$$showNote', array('$$$id' => $FsFile->getInfo('id')));
    }

    // success
    $TSunic->Log->alert('info', '{SAVENOTE__SUCCESS}');
    $TSunic->redirect('$$$showNote', array('$$$id' => $FsFile->getInfo('id')));

    return true;
}
?>
