<!-- | -->
<?php

function $$$activateServerboxes () {
	global $TSunic;

	// get input
	$id_mail__account = $TSunic->Temp->getParameter('$$$showAccount__id_mail__account');
	$activated_serverboxes = $TSunic->Temp->getByPreffix('$$$showAccount__serverboxes_');

	// get mailaccount-object
	$Mailaccount = $TSunic->get('$$$Account', $id_mail__account);

	// get all serverboxes
	$all_serverboxes = $Mailaccount->getServerboxes();

	// check all serverboxes
	foreach ($all_serverboxes as $index => $value) {

		// is active?
		if ($value->getInfo('isActive')) {
			// is active

			// is not selected?
			if (!isset($activated_serverboxes[$value->getInfo('id_mail__serverbox')])) {
				// deactivate
				$value->activate(false);
			}

		} else {
			// is inactive

			// is selected?
			if (isset($activated_serverboxes[$value->getInfo('id_mail__serverbox')])) {
				// activate
				$value->activate(true);
			}
		}
	}

	// success
	$TSunic->Log->add('info', '{ACTIVATESERVERBOXES__SUCCESS}', 3);
	$TSunic->redirect('back');

	return true;
}
?>
