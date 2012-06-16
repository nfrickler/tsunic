<!-- | FUNCTION save and send mail -->
<?php
function $$$saveMail () {
	global $TSunic;

	// get input
	$id = $TSunic->Temp->getParameter('$$$formMail__id');
	$fk_smtp = $TSunic->Temp->getParameter('$$$formMail__fk_smtp');
	$addressee = $TSunic->Temp->getParameter('$$$formMail__addressee');
	$subject = $TSunic->Temp->getParameter('$$$formMail__subject');
	$content = $TSunic->Temp->getParameter('$$$formMail__content');
	$send = ($TSunic->Temp->getParameter('$$$formMail__send')) ? true : false;

	// get Mail object
	$Mail = $TSunic->get('$$$Mail', $id);
	if (is_numeric($id) and !$Mail->isValid()) {
		$TSunic->Log->alert('error', '{SAVEMAIL__NOTEXISTING}');
		$TSunic->redirect('back');
	}

	// validate input
	if (!$Mail->isValidSubject($subject)
		or !$Mail->isValidContent($content)
		or !$Mail->isValidAddressee($addressee)
		or !$Mail->isValidFkSmtp($fk_smtp, false)
	) {
		$TSunic->Log->alert('error', '{SAVEMAIL__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// create new or edit existing Mail
	if ($Mail->isValid()) {
		if (!$Mail->edit($subject, $content, $addressee, $fk_smtp)) {
			$TSunic->Log->alert('error', '{SAVEMAIL__EDITERROR}');
			$TSunic->redirect('back');
		}
	} else {
		if (!$Mail->create($subject, $content, $addressee, $fk_smtp)) {
			$TSunic->Log->alert('error', '{SAVEMAIL__CREATEERROR}');
			$TSunic->redirect('back');
		}
	}

	// save mail only?
	if (!$send) {
		$TSunic->Log->alert('info', '{SAVEMAIL__SUCCESS}');
		$TSunic->redirect('$$$showMail', array('$$$id' => $Mail->getInfo('id')));
	}

	// validate fk_smtp
	if (!$Mail->isValidFkSmtp($fk_smtp)) {
		$TSunic->Log->alert('error', '{SAVEMAIL__INVALIDSENDER}');
		$TSunic->redirect('$$$showMail', array('$$$id' => $Mail->getInfo('id')));
	}

	// send mail
	if (!$Mail->send()) {
		$TSunic->Log->alert('error', '{SAVEMAIL__SENDERROR}');
		$TSunic->redirect('$$$showMail', array('$$$id' => $Mail->getInfo('id')));
	}

	// success
	$TSunic->Log->alert('info', '{SAVEMAIL__SUCCESS_SEND}');
	$TSunic->redirect('$$$showMailboxes');

	return true;
}
?>
