<!-- | FUNCTION create selection -->
<?php
function $$$createSelection () {
    global $TSunic;

    // get input
    $fk_tag = $TSunic->Temp->getPost('$$$formSelection__fk_tag');
    $name = $TSunic->Temp->getPost('$$$formSelection__name');
    $description = $TSunic->Temp->getPost('$$$formSelection__description');

    // create selection object
    $Selection = $TSunic->get('$$$Selection');

    if (!$Selection->isValidFkTag($fk_tag)) {
	$TSunic->Log->alert('error', '{EDITSELECTION__INVALIDFKTAG}');
	$TSunic->redirect('back');
    }
    if (!$Selection->isValidName($name)) {
	$TSunic->Log->alert('error', '{EDITSELECTION__INVALIDNAME}');
	$TSunic->redirect('back');
    }
    if (!$Selection->isValidDescription($description)) {
	$TSunic->Log->alert('error', '{EDITSELECTION__INVALIDFKDESCRIPTION}');
	$TSunic->redirect('back');
    }

    // create selection
    $return = $Selection->create($fk_tag, $name, $description);

    // check, if create successful
    if (!$return) {
	// add error-message and redirect back
	$TSunic->Log->alert('error', '{CREATESELECTION__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{CREATESELECTION__SUCCESS}');
    $TSunic->redirect('$$$showSelection', array('$$$id' => $Selection->getInfo('id')));
    return true;
}
?>
