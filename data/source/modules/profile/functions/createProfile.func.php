<!-- | FUNCTION create profile -->
<?php
function $$$createProfile () {
    global $TSunic;

    // get all posts
    $posts = $TSunic->Temp->getPost(true);

    // get all fk_tags, fk_bits and values
    $fk_tags = array();
    $fk_bits = array();
    $values = array();
    foreach ($posts as $index => $value) {
	$cache = explode('__', $index);
	if (count($cache) != 4 or $cache[1] != 'formBit') continue;

	// get values
	switch ($cache[2]) {
	    case 'fk_tag':
		$fk_tags[$cache[3]] = $value;
		break;
	    case 'fk_bit':
		$fk_bits[$cache[3]] = $value;
		break;
	    case 'value':
		$values[$cache[3]] = $value;
		break;
	    default:
		// skip
		break;
	}
    }

    // validate input
    foreach ($values as $index => $value) {
	$Tag = $TSunic->get('$bp$Tag', $fk_tags[$index]);
	if (!$Tag->isValidValue($value)) {
	    $TSunic->Log->alert('error', '{CREATEPROFILE__INVALIDVALUE} ('.$Tag->getInfo('name').': '.$value.')');
	    $TSunic->redirect('back');
	}
    }

    // create profile object
    $Profile = $TSunic->get('$$$Profile', 0);

    // create profile
    if (!$Profile->create()) {
	// add error message and redirect back
	$TSunic->Log->alert('error', '{CREATEPROFILE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // add/edit all bits
    foreach ($values as $index => $value) {

	// exists?
	if ($fk_bits[$index]) {
	    $Bit = $TSunic->get('$bp$Bit', $fk_bits[$index]);
	    if (!$Bit->edit($value)) {
		$TSunic->Log->alert('error', '{CREATEPROFILE__ERROR}');
		$TSunic->redirect('back');
	    }
	}

	// create new Bit
	if (!$Profile->addBit($value, $fk_tags[$index])) {
	    $TSunic->Log->alert('error', '{CREATEPROFILE__ERROR}');
	    $TSunic->redirect('back');
	}
    }

    // success
    $TSunic->Log->alert('info', '{CREATEPROFILE__SUCCESS}');
    $TSunic->redirect('$$$showProfile', array('$$$id' => $Profile->getInfo('id')));
    return true;
}
?>
