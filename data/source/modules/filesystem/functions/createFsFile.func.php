<!-- | FUNCTION create filesystem file -->
<?php
function $$$createFsFile () {
    global $TSunic;

    // get input
    $fk_directory = $TSunic->Temp->getPost('$$$formFsFile__directory');

    // create file object
    $File = $TSunic->get('$$$FsFile', 0);

    // validate input
    if (!$File->isValidFilesize($_FILES['$$$formFsFile__file']['size'])) {
	$TSunic->Log->alert('error', '{CREATEFSFILE__INVALIDFILESIZE}');
	$TSunic->redirect('back');
    }
    if (!$File->isValidQuota($_FILES['$$$formFsFile__file']['size'])) {
	$TSunic->Log->alert('error', '{CREATEFSFILE__INVALIDQUOTA}');
	$TSunic->redirect('back');
    }
    if (!$File->isValidDirectory($fk_directory)) {
	$TSunic->Log->alert('error', '{CREATEFSFILE__INVALIDDIRECTORY}');
	$TSunic->redirect('back');
    }

    // create file
    $return = $File->createByUpload($_FILES['$$$formFsFile__file'], $fk_directory);

    // check, if create successful
    if ($return) {
	$TSunic->Log->alert('info', '{CREATEFSFILE__SUCCESS}');
	$TSunic->redirect('$$$showIndex', array('$$$id' => $File->getInfo('fk_directory')));
	return true;
    }

    // add error-message and redirect back
    $TSunic->Log->alert('error', '{CREATEFSFILE__ERROR}');
    $TSunic->redirect('back');
    return true;
}
?>
