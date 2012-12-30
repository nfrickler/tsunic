<!-- | FUNCTION create tag -->
<?php
function $$$createTag () {
    global $TSunic;

    // get input
    $fk_type = $TSunic->Temp->getPost('$$$formTag__fk_type');
    $name = $TSunic->Temp->getPost('$$$formTag__name');
    $title = $TSunic->Temp->getPost('$$$formTag__title');
    $description = $TSunic->Temp->getPost('$$$formTag__description');

    // create selection object
    $Tag = $TSunic->get('$$$Tag');

    // valid input?
    if (!$Tag->isValidFkType($fk_type)) {
	$TSunic->Log->alert('error', '{EDITTAG__INVALIDFKTYPE}');
	$TSunic->redirect('back');
    }
    if (!$Tag->isValidName($name)) {
	$TSunic->Log->alert('error', '{EDITTAG__INVALIDNAME}');
	$TSunic->redirect('back');
    }
    if (!$Tag->isValidTitle($title)) {
	$TSunic->Log->alert('error', '{EDITTAG__INVALIDTITLE}');
	$TSunic->redirect('back');
    }
    if (!$Tag->isValidDescription($description)) {
	$TSunic->Log->alert('error', '{EDITTAG__INVALIDFKDESCRIPTION}');
	$TSunic->redirect('back');
    }

    // create selection
    $return = $Tag->create($fk_type, $name, $title, $description);

    // check, if create successful
    if (!$return) {
	// add error message and redirect back
	$TSunic->Log->alert('error', '{CREATETAG__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{CREATETAG__SUCCESS}');
    $TSunic->redirect('$$$showTags');
    return true;
}
?>
