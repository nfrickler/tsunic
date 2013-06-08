<!-- | FUNCTION create filesystem directory -->
<?php
function $$$createDirectory () {
    global $TSunic;

    // get input
    $preset_parent = $TSunic->Input->uint('$$$formDirectory__parent_preset');

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // add preset_parent
    $form[] = array(
	'fk_tag' => 'DIRECTORY__PARENT',
	'fk_bit' => 0,
	'value' => $preset_parent
    );

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{CREATEDIRECTORY__INVALIDVALUE} ('.$fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // create directory object
    $Dir = $TSunic->get('$$$Directory', 0);

    // create directory
    if (!$Dir->create()) {
	$TSunic->Log->alert('error', '{CREATEDIRECTORY__ERROR}');
	$TSunic->redirect('back');
    }

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Dir->addeditBit($values['fk_tag'], $values['fk_bit'], $values['value'])) {
	    $TSunic->Log->alert('error', '{CREATEDIRECTORY__ERROR}');
	    $TSunic->redirect('back');
	}
    }

    // success
    $TSunic->Log->alert('info', '{CREATEDIRECTORY__SUCCESS}');
    $TSunic->redirect('$$$showIndex', array('$$$id' => $preset_parent));
    return true;
}
?>
