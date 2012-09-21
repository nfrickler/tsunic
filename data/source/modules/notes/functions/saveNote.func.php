<!-- | FUNCTION save note -->
<?php
function $$$saveNote () {
    global $TSunic;

    // get params
    $id_fsfile = $TSunic->Temp->getPost('$$$showNote__id');
    $filename = $TSunic->Temp->getPost('$$$showNote__filename');
    $content = $TSunic->Temp->getPost('$$$showNote__content');

    // get FsFile object
    $FsFile = $TSunic->get('$usersystem$FsFile', $id_fsfile);

    // validate filename
    if (!$FsFile->isValidName($filename)) {
	$TSunic->Log->alert('error', "{SAVENOTE__ERROR_INVALIDFILENAME}");
	$TSunic->redirect('$$$showNote', array('$$$id' => $FsFile->getInfo('id')));
    }

    // create new file
    if (!$id_fsfile) {
	if ($FsFile->create(0, $filename, $content)) {
	    $TSunic->Log->alert('info', "{SAVENOTE__SUCCESS_CREATE}");
	} else {
	    $TSunic->Log->alert('error', "{SAVENOTE__ERROR_CREATE}");
	}
	$TSunic->redirect('$$$showNote', array('$$$id' => $FsFile->getInfo('id')));
    }

    // set name
    if (!$FsFile->edit($filename)) {
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
