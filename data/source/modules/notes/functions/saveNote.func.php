<!-- | FUNCTION save Note -->
<?php
function $$$saveNote () {
    global $TSunic;

    // get params
    $id = $TSunic->Input->uint('$$$showNote__id');
    $path = $TSunic->Input->postRaw('$$$showNote__filename');
    $content = $TSunic->Input->postRaw('$$$showNote__content');

    // get Note object
    $Note = $TSunic->get('$$$Note', $id);

    // save
    if (!$Note->saveNote($path, $content)) {
	$TSunic->Log->alert('error', "{SAVENOTE__ERROR}");
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{SAVENOTE__SUCCESS}');
    $TSunic->redirect('$$$showNote', array('$$$id' => $Note->getInfo('id')));

    return true;
}
?>
