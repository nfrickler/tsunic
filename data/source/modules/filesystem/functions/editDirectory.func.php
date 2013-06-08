<!-- | FUNCTION edit filesystem directory -->
<?php
function $$$editDirectory () {
    global $TSunic;

    // get input
    $id = $TSunic->Input->uint('$$$formDirectory__id');

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{EDITDIRECTORY__INVALIDVALUE} ('.$fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // get Directory object
    $Dir = $TSunic->get('$$$Directory', $id);

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Dir->addeditBit($values['fk_tag'], $values['fk_bit'], $values['value'])) {
	    $TSunic->Log->alert('error', '{EDITDIRECTORY__ERROR}');
	    $TSunic->redirect('back');
	}
    }

    // success
    $TSunic->Log->alert('info', '{EDITDIRECTORY__SUCCESS}');
    $TSunic->redirect('$$$showIndex', array('$$$id' => $Dir->getInfo('id')));
    return true;
}
?>
