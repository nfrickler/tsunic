<!-- | FUNCTION edit tag data -->
<?php
function $$$editTag () {
    global $TSunic;

    // get input
    $id = $TSunic->Temp->getPost('$$$formTag__id');
    $fk_type = $TSunic->Temp->getPost('$$$formTag__fk_type');
    $name = $TSunic->Temp->getPost('$$$formTag__name');
    $title = $TSunic->Temp->getPost('$$$formTag__title');
    $description = $TSunic->Temp->getPost('$$$formTag__description');

    // get Tag object
    $Tag = $TSunic->get('$$$Tag', $id);

    // validate input
    if (!$Tag->isValidFkType($fk_type)) {
	$TSunic->Log->alert('error', '{EDITTAG__INVALIDFKTAG}');
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

    // edit selection
    if ($Tag->edit($fk_type, $name, $title, $description)) {
	// success
	$TSunic->Log->alert('info', '{EDITTAG__SUCCESS}');
	$TSunic->redirect('$$$showTag', array('$$$id' => $id));
	return true;
    }

    // add error message and redirect back
    $TSunic->Log->alert('error', '{EDITTAG__ERROR}');
    $TSunic->redirect('back');
    return true;
}
?>
