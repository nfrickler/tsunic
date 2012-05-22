<!-- | function to refresh serverboxes -->
<?php
function $$$refreshServerboxes () {
	global $TSunic;

	// get id_mail__account
	$id = $TSunic->Temp->getParameter('$$$id');

	if (!empty($id) AND is_numeric($id)) {

		// get mailaccount-object
		$Mailaccount = $TSunic->get('$$$Account', $id);

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
