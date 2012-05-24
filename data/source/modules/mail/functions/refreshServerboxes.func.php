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
		$Mailaccount->updateServerboxes();

		// add info-message
		$TSunic->Log->alert('infos', '{REFRESHSERVERBOXES__SUCCESS}');
	}

	// redirect back
	$TSunic->redirect('back');
	return true;
}
?>
