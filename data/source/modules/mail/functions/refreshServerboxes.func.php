<!-- | function to refresh serverboxes -->
<?php
function $$$refreshServerboxes () {
	global $TSunic;

	// get id_mail__account
	$id_mail__account = $TSunic->Temp->getParameter('id_mail__account');

	if (!empty($id_mail__account) AND is_numeric($id_mail__account)) {

		// get mailaccount-object
		$Mailaccount = $TSunic->get('$$$Account', $id_mail__account);

		// update serverboxes
		$Mailaccount->updateServerboxes();

		// add info-message
		$TSunic->Log->add('infos', '{REFRESHSERVERBOXES__SUCCESS}');
	}

	// redirect back
	$TSunic->redirect('back');
	return true;
}
?>
