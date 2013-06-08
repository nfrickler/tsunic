<!-- | FUNCTION edit Queue object -->
<?php
function $$$editQueue () {
    global $TSunic;

    // get profile object
    $id = $TSunic->Input->uint('$$$formQueue__id');
    $Queue = $TSunic->get('$$$Queue', $id);

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{EDITQUEUE__INVALIDVALUE} ('.$fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // is valid Queue?
    if (!$Queue->isValid()) {
	// add error message and redirect back
	$TSunic->Log->alert('error', '{EDITQUEUE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Queue->addeditBit($values['fk_tag'], $values['fk_bit'], $values['value'])) {
	    $TSunic->Log->alert('error', '{EDITQUEUE__ERROR}');
	    $TSunic->redirect('back');
	}
    }

    // success
    $TSunic->Log->alert('info', '{EDITQUEUE__SUCCESS}');
    $TSunic->redirect('$$$showQueue', array('$$$id' => $Queue->getInfo('id')));
    return true;
}
?>
