<!-- | function to refresh serverboxes -->
<?php
function $$$refreshServerboxes () {
	global $TSunic;

	// get id
	$id = $TSunic->Temp->getParameter('$$$id');

	if (!empty($id) AND is_numeric($id)) {

		// get Mailaccount object
		$Mailaccount = $TSunic->get('$$$Mailaccount', $id);

		// update serverboxes
		if ($Mailaccount->updateServerboxes()) {
			$TSunic->Log->alert('info', '{REFRESHSERVERBOXES__SUCCESS}');
		} else {
			$TSunic->Log->alert('error', '{REFRESHSERVERBOXES__ERROR}');
		}
	}

	// redirect back
	$TSunic->redirect('back');
	return true;
}
?>
