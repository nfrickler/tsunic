<!-- | FUNCTION edit selection data -->
<?php
function $$$editSelection () {
    global $TSunic;

    // get input
    $id = $TSunic->Temp->getPost('$$$formSelection__id');
    $fk_tag = $TSunic->Temp->getPost('$$$formSelection__fk_tag');
    $name = $TSunic->Temp->getPost('$$$formSelection__name');
    $description = $TSunic->Temp->getPost('$$$formSelection__description');

    // get Selection object
    $Selection = $TSunic->get('$$$Selection', $id);

    // validate input
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

    // edit selection
    if ($Selection->edit($fk_tag, $name, $description)) {
	// success
	$TSunic->Log->alert('info', '{EDITSELECTION__SUCCESS}');
	$TSunic->redirect('$$$showSelection', array('$$$id' => $id));
	return true;
    }

    // add error message and redirect back
    $TSunic->Log->alert('error', '{EDITSELECTION__ERROR}');
    $TSunic->redirect('back');
    return true;
}
?>
